<?php

/**
 * Settings panel view for the plugin
 *
 * @link       http://www.webfactoryltd.com
 * @since      0.1
 * @package    Signals_Maintenance_Mode
 */

require_once 'header.php';

?>

	<form role="form" method="post" class="signals-admin-form">
		<div class="signals-body signals-clearfix">
			<?php

				// Display the message if $signals_csmm_err is set
				if ( isset( $signals_csmm_err ) ) {
					echo $signals_csmm_err;
				}

        $user = wp_get_current_user();

        if (!get_transient('csmm_subscribe_hide')) {
          echo '<div id="collect_emails"><p><b>Get new templates &amp; premium updates straight to your inbox - for FREE!</b></p><p><input id="mm_name" value="' . $user->display_name . '" placeholder="How shall we call you?" type="text"> <input value="' . $user->user_email . '" id="mm_email" placeholder="Your best email address" type="email"><a href="#" id="mm_subscribe" class="button button-primary">Give me the free stuff</a> <a href="#" id="mm_subscribe_cancel"><span class="dashicons dashicons-no"></span></a></p></div>';
        } // if not hidden

			?>

			<div class="signals-float-left">
				<div class="signals-mobile-menu">
					<a href="javascript:void;">
						<img src="<?php echo SIGNALS_CSMM_URL; ?>/framework/admin/img/toggle.png" />
					</a>
				</div>

				<ul class="signals-main-menu">
					<li><a href="#basic"><?php _e( 'Basic', 'signals' ); ?></a></li>
					<li><a href="#email"><?php _e( 'Email', 'signals' ); ?></a></li>
					<li><a href="#design"><?php _e( 'Design', 'signals' ); ?></a></li>
					<li><a href="#form"><?php _e( 'Form', 'signals' ); ?></a></li>
					<li><a href="#advanced"><?php _e( 'Advanced', 'signals' ); ?></a></li>
					<li><a href="#support"><?php _e( 'Support', 'signals' ); ?></a></li>
				</ul>
			</div><!-- .signals-float-left -->

			<div class="signals-float-right">
				<?php

					// Including tabs content
					require_once 'settings-basic.php';		// basic
					require_once 'settings-email.php';		// email
					require_once 'settings-design.php';		// design
					require_once 'settings-form.php';		// form
					require_once 'settings-advanced.php';	// advanced
					require_once 'settings-support.php';	// support
				?>
			</div><!-- .signals-float-right -->

			<div class="signals-fixed-save-btn">
				<div class="signals-tile-body">
					<p class="signals-form-help-block" style="margin: 0; padding: 0 20px 0 10px;">
						<button type="submit" name="signals_csmm_submit" class="signals-btn signals-btn-red"><strong><?php _e( 'Save Changes', 'signals' ); ?></strong></button>
            <a style="margin: 0 0 0 15px;" href="<?php echo SIGNALS_CSMM_URL; ?>/framework/admin/preview.php" class="signals-btn" target="_blank"><strong><?php _e( 'Preview Maintenance Page', 'signals' ); ?></strong></a>
					</p>
				</div><!-- .signals-tile-body -->
			</div><!-- .signals-fixed-save-btn -->
		</div><!-- .signals-body -->
	</form><!-- form.signals-admin-form -->

<?php

require_once 'footer.php';