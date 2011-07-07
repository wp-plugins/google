<?php
/*
Plugin Name: Google +1
Plugin URI: http://premium.wpmudev.org/project/google-1
Description: Adds the Google +1 button to your site.
Version: 1.0.4
Author: Ve Bailovity (Incsub)
Author URI: http://premium.wpmudev.org
WDP ID: 234

Copyright 2009-2011 Incsub (http://incsub.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License (Version 2 - GPLv2) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

define ('WDGPO_PLUGIN_SELF_DIRNAME', basename(dirname(__FILE__)), true);

//Setup proper paths/URLs and load text domains
if (is_multisite() && defined('WPMU_PLUGIN_URL') && defined('WPMU_PLUGIN_DIR') && file_exists(WPMU_PLUGIN_DIR . '/' . basename(__FILE__))) {
	define ('WDGPO_PLUGIN_LOCATION', 'mu-plugins', true);
	define ('WDGPO_PLUGIN_BASE_DIR', WPMU_PLUGIN_DIR, true);
	define ('WDGPO_PLUGIN_URL', WPMU_PLUGIN_URL, true);
	$textdomain_handler = 'load_muplugin_textdomain';
} else if (defined('WP_PLUGIN_URL') && defined('WP_PLUGIN_DIR') && file_exists(WP_PLUGIN_DIR . '/' . WDGPO_PLUGIN_SELF_DIRNAME . '/' . basename(__FILE__))) {
	define ('WDGPO_PLUGIN_LOCATION', 'subfolder-plugins', true);
	define ('WDGPO_PLUGIN_BASE_DIR', WP_PLUGIN_DIR . '/' . WDGPO_PLUGIN_SELF_DIRNAME, true);
	define ('WDGPO_PLUGIN_URL', WP_PLUGIN_URL . '/' . WDGPO_PLUGIN_SELF_DIRNAME, true);
	$textdomain_handler = 'load_plugin_textdomain';
} else if (defined('WP_PLUGIN_URL') && defined('WP_PLUGIN_DIR') && file_exists(WP_PLUGIN_DIR . '/' . basename(__FILE__))) {
	define ('WDGPO_PLUGIN_LOCATION', 'plugins', true);
	define ('WDGPO_PLUGIN_BASE_DIR', WP_PLUGIN_DIR, true);
	define ('WDGPO_PLUGIN_URL', WP_PLUGIN_URL, true);
	$textdomain_handler = 'load_plugin_textdomain';
} else {
	// No textdomain is loaded because we can't determine the plugin location.
	// No point in trying to add textdomain to string and/or localizing it.
	wp_die(__('There was an issue determining where Post Voting plugin is installed. Please reinstall.'));
}
$textdomain_handler('wdgpo', false, WDGPO_PLUGIN_SELF_DIRNAME . '/languages/');


require_once WDGPO_PLUGIN_BASE_DIR . '/lib/class_wdgpo_installer.php';
Wdgpo_Installer::check();

require_once WDGPO_PLUGIN_BASE_DIR . '/lib/class_wdgpo_options.php';
require_once WDGPO_PLUGIN_BASE_DIR . '/lib/class_wdgpo_codec.php';

Wdgpo_Options::populate();

// Widget
require_once WDGPO_PLUGIN_BASE_DIR . '/lib/class_wpgpo_widget.php';
add_action('widgets_init', create_function('', "register_widget('Wdgpo_WidgetPlusone');"));


if (is_admin()) {
	require_once WDGPO_PLUGIN_BASE_DIR . '/lib/class_wdgpo_admin_form_renderer.php';
	require_once WDGPO_PLUGIN_BASE_DIR . '/lib/class_wdgpo_admin_pages.php';
	Wdgpo_AdminPages::serve();
} else {
	require_once WDGPO_PLUGIN_BASE_DIR . '/lib/class_wdgpo_public_pages.php';
	Wdgpo_PublicPages::serve();
}