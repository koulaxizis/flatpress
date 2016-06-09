<?php
/*
Plugin Name: Mobile
Plugin URI: http://www.vdfn.altervista.org/plugin_mobile.html
Description: Αν το θέμα σου δεν εμφανίζεται σωστά σε μικρές οθόνες (δεν είναι "responsive"), ενεργοποίησε αυτό το πρόσθετο.
Author: Piero VDFN
Version: 1.0.1
Author URI: http://www.vdfn.altervista.org/
*/ 

/**
 * This is the main class of the plugin.
 *
 * @author: Piero VDFN <vogliadifarniente@gmail.com>
 */
class plugin_mobile {

	/**
 	 * This var tells if I should use the mobile theme.
 	 *
 	 * @var boolean
 	 */
	var $isMobile=false;

	/**
	 * This is the configuration of the plugin.
	 *
	 * @var array
	 */
	var $conf=array(
		# The mobile theme
		'theme'=>'leggero',
		'removejs'=>true,
		'admin'=>true,
	);

	/**
	 * This is the default theme of Flatpress.
	 *
	 * @var string.
	 */
	var $defaultTheme=THE_THEME;

	/**
	 * Did the user agent test find a mobile browser?
	 *
	 * @var boolean
	 */
	var $mobileUseragent=false;

	/**
	 * This is the constructor.
	 * Add a function to init hook and add some smarty blocks.
	 * It also loads configuration.
	 */
	function plugin_mobile() {
		// Accept the init hook
		add_filter('init', array(&$this, 'init'));

		// Load the configuration
		$this->conf_load();

		// Setup links
		$this->setup_links();

		// Add the Smarty mobile block
		global $smarty;
		$smarty->register_block('mobile', array(&$this, 'smarty_block'));
	}

	/**
	 * This function accepts the init hoook.
	 */
	function init() {
		// Thanks to http://detectmobilebrowser.com/
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)) || isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
			$this->mobileUseragent=true;
		}


		// Check if we have to go into mobile theme
		if(!$this->checkMobile()) {
			return;
		}

		// Trigger the change theme action
		$themeid=$this->conf['theme'];
		$this->changeTheme($themeid);
	}

	/**
	 * Check if we have to use the mobile theme.
	 *
	 * @return boolean: Should use the mobile theme?
	 */
	function checkMobile() {
		// Ignore the session?
		$ignoresession=false;

		# Check for no mobile in GET
		global $fp_params;
		switch(@$fp_params['no_mobile']) {
			case '':
				break;
			case 2:
				$this->isMobile=false;
				sess_add('mobile', -1);
				return;
				break;
			case 1:
				$this->isMobile=false;
				$ignoresession=true;
				return;
				break;
			case -1:
				$this->isMobile=true;
				sess_add('mobile', 1);
				break;
			case -2:
				$ignoresession=true;
				$this->isMobile=true;
				break;
		}

		# Check for no mobile in SESSION
		@$sess=sess_get('mobile');
		if($ignoresession) {
		}elseif($sess==-1) {
			$this->isMobile=false;
			return;
		} elseif($sess==1) {
			$this->isMobile=true;
		}

		if(!$this->conf['admin'] && defined('MOD_ADMIN_PANEL')) {
			$this->isMobile=false;
			return;
		}

		if($this->mobileUseragent) {
			$this->isMobile=true;
		}

		return $this->isMobile;
	}

	/**
	 * This function setup a non-default theme.
	 * Actually it's just a Copy&Paste from core.theme.php
	 *
	 * @param string $themeid: The theme id
	 */
	function changeTheme($themeid) {
		global $theme, $fp_config;

		if(!($dir=theme_exists($themeid))) {
			return;
		}

		$this->defaultTheme=$fp_config['general']['theme'];
		$fp_config['general']['theme']=$themeid;

		# The theme config
		if(file_exists($f=$dir.'theme_conf.php')) {
			include $f;
		} elseif(file_exists($f=$dir.'theme.conf.php')) {
			include $f;
		}

		# Replace Standard Stylesheets
		remove_filter('wp_head', 'theme_head_stylesheet');
		add_action('wp_head', array(&$this, 'default_head'));

		# Remove JS that are useless
		if($this->conf['removejs']) {
			remove_action('wp_head', 'plugin_jquery_head', 0);
			remove_action('wp_head', 'plugin_jsutils_head', 0);
			remove_action('wp_head', 'plugin_lightbox_head');
			remove_action('wp_head', 'plugin_lightbox2_head');
			remove_action('wp_footer', 'plugin_lightbox_footer');
			remove_action('wp_footer', 'plugin_lightbox2_footer');
		}
	}

	/**
	 * This function replaces the original head function of flatpress.
	 */
	function default_head() {
		global $fp_config, $theme;

		$url=theme_geturl($fp_config['general']['theme']);

		$css='res/';
		$css.=defined('MOD_ADMIN_PANEL') ? $theme['style']['style_admin'] : $theme['style']['style_def'];
		echo "\n".'<link media="screen,projection,handheld" href="'.$url.$css.'" type="text/css" rel="stylesheet" />'."\n";

		if(@$theme['style']['style_print']) {
			$css='res/'.$theme['style']['style_print'];
			echo '<link media="print" href="'.$url.$css.'" type="text/css" rel="stylesheet" />'."\n";
		}

	}

	/**
	 * This function loads the configuration of the plugin.
	 *
	 * @return array: The configuration
	 */
	function conf_load() {
		$conf=plugin_getoptions('mobile');
		if(is_array($conf)) {
			$this->conf=array_merge($this->conf, $conf);
		}
		return $this->conf;
	}

	/**
	 * This function manages the Smarty mobile block.
	 *
	 * @param array $params: Parameters
	 * @param string $content: The content
	 * @param object $smarty: The Smarty instance
	 * @param boolean $repeat: Must repeat the block?
	 * @return string: The edited content
	 */
	function smarty_block($params, $content, &$smarty, &$repeat) {
		if($this->mobileUseragent) {
			return $content;
		} else {
			return '';
		}
	}

	/**
	 * Setup links to enable/disable mobile version.
	 */
	function setup_links() {
		global $smarty;

		// The URL of this page
		$url=@$_SERVER['HTTPS']=='on' ? 'https' : 'http'; 
		$url.='://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		// We are using sprintf so change % with %%
		$url=str_replace('%', '%%', $url);

		$param_name='no_mobile=';

		if(($pos=strrpos($url, $param_name))!==FALSE) {
			// We already have the parameter
			$pos+=strlen($param_name);
			// I've used $_GET instead of $fp_params because $fp_params could have been modified from a plugin
			$format=substr($url, 0, $pos).'%d'.substr($url, $pos+strlen($_GET['no_mobile'])); 
		} elseif(($pos=strpos($url, '?'))!==FALSE) {
			// We don't have the parameter but we have other params
			$format=$url;
			// Add a & to the end of the URL
			if(substr($url, -1, 1)!='&') {
				$format.='&';
			}
			$format.=$param_name.'%d';
		} else {
			// We don't have any GET parameter
			$format=$url.'?'.$param_name.'%d';
		}

		# No mobile version for that page
		$smarty->assign('plmobilen', sprintf($format, 1));
		# No mobile version for the session
		$smarty->assign('plmobiles', sprintf($format, 2));
		# Restore mobile version for the session
		$smarty->assign('plmobiley', sprintf($format, -1));
		# Restore mobile version for that page
		$smarty->assign('plmobilep', sprintf($format, -2));
	}

}

$GLOBALS['plugin_mobile']=new plugin_mobile();

if(class_exists('AdminPanelAction')) {
	include dirname(__FILE__).'/admin.php';
}
