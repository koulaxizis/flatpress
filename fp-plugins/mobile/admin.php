<?php
if(class_exists('AdminPanelAction')) {
	/**
	 * admin_plugin_mobile
	 *
	 * This class manages the Mobile Admin Panel.
	 *
	 * @author: Piero VDFN <vogliadifarniente@gmail.com>
	 * @license: GNU GPL v2
	 */
	class admin_plugin_mobile extends AdminPanelAction {

		# The language files
		var $langres='plugin:mobile';

		/**
		 * setup
		 *
		 * This function is used as a callback when the panel
		 * is loaded.
		 *
		 * @author: Piero VDFN <vogliadifarniente@gmail.com>
		 */
		function setup() {
			$this->smarty->assign('admin_resource', 'plugin:mobile/admin.plugin.mobile');
			$this->smarty->assign('pburl', plugin_geturl('mobile'));
		}

		/**
		 * main
		 *
		 * This is the main function of the panel.
		 *
		 * @author: Piero VDFN <vogliadifarniente@gmail.com>
		 */
		function main() {
			global $lang;

			$pm=&$GLOBALS['plugin_mobile'];
			$smarty=&$this->smarty;

			$smarty->assign('mobileconf', $pm->conf_load());
			$smarty->assign('mobilethemes', theme_list());


		}

		/**
		 * onsubmit
		 *
		 * This function is called when you press a button in
		 * the Admin Panel.
		 *
		 * @author: Piero VDFN <vogliadifarniente@gmail.com>
		 */
		function onsubmit() {

			$smarty=&$this->smarty;

			@$theme=$_POST['theme'];
			if(!theme_exists($theme) || empty($theme)) {
				$smarty->assign('success', -2);
			} else {

				plugin_addoption('mobile', 'theme', $theme);
				plugin_addoption('mobile', 'removejs', isset($_POST['removejs']));
				plugin_addoption('mobile', 'admin', isset($_POST['admin']));

				$smarty->assign('success', plugin_saveoptions('mobile') ? 1 : -1);
			}

			$this->main();
			return 0;

		}

	}

	admin_addpanelaction('plugin', 'mobile', true);
}