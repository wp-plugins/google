<?php
/**
 * Renders form elements for admin settings pages.
 */
class Wdgpo_AdminFormRenderer {
	function _get_option () {
		return WP_NETWORK_ADMIN ? get_site_option('wdgpo') : get_option('wdgpo');
	}

	function _create_checkbox ($name) {
		$opt = $this->_get_option();
		$value = @$opt[$name];
		return
			"<input type='radio' name='wdgpo[{$name}]' id='{$name}-yes' value='1' " . ((int)$value ? 'checked="checked" ' : '') . " /> " .
				"<label for='{$name}-yes'>" . __('Yes', 'wdgpo') . "</label>" .
			'&nbsp;' .
			"<input type='radio' name='wdgpo[{$name}]' id='{$name}-no' value='0' " . (!(int)$value ? 'checked="checked" ' : '') . " /> " .
				"<label for='{$name}-no'>" . __('No', 'wdgpo') . "</label>" .
		"";
	}

	function _create_radiobox ($name, $value) {
		$opt = $this->_get_option();
		$checked = (@$opt[$name] == $value) ? true : false;
		return "<input type='radio' name='wdgpo[{$name}]' id='{$name}-{$value}' value='{$value}' " . ($checked ? 'checked="checked" ' : '') . " /> ";
	}


	function create_appearance_box () {
		$appearances = array (
			'small' => __('Small: %s', 'wdgpo'),
			'medium' => __('Medium: %s', 'wdgpo'),
			'standard' => __('Standard: %s', 'wdgpo'),
			'tall' => __('Tall: %s', 'wdgpo'),
		);
		foreach ($appearances as $pos => $label) {
			$img = "<br /><img src='" . WDGPO_PLUGIN_URL . "/img/{$pos}.png' /> <img src='" . WDGPO_PLUGIN_URL . "/img/{$pos}-count.png' />";
			echo $this->_create_radiobox ('appearance', $pos);
			echo "<label for='appearance-{$pos}'>" . sprintf($label, $img) . "</label><br />";
		}
	}

	function create_show_count_box () {
		echo $this->_create_checkbox ('show_count');
	}

	function create_front_page_box () {
		echo $this->_create_checkbox ('front_page');
	}

	function create_position_box () {
		$positions = array (
			'top' => __('Before the post', 'wdgpo'),
			'bottom' => __('After the post', 'wdgpo'),
			'both' => __('Both before and after the post', 'wdgpo'),
			'manual' => __('Manually position the box using shortcode or widget', 'wdgpo'),
		);
		foreach ($positions as $pos => $label) {
			echo $this->_create_radiobox ('position', $pos);
			echo "<label for='position-{$pos}'>$label</label><br />";
		}
	}

	function create_language_box () {
		$languages = array(
			"" => "",
			"Arabic" => "ar",
			"Bulgarian" => "bg",
			"Catalan" => "ca",
			"Chinese (Simplified)" => "zh-CN",
			"Chinese (Traditional)" => "zh-TW",
			"Croatian" => "hr",
			"Czech" => "cs",
			"Danish" => "da",
			"Dutch" => "nl",
			"English (UK)" => "en-GB",
			"English (US)" => "en-US",
			"Estonian" => "et",
			"Filipino" => "fil",
			"Finnish" => "fi",
			"French" => "fr",
			"German" => "de",
			"Greek" => "el",
			"Hebrew" => "iw",
			"Hindi" => "hi",
			"Hungarian" => "hu",
			"Indonesian" => "id",
			"Italian" => "it",
			"Japanese" => "ja",
			"Korean" => "ko",
			"Latvian" => "lv",
			"Lithuanian" => "lt",
			"Malay" => "ms",
			"Norwegian" => "no",
			"Persian" => "fa",
			"Polish" => "pl",
			"Portuguese (Brazil)" => "pt-BR",
			"Portuguese (Portugal)" => "pt-PT",
			"Romanian" => "ro",
			"Russian" => "ru",
			"Serbian" => "sr",
			"Slovak" => "sk",
			"Slovenian" => "sl",
			"Spanish" => "es",
			"Spanish (Latin America)" => "es-419",
			"Swedish" => "sv",
			"Thai" => "th",
			"Turkish" => "tr",
			"Ukrainian" => "uk",
			"Vietnamese" => "vi",
		);
		$locale = get_locale();
		$locale_dash = str_replace('_', '-', $locale);
		$locale_first = substr($locale, 0, 2);
		$opt = $this->_get_option();
		echo "<select name='wdgpo[language]'>";
		foreach ($languages as $label => $lang) {
			if (@$opt['language']) $selected = ($lang == $opt['language']) ? 'selected="selected"' : '';
			else $selected = (!$opt && $lang == $locale || $lang == $locale_dash || $lang == $locale_first) ? 'selected="selected"' : '';
			echo "<option value='{$lang}' {$selected}>{$label}</option>";
		}
		echo "</select>";
	}

	function create_skip_post_types_box () {
		$post_types = get_post_types(array('public'=>true), 'names');
		$opt = $this->_get_option();
		$skip_types = is_array(@$opt['skip_post_types']) ? @$opt['skip_post_types'] : array();

		foreach ($post_types as $tid=>$type) {
			$checked = in_array($type, $skip_types) ? 'checked="checked"' : '';
			echo
				"<input type='hidden' name='wdgpo[skip_post_types][{$type}]' value='0' />" . // Override for checkbox
				"<input {$checked} type='checkbox' name='wdgpo[skip_post_types][{$type}]' id='skip_post_types-{$tid}' value='{$type}' /> " .
				"<label for='skip_post_types-{$tid}'>" . ucfirst($type) . "</label>" .
			"<br />";
		}
		_e(
			'<p>Google +1 will <strong><em>not</em></strong> be shown for selected types.</p>',
			'wdgpo'
		);
	}

	function create_footer_render_box () {
		echo $this->_create_checkbox('footer_render');
		echo '<div><small>' . __('Using the WordPress defaults, the needed scripts will be added to your <code>head</code>. Use this option to load the scripts in your footer, after the bulk of your page has lareadt been loaded.', 'wdgpo') . '</small></div>';
		echo '<div><small>' . __('Note that this method is a bit less reliable then the default one, as it depends on your theme doing the right thing.', 'wdgpo') . '</small></div>';
	}

	function create_gplus_page_id_box () {
		$opt = $this->_get_option();
		$page_id = esc_attr(@$opt['gplus_page_id']);
		echo "<input type='text' name='wdgpo[gplus_page_id]' class='widefat' value='{$page_id}' />";
		echo '<div><small>' . __('Your Google+ page ID is the long number at the end of your page URL.', 'wdgpo') . '</small></div>';
	}

	function create_enable_analytics_box () {
		echo $this->_create_checkbox('analytics_integration');
		echo '<div><small>' . __('Enabling this option will allow you to track your +1s in Google Analytics.', 'wdgpo') . '</small></div>';
		echo '<div><small>' . __('<b>Note:</b> your site will need to have Google Analytics already set up for this to work.', 'wdgpo') . '</small></div>';
	}

	function create_analytics_category_box () {
		$opt = $this->_get_option();
		$category = @$opt['analytics_category'] ? $opt['analytics_category'] : 'Google +1';
		$category = esc_attr($category);
		echo "<input type='text' name='wdgpo[analytics_category]' class='widefat' value='{$category}' />";
		echo '<div><small>' . __('Your +1 clicks will be added to this category.', 'wdgpo') . '</small></div>';
	}

}