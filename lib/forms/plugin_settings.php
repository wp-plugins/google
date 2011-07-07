<div class="wrap">
	<h2><?php _e('Google +1 settings', 'wdgpo');?></h2>


<?php if (WP_NETWORK_ADMIN) { ?>
	<form action="settings.php" method="post">
<?php } else { ?>
	<form action="options.php" method="post">
<?php } ?>

	<?php settings_fields('wdgpo'); ?>
	<?php do_settings_sections('wdgpo_options_page'); ?>
	<p class="submit">
		<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
	</p>
	</form>

<?php _e('<h2>Shortcode</h2>  <p>In addition to (or instead of) the auto-inserted Google +1 buttons, you may want to use the shortcode to embed the button in your posts.</p>  <dl>  <dt>Tag: <code>wdgpo_plusone</code></dt>  <dd>Embeds Google +1 button in your post</dd>  <dd>  Arguments:  <ul>  <li>  <code>appearance</code> (<em>optional</em>) - Accepts one of these values: <code>small</code>, <code>medium</code>, <code>standard</code>, <code>tall</code>. Default values are set on plugin settings page.  </li>  <li>  <code>show_count</code> (<em>optional</em>) - Accepts <code>yes</code> or <code>no</code> as values. Default values are set on plugin settings page.  </li>  </ul>  </dd>  <dd>  Examples:  <ul>  <li>  <code>[wdgpo_plusone]</code> - Embeds Google +1 button in your post, with defaults set on plugin settings page.  </li>  <li>  <code>[wdgpo_plusone appearance="tall"]</code> - Embeds Google +1 <em>tall</em> button in your post, with other options taken from plugin settings.  </li>  <li>  <code>[wdgpo_plusone show_count="no"]</code> - Embeds Google +1 button without count in your post, with other options taken from plugin settings.  </li>  </ul>  </dd> </dl>    <h2>Styling</h2>  <p>If you need some extra styling done (e.g. floating the button), the button is wrapped in a <code>DIV</code> with class <code>wdgpo</code>.</p>  <p>Based on the rendered button appearance and count, additional classes will be set:</p>  <ul>  <li><code>wdgpo_small_count</code></li>  <li><code>wdgpo_small_nocount</code></li>  <li><code>wdgpo_medium_count</code></li>  <li><code>wdgpo_medium_nocount</code></li>  <li><code>wdgpo_standard_count</code></li>  <li><code>wdgpo_standard_nocount</code></li>  <li><code>wdgpo_tall_count</code></li>  <li><code>wdgpo_tall_nocount</code></li> </ul>', 'wdgpo'); ?>

<div style="-moz-border-radius: 5px;-khtml-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;border: 1px solid #F6C600;background-color: #FFFFC4;padding: 5px 20px;margin: 5px 0px 10px;font-size: 110%;">
	<h3><a href="https://premium.wpmudev.org/subscribe/">Join WPMU DEV now to download over 300 plugins, themes and videos - and get and the best WordPress support on the web!</a></h3>
	<div class="vzaar_media_player" style="float:left;margin-left:50px;">
		<object id="video" type="application/x-shockwave-flash" data="http://view.vzaar.com/572452.flashplayer" height="284" width="486"><param name="movie" value="http://view.vzaar.com/572452.flashplayer"><param name="allowScriptAccess" value="always"><param name="allowFullScreen" value="true"><param name="wmode" value="transparent"><param name="flashvars" value="border=none"><embed src="http://view.vzaar.com/572452.flashplayer" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" allowfullscreen="true" flashvars="border=none" height="284" width="486"><video src="http://view.vzaar.com/572452.mobile" poster="http://view.vzaar.com/572452.image" controls="controls" onclick="this.play();" height="720" width="1280"></video></object>
	</div>

	<div style="float:left;margin-left:50px;">
	<h3>As a member of WPMU DEV you get:</h3>
	<ul>
		<li><strong>Unlimited</strong> use of our 300+ plugins & themes, forever!</li>
		<li>Over 35 white label video manuals for you, your users and clients</li>
		<li>Upgrades and support <strong>guaranteed</strong></li>
		<li>Helpful<strong> live chat</strong> and <strong>support forums</strong></li>
		<li>Access to all new plugins & themes</li>
		<li>New feature development requests</li>
		<li>Full access to WPMU Jobs</li>
		<li>Comprehensive manuals & eBooks</li>
		<li>It's like having your own personal developer!</li>
	</ul>
	</div>
	<div style="margin-left:50px;clear:both;"><a href="https://premium.wpmudev.org/join/"><img title="Click Here To Find Out More..." src="http://premium.wpmudev.org/wp-content/themes/wp-wpmudev/images/promo.png" alt="Click here to find out more" height="179" width="848"></a></div>
</div>

</div>