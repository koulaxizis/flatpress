<?php
/*
Plugin Name: Tag
Version: 2.5.4
Plugin URI: http://www.pierovdfn.it/redirect/plugin_tag.html
Description: Επιτρέπει τη χρήση ετικετών στο Flatpress (Χρειάζεται το πρόσθετο BBCode για να λειτουργήσει).
Author: Piero VDFN
Author URI: http://www.pierovdfn.it/
*/

# Show tag list in the bottom of every entry? Values: true (yes) OR false (no)
define('PLUGIN_TAG_BL', true);
# Max tags shown in the cloud
define('PLUGIN_TAG_MAXC', 50);
# Where save tags
define('PLUGIN_TAG_DIR', FP_CONTENT.'plugin_tag/');
# Minimum size of tags in the cloud?
define('PLUGIN_TAG_WMIN', 10);
# Maximum size of tags in the cloud?
define('PLUGIN_TAG_WMAX', 30);
# CSS Unit of sizes of cloud? (Default pixels)
define('PLUGIN_TAG_WUN', 'px');
# The number of related entries
define('PLUGIN_TAG_REL', 10);
# To solve problems with Frontpage plugin, I remove not param with tags, however you can re-enable it
define('PLUGIN_TAG_ALLOW_NOT', false);
# Never create the cache
define('PLUGIN_TAG_NOCACHE', false);

function plugin_tag_setup() {
	return function_exists('plugin_bbcode_init')? 1:-1;
}

class plugin_tag {
	# Is PrettyURLs or RewriteURLs enabled?
	var $rewrite_link=false;
	# Tagdb, null for now
	var $tagdb_class=null;
	# Entry_tag, null for now
	var $entry_class=null;
	/**
	 * plugin_tag
	 *
	 * The constructor.
	 * It makes the basic set up of the plugin.
	 */
	function plugin_tag() {
		global $smarty;

		# Include basic files
		$tag_inc=dirname(__FILE__).'/inc/';
		include_once $tag_inc.'tagdb.php';
		include_once $tag_inc.'entry.php';

		$this->tagdb_class=new plugin_tag_db();

		$this->entry_class=new plugin_tag_entry($this->tagdb_class);

		# Check for the cache
		if(!is_dir(PLUGIN_TAG_DIR) && !PLUGIN_TAG_NOCACHE) {
			$this->tagdb_class->makeCache($this->entry_class);
		}

		## Init only if we're in index
		if(defined('MOD_INDEX')) {
			include_once $tag_inc.'init.php';
			$this->init_class=new plugin_tag_init($this->tagdb_class);
		}

		# The PrettyURLs Hack
		if(class_exists('Plugin_PrettyURLs')) {
			include_once $tag_inc.'prettyurls.php';
			$this->rewrite_link=true;
		}

		# Rewrite URLs: just for links
		if(class_exists('plugin_rewriteurls')) {
			$this->rewrite_link=true;
		}

		# Update tags when you post an entry
		if(defined('MOD_ADMIN_PANEL')) {
			include_once $tag_inc.'admin.php';
			$this->admin_class=new plugin_tag_admin($this->tagdb_class, $this->entry_class);
			$this->admin_class->use_rewrite=$this->rewrite_link;
		}

		# To be compatible with Flatpress style...
		add_filter('tag_link', array(&$this, 'tag_link'), 1, 1);

		# The widgets. They requires FP >= 0.1010
		register_widget('tag', 'Tag', array(&$this, 'tag_cloud'));
		register_widget('related', 'Related', array(&$this, 'tag_related'));
		$smarty->register_function('related_entries', array(&$this, 'smarty_related'));
	}

	# Link to the tags
	/**
	 * tag_link
	 *
	 * This function is used to make the link of a tag.
	 * It checks also for rewritten URLs.
	 *
	 * It shouldn't used directly but it should always be
	 * called via hook system to be compatible with Flatpress
	 * style/system.
	 *
	 * @param string $tag: the tag you want the link of
	 * @returns string: The tag URL
	 */
	function tag_link($tag) {
		if($this->rewrite_link) {

			# Get the Tag URL Cache
			$sanitized=$this->tagdb_class->rewriteCache();

			# If we don't have the name for rewrite, we return normal link
			if(FALSE===$k=array_search($tag, $sanitized)) {
				return BLOG_BASEURL.'?tag='.urlencode($tag);
			}
			$tag=$k.'/';

			global $plugin_rewriteurls, $plugin_prettyurls;
			if(class_exists('Plugin_PrettyURLs')) {
				return $plugin_prettyurls->baseurl.'tag/'.$tag;
			}
			if(class_exists('plugin_rewriteurls')) {
				return $plugin_rewriteurls->baseurl.'tag/'.$tag;
			}
		}

		# In every case this link works.		
		return BLOG_BASEURL.'?tag='.urlencode($tag);
	}

	/**
	 * The tag cloud.
	 *
	 * This function is here because it includes another file
	 * that makes all we want, so we don't have too much
	 * functions...
	 */
	function tag_cloud() {
		if(!isset($this->widget_class)) {
			$tag_inc=dirname(__FILE__).'/inc/';
			include_once $tag_inc.'widget.php';
			$this->widget_class=new plugin_tag_widget($this->tagdb_class, $this->entry_class);
		}

		return $this->widget_class->tagCloud();
	}

	/**
	 * The related entries.
	 *
	 * This function is here because it includes another file
	 * that makes all we want, so we don't have too much
	 * functions...
	 */
	function tag_related() {
		if(!isset($this->widget_class)) {
			$tag_inc=dirname(__FILE__).'/inc/';
			include_once $tag_inc.'widget.php';
			$this->widget_class=new plugin_tag_widget($this->tagdb_class, $this->entry_class);
		}

		return $this->widget_class->tagRelated();
	}

	/**
	 * This is the related entries for Smarty.
	 * I put here since I don't want to include always the widget class.
	 *
	 * @param array $params: The parameters for the function
	 * @param object $smarty: The Smarty Object
	 * @return string: The output
	 */
	function smarty_related($params, &$smarty) {
		if(!isset($this->widget_class)) {
			$tag_inc=dirname(__FILE__).'/inc/';
			include_once $tag_inc.'widget.php';
			$this->widget_class=new plugin_tag_widget($this->tagdb_class, $this->entry_class);
		}

		if(!isset($params['id'])) {
			$params['id']='';
		}
		if(!isset($params['number'])) {
			$params['number']=PLUGIN_TAG_REL;
		}

		$widget=$this->widget_class->tagRelated($params['id'], $params['number']);
		return $widget['content'];
	}

}

global $plugin_tag;
$plugin_tag=new plugin_tag;
