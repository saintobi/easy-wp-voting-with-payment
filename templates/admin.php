<?php settings_errors(); ?>
<p>Use this <strong>shortcode</strong> to display your easy wp voting  inside a page or a post</p>
<p><code>[easy_wp_voting]</code></p>
<form method="post" action="options.php" class="mujhtech-general-form">
	<?php settings_fields( 'easy-wp-voting-group' ); ?>
	<?php do_settings_sections( 'easy_wp_voting_plugin' ); ?>
	<?php submit_button( 'Save Changes', 'primary', 'btnSubmit' ); ?>
</form>
