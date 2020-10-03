<?php settings_errors(); ?>
<p>Use this <strong>shortcode</strong> to display your easy wp voting  inside a page or a post</p>
<p>Note: Payment are accept in <strong>NGN</strong></p>
<p><code>[ewvwp_plugin]</code></p>
<form method="post" action="options.php" class="mujhtech-general-form">
	<?php settings_fields( 'ewvwp-group' ); ?>
	<?php do_settings_sections( 'ewvwp_plugin' ); ?>
	<?php submit_button( 'Save Changes', 'primary', 'btnSubmit' ); ?>
</form>
