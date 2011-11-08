<?php
/**
 * Handles shortcode creation and replacement.
 */
class Wdgpo_Codec {

	var $shortcodes = array(
		'plusone' => 'wdgpo_plusone',
		'gplus_page' => 'wdgpo_gplus_page',
	);

	var $data;
	function Wdgpo_Codec () { $this->__construct(); }

	function __construct () {
		$this->data = new Wdgpo_Options;
	}

	function _check_display_restrictions ($post_id) {
		if (!$post_id) return false;

		$type = get_post_type($post_id);
		if (!$type) return false;

		$skip_types = $this->data->get_option('skip_post_types');
		if (!is_array($skip_types)) return true; // No restrictions, we're good

		return (!in_array($type, $skip_types));
	}

	function process_plusone_code ($args) {
		$post_id = get_the_ID();
		if (!$this->_check_display_restrictions($post_id)) return '';

		$args = shortcode_atts(array(
			'appearance' => false,
			'show_count' => false,
		), $args);

		$size = $args['appearance'] ? $args['appearance'] : $this->data->get_option('appearance');
		$url = get_permalink();
		$show_count = $args['show_count'] ? ('yes' == $args['show_count']) : $this->data->get_option('show_count');
		$count = $show_count ? 'true' : 'false';
		$count_class = ('true' == $count) ? 'count' : 'nocount';

		$callback = $this->data->get_option('analytics_integration') ? "callback='wdgpo_plusone_click'" : '';

		$ret = "<div class='wdgpo wdgpo_{$size}_{$count_class}'><g:plusone size='{$size}' count='{$count}' href='{$url}' {$callback}></g:plusone></div>";
		return $ret;
	}

	function process_gplus_page_code ($args) {
		$args = shortcode_atts(array(
			'appearance' => false,
			'float' => false,
		), $args);
		$appearance = $args['appearance'] ? $args['appearance'] : 'medium_icon';
		$float = in_array($args['float'], array('left', 'right')) ? "style='float:{$args['float']};'" : '';

		$data = new Wdgpo_Options;
		$page_id = $data->get_option('gplus_page_id');
		if (!$page_id) return '';

		$tpl = '<a href="https://plus.google.com/%s/?prsrc=3" style="text-decoration: none;"><img src="https://ssl.gstatic.com/images/icons/gplus-%d.png" width="%d" height="%d" style="border: 0;"></img></a>';
		$tpl = "<div class='wdgpo wdgpo_gplus_page wdgpo_gplus_page_{$appearance}' {$float}>{$tpl}</div>";
		$ret = '';
		switch ($appearance) {
			case "small_icon":
				$ret = sprintf($tpl, $page_id, 16, 16, 16);
				break;
			case "medium_icon":
				$ret = sprintf($tpl, $page_id, 32, 32, 32);
				break;
			case "large_icon":
				$ret = sprintf($tpl, $page_id, 64, 64, 64);
				break;
		}

		return $ret;
	}

	function get_code ($key) {
		return '[' . $this->shortcodes[$key] . ']';
	}

	/**
	 * Registers shortcode handlers.
	 */
	function register () {
		foreach ($this->shortcodes as $key=>$shortcode) {
			add_shortcode($shortcode, array($this, "process_{$key}_code"));
		}
	}
}