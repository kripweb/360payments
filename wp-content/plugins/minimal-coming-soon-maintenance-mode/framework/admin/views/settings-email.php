<?php

/**
 * Email settings view for the plugin
 *
 * @link       http://www.webfactoryltd.com
 * @since      1.0
 */

?>

<div class="signals-tile" id="email">
	<div class="signals-tile-body">
		<div class="signals-tile-title"><?php _e( 'EMAIL', 'signals' ); ?></div>
		<p><?php _e( 'Email settings for the plugin. You can configure your MailChimp account API with this plugin to store collected emails in an list.', 'signals' ); ?></p>

		<div class="signals-section-content">
			<div class="signals-form-group">
				<label for="signals_csmm_api" class="signals-strong"><?php _e( 'MailChimp API', 'signals' ); ?></label>
				<input type="text" name="signals_csmm_api" id="signals_csmm_api" value="<?php esc_attr_e( $signals_csmm_options['mailchimp_api'] ); ?>" placeholder="<?php esc_attr_e( 'MailChimp API key', 'signals' ); ?>" class="signals-form-control">

				<p class="signals-form-help-block"><?php _e( 'Enter your MailChimp API key.', 'signals' ); ?> Open your <a href="https://us2.admin.mailchimp.com/account/api/" target="_blank"><?php _e( 'MailChimp profile', 'signals' ); ?></a> <?php _e( 'to get the API key. If you don\'t want to enable the subscription option, leave this field blank.', 'signals' ); ?></p>
        <p><button type="submit" name="signals_csmm_submit" class="signals-btn"><?php _e( 'Save API key &amp; refresh mailing lists', 'signals' ); ?></button></p>
			</div>

			<div class="signals-form-group">
				<label for="signals_csmm_list" class="signals-strong"><?php _e( 'MailChimp List', 'signals' ); ?></label>

				<?php

					// Checking if the API key is present in the database
					if ( ! empty( $signals_csmm_options['mailchimp_api'] ) ) {
						// Grabbing lists using the MailChimp API
						$signals_api 	= new Signals_MailChimp( $signals_csmm_options['mailchimp_api'] );
						$signals_lists 	= $signals_api->call( 'lists/list',
							array (
		                		'apikey' => $signals_csmm_options['mailchimp_api']
		                	)
						);

						if ( ! $signals_lists ) {
							echo '<p class="signals-form-help-block">' . __( '<b>Error</b> fetching mailing lists. Please make sure that the API key you entered is correct and try again.', 'signals' ) . '</p>';
						} else if ( $signals_lists['total'] == 0 ) {
							echo '<p class="signals-form-help-block">' . __( 'It seems that there is no list created for this account. Create one on the MailChimp website and then try again.', 'signals' ) . '</p>';
						} else {
							echo '<select name="signals_csmm_list" id="signals_csmm_list">';

							foreach ( $signals_lists['data'] as $signals_single_list ) {
								echo '<option value="' . $signals_single_list['id'] . '"' . selected( $signals_single_list['id'], $signals_csmm_options['mailchimp_list'] ) . '>' . $signals_single_list['name'].'</option>';
							}

							echo '</select>';
							echo '<p class="signals-form-help-block">' . __( 'Select the MailChimp list in which you want to store the subscriber data.', 'signals' ) . '</p>';
						}
					} else {
						echo '<p class="signals-form-help-block">' . __( 'Enter your MailChimp API key in the field above and click "Save API key". Your lists will refresh and appear here.', 'signals' ) . '</p>';
					}

				?>
			</div>

			<div class="signals-double-group signals-clearfix">
				<div class="signals-form-group">
					<label for="signals_csmm_message_noemail" class="signals-strong"><?php _e( 'Message: No Email', 'signals' ); ?></label>
					<input type="text" name="signals_csmm_message_noemail" id="signals_csmm_message_noemail" value="<?php echo esc_attr_e( $signals_csmm_options['message_noemail'] ); ?>" placeholder="<?php esc_attr_e( 'Message when email is not provided', 'signals' ); ?>" class="signals-form-control">

					<p class="signals-form-help-block"><?php _e( 'Provide error message to show if the user forgets to provide email address.', 'signals' ); ?></p>
				</div>

				<div class="signals-form-group">
					<label for="signals_csmm_message_subscribed" class="signals-strong"><?php _e( 'Message: Already Subscribed', 'signals' ); ?></label>
					<input type="text" name="signals_csmm_message_subscribed" id="signals_csmm_message_subscribed" value="<?php echo esc_attr_e( $signals_csmm_options['message_subscribed'] ); ?>" placeholder="<?php esc_attr_e( 'Message when user is already subscribed', 'signals' ); ?>" class="signals-form-control">

					<p class="signals-form-help-block"><?php _e( 'Provide message to show if the user is already subscribed to the mailing list.', 'signals' ); ?></p>
				</div>
			</div>

			<div class="signals-double-group signals-clearfix">
				<div class="signals-form-group">
					<label for="signals_csmm_message_wrong" class="signals-strong"><?php _e( 'Message: General Error', 'signals' ); ?></label>
					<input type="text" name="signals_csmm_message_wrong" id="signals_csmm_message_wrong" value="<?php echo esc_attr( $signals_csmm_options['message_wrong'] ); ?>" placeholder="<?php esc_attr_e( 'Message when anything goes wrong while subscribing', 'signals' ); ?>" class="signals-form-control">

					<p class="signals-form-help-block"><?php _e( 'Provide general error message to show if anything goes wrong while subscribing.', 'signals' ); ?></p>
				</div>

				<div class="signals-form-group">
					<label for="signals_csmm_message_done" class="signals-strong"><?php _e( 'Message: Successfully Subscribed', 'signals' ); ?></label>
					<input type="text" name="signals_csmm_message_done" id="signals_csmm_message_done" value="<?php echo esc_attr( $signals_csmm_options['message_done'] ); ?>" placeholder="<?php esc_attr_e( 'Success message when the user gets subscribed', 'signals' ); ?>" class="signals-form-control">

					<p class="signals-form-help-block"><?php _e( 'Provide message to show when the user gets subscribed successfully.', 'signals' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</div><!-- #email -->
