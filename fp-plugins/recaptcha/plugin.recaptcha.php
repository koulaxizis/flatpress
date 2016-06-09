<?php
/*
Plugin Name: reCaptcha
Plugin URI: http://www.ramblingross.co.uk/fp-content/attachs/recaptcha-1-1.zip
Description: Καταπολέμηση κακόβουλων επιθέσεων με χρήση της υπηρεσίας reCaptcha.
Author: RamblingRoss
Version: 1.1
Author URI: http://www.ramblingross.co.uk
*/

add_action('comment_validate', 'plugin_recaptcha_validate', 4, 2);
add_action('comment_form', 'plugin_recaptcha_comment_form');

function plugin_recaptcha_setup() {
	global $fp_config;

	if (!plugin_getoptions('recaptcha','privatekey') && 
			!plugin_getoptions('recaptcha','publickey')) {
		return -1;
	}
	
	return 1;
}


if (class_exists('AdminPanelAction')){

	class admin_plugin_recaptcha extends AdminPanelAction { 
		
		var $langres = 'plugin:recaptcha';
		
		function setup() {
			$this->smarty->assign('admin_resource', "plugin:recaptcha/admin.plugin.recaptcha");
		}
		
		function main() {
			$recapcthaconf = plugin_getoptions('recaptcha');
			
			$recapcthaconf['privatekey'] = isset($recapcthaconf['privatekey']) ? $recapcthaconf['privatekey'] : "";
			
			$recapcthaconf['publicekey'] = isset($recapcthaconf['publickey']) ? $recapcthaconf['publickey'] : "";

			$recapcthaconf['imgspath'] = plugin_geturl('recaptcha')."imgs/";
			
			$recapcthaconf['tred'] = "checked=\"checked\"";
			$recapcthaconf['twhite'] = "";
			$recapcthaconf['tblack'] = "";
			$recapcthaconf['tclean'] = "";
			if (isset($recapcthaconf['theme']))
			{
				$recapcthaconf['tred'] = "";
				switch($recapcthaconf['theme'])
				{
					case "red":
						$recapcthaconf['tred'] = "checked=\"checked\"";
						break;
					case "white":
						$recapcthaconf['twhite'] = "checked=\"checked\"";
						break;
					case "blackglass":
						$recapcthaconf['tblack'] = "checked=\"checked\"";
						break;
					case "clean":
						$recapcthaconf['tclean'] = "checked=\"checked\"";
						break;
				}
			}
			
			$this->smarty->assign('recaptchaconf', $recapcthaconf);
		}
		
		function onsubmit() {
			global $fp_config;
			
			if ($_POST['recaptcha-conf']){
				
				plugin_addoption('recaptcha', 'privatekey', $_POST['recaptcha-privatekey']);
				plugin_addoption('recaptcha', 'publickey', $_POST['recaptcha-publickey']);
				plugin_addoption('recaptcha', 'theme', $_POST['recaptcha-theme']);
				plugin_saveoptions('recaptcha');
				
				$this->smarty->assign('success', 1);
			} else {
				$this->smarty->assign('success', -1);
			}
			
			return 2;
		}		
	}

	admin_addpanelaction('plugin', 'recaptcha', true);

}

function plugin_recaptcha_validate($status, $comment) {

	// If the comment has been already stopped or this is the contact page
	if(!$status)
		return $status;
	
	// if user is loggedin we ignore the plugin
	if (user_loggedin())
		return true;
	
	// bring in recaptcha library
	require_once('inc/recaptchalib.php');

	// the response from reCAPTCHA
	$resp = null;

	//the error code from reCAPTCHA, if any
	$error = null;

	$resp = recaptcha_check_answer (plugin_getoptions('recaptcha','privatekey'),
																	$_SERVER["REMOTE_ADDR"],
																	$_POST["recaptcha_challenge_field"],
																	$_POST["recaptcha_response_field"]);

	if ($resp->is_valid) {
		return true;
	}

	global $smarty;
	$lang = lang_load('plugin:recaptcha');
		
	$smarty->append('error', $lang['plugin']['recaptcha']['error']);

	$resp->error;

	return false;
}

function plugin_recaptcha_comment_form() {
	
	global $fp_config;
	
	// bring in recaptcha library
	require_once('inc/recaptchalib.php');

	// load plugin strings
	// they're located under plugin.PLUGINNAME/lang/LANGID/
	$lang = lang_load('plugin:recaptcha');

	$recapcthaconf = plugin_getoptions('recaptcha');
		
	$opts_code = "\n<script type=\"text/javascript\">\nvar RecaptchaOptions = {";
	
	$customtranslations = $lang['plugin']['recaptcha']['customtranslations'];
	
	if (!empty($customtranslations)) {
		$opts_code .= "\n\tcustom_translations : ";
		$opts_code .= $customtranslations;
		$opts_code .= ',';
	}

	$opts_code .= "\n\tlang : '";
	$opt_lang = explode ("-", $fp_config['locale']['lang'],-1);
	if (empty($opt_lang))
		$opts_code .= "en";
	else
		$opts_code .= $opt_lang[0];
	$opts_code .= "',";

	if (isset($recapcthaconf['theme']))
		$theme = $recapcthaconf['theme'];
	else
		$theme = "red";

	$opts_code .= "\n\ttheme : '".$theme."'\n};\n</script>\n";

	// display recaptcha
	echo "<p><label class='textlabel' for='recaptcha_challenge_field'>{$lang['plugin']['recaptcha']['prefix']}</label><br />";
	echo $opts_code;
	echo recaptcha_get_html(plugin_getoptions('recaptcha','publickey'));
	echo "</p>";
}


?>
