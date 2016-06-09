<?php
/**
 * plugin_tag_widget
 *
 * This class manages the widgets of the plugin tag.
 * These are the Tag Cloud and the related Entries.
 */
class plugin_tag_widget {
	# The tagdb object
	var $tagdb=null;
	# The tag entry object
	var $entry=null;
	# The tag cloud cache
	var $widgetCache=array();

	/**
	 * This function is the constructor of the class.
	 * It saves by reference the tagdb object and the entry object.
	 *
	 * @param object $tagdb: The tagdb object
	 * @param object $entry: The tag entry object
	 */
	function plugin_tag_widget(&$tagdb, &$entry) {
		$this->tagdb=&$tagdb;
		$this->entry=&$entry;
	}

	## TAG CLOUD

	/**
	 * This function creates the cache of widget.
	 *
	 * @param boolean $force: Force the function to make a new cache?
	 * @return array: The cache
	 */
	function makeCache($force=false) {
		# Check for already existent cache.
		if(!empty($this->widgetCache) && !$force) {
			return $this->widgetCache;
		}
		if(file_exists(CACHE_DIR.'tag-widget.tmp') && !$force) {
			include CACHE_DIR.'tag-widget.tmp';
			$this->widgetCache=$cache;
			return $this->widgetCache;
		}

		// Otherwise we make a new cache!
		# List tags
		$lister=new tag_lister();
		$tags=$lister->makeTagList();
		if(!count($tags)) {
			return array();
		}

		arsort($tags);
		$max=count(max($tags));

		$cache=array();
		foreach($tags as $tag=>$entries) {
			$cache[$tag]=array(
				'r'=>count($entries)/$max,
				'a'=>count($entries)
			);
		}

		# Save the cache and return it
		system_save(CACHE_DIR.'tag-widget.tmp', array('cache'=>$cache));
		return $cache;
	}

	/**
	 * This function return random tags.
	 *
	 * @param array $array: The cache array
	 * @param integer $count: How much tags?
	 * @return array: The random tags
	 */
	function getRandom($array, $num) {
		if($num>=count($array)) {
			$random=array();
			foreach($array as $key=>$val) {
				$random[$key]=$val['r'];
			}
			return $random;
		}

		$classes=array();
		foreach($array as $key=>$val) {
			$classes[round($val['r']*10)][]=$key;
		}
		krsort($classes);

		$random=array();

		for($i=10; $i>-1; $i--) {
			if(!isset($classes[$i])) {
				continue;
			}
			if($num<1) {
				break;
			}
			$extract=$num>count($classes[$i]) ? count($classes[$i]) : $num;
			$rclass=array_rand($classes[$i], $extract);
			if($extract==1) {
				$key=$classes[$i][$rclass];
				$random[$key]=$array[$key]['r']; 
			} else {
					foreach($rclass as $val) {
					$key=$classes[$i][$val];
					$random[$key]=$array[$key]['r'];
				}
			}
			$num-=$extract;
		}

		return $random;
	}

	/**
	 * This function converts the relative number of tag to a class.
	 *
	 * @param float $rel: The relative number
	 * @return string: The class
	 */
	function relToClass($rel) {
		$c='';
		if($rel<0.15) {
			$c='l';
		} elseif($rel<0.35) {
			$c='ml';
		} elseif($rel>0.80) {
			$c='h';
		} elseif($rel>0.60) {
			$c='mh';
		} else {
			$c='m';
		}
		return $c;
	}

	/**
	 * This function is the callback for Flatpress Widget System.
	 * It manages the tagcloud.
	 *
	 * @param integer $number: The number of tags to show
	 * @return array: The couple title/content for FP Widget System
	 */
	function tagCloud($number=PLUGIN_TAG_MAXC) {
		$lang=lang_load('plugin:tag');
		$lang=$lang['plugin']['tag'];
		$cache=$this->makeCache();

		# If there aren't tags
		if(!count($cache)) {
			$message=$lang['notags'];
			$code=<<<CLOUD
<div class="tagcloud">
	{$message}
</div>
CLOUD;
		} else {
			$tags=$this->getRandom($cache, $number);
			uksort($tags, 'strnatcasecmp');
			$delta=PLUGIN_TAG_WMAX-PLUGIN_TAG_WMIN;
			$unit=PLUGIN_TAG_WUN;
			$format='<a href="%s" class="tag-%s" title="%s" style="font-size: %u'.
				$unit.';">%s</a>'."\n\t";
			$code="<div class=\"tagcloud\">\n\t";
			foreach($tags as $tag=>$perc) {
				$l=apply_filters('tag_link', $tag);
				$n=$cache[$tag]['a'];
				$t=''.$n;
				$t.=$n==1 ? $lang['entry'] : $lang['entries'];
				$t=wp_specialchars($t);
				$d=$this->relToClass($perc);
				$c=wp_specialchars($tag);
				$s=PLUGIN_TAG_WMIN+$perc*$delta;
				$code.=sprintf($format, $l, $d, $t, $s, $c);
			}
			$code=substr($code, 0, -1).'</div>';
		}

		return array(
			'subject'=>$lang['widget'],
			'content'=>$code,
		);
	}

	## RELATED ENTRIES

	/**
	 * This function is the callback for Flatpress Widget System.
	 * It manages the related tag widget.
	 *
	 * @param string $id: The entry id
	 * @param integer $number: Number of entries to show
	 * @return array: The couple title/content for FP Widget System
	 */
	function tagRelated($id = '', $number = PLUGIN_TAG_REL) {
		global $fp_params, $post;

		// PrettyURL's $post fix
		$oldpost = isset($post) ? $post : array();

		$lang = lang_load('plugin:tag');
		$lang = $lang['plugin']['tag'];

		if(empty($id) && isset($fp_params['entry'])) {
			$id = $fp_params['entry'];
		}

		if(empty($id)) {
			$code = $lang['error'];
		} else {
			$related = $this->getRelation($id, $number);
			if(count($related) == 0) {
				$code = $lang['norelated'];
			} else {
				$code = '<ul class="pltag_related">';

				foreach($related as $id=>$entry) {
					$post = array('subject' => $entry['subject']);
					$link = get_permalink($id);

					$entry['subject'] = wp_specialchars($entry['subject'], 1);
					$code .= "\n<li><a href=\"{$link}\" title=\"{$entry['subject']}\">{$entry['subject']}</a></li>";
				}

				$code .= "\n</ul>";
			}
		}

		$post = $oldpost;

		return array(
			'subject' => $lang['related'],
			'content' => $code,
		);
	}

	/**
	 * This function return the related posts id.
	 *
	 * @param string $id: The entry ID
	 * @param integer $number: How much entries do you need?
	 * @param boolean $force: Force the relation creation?
	 * @return array: The related entries
	 */
	function getRelation($id, $number=PLUGIN_TAG_REL, $force = false) {
		$ym=substr($id, 5, 4);
		$cachefile=CACHE_DIR . "tag-related-$ym.tmp";

		if(file_exists($cachefile) && !$force) {
			$cache = array();

			include $cachefile;

			if(isset($cache[$id])) {
				$related = $cache[$id];
				if(count($related) > $number) {
					$related = array_slice($related, 0, $number);
				}
				return $related;
			}
		}

		$tags = $this->entry->entryTags($id);

		if(count($tags) == 0) {
			return array();
		}

		$tagdb = &$this->tagdb;
		$related = array();

		foreach($tags as $tag) {
			$entries = $tagdb->taggedEntries($tag);
			if(count($entries) == 0) {
				continue;
			}
			foreach($entries as $entry) {
				if($entry == $id) {
				} elseif(isset($related[$entry])) {
					$related[$entry]['called']++;
				} else {
					$date = date_from_id($entry);
					$o = new FPDB_Query(array('fullparse' => false, 'id' => $entry), null);
					$o->hasMore();
					$entrydata = $o->getEntry();
					$related[$entry] = array(
						'id' => $entry,
						'time' => $date['time'],
						'called' => 1,
						'subject' => $entrydata[1]['subject'],
					);
				}
			}
		}

		uasort($related, array(&$this, 'relatedSort'));
		$cache[$id] = $related;
		system_save($cachefile, array('cache '=> $cache));

		if(count($related) > $number) {
			$related = array_slice($related, 0, $number);
		}

		return $related;
	}

	/**
 	 * This function is the callback used to sort the related entries.
 	 *
 	 * @param array $a: Entry 1
 	 * @param array $b: Entry 2
 	 * @return integer: See comparation function
 	 */
	function relatedSort($a, $b) {
		if($a['called']!=$b['called']) {
			return ($a['called'] > $b['called']) ? -1 : 1;
		}

		return ($a['time'] > $b['time']) ? -1 : 1;
	}

	/**
	 * This function is just for debug! Don't use it.
	 * It makes the related entries for all the entries in the database.
	 */
	function _relatedAll() {
		$o=new FPDB_Query(array('start'=>0, 'count'=>-1, 'fullparse'=>false), null);
		while($o->hasMore()) {
			list($id, $entry)=$o->getEntry();
			$this->getRelation($id);
		}
	}

}