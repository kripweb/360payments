<?php

/**
 * Provide a admin header view for the plugin
 *
 * @link       http://www.webfactoryltd.com
 * @since      0.1
 */

?>

<div class="signals-cnt-fix">
	<div class="signals-fix-wp38">
		<div class="signals-header signals-clearfix">
			<img src="<?php echo SIGNALS_CSMM_URL; ?>/framework/admin/img/lrg-icon.png" class="signals-logo">
			<p>
				<strong><?php _e( 'Maintenance Mode', 'signals' ); ?></strong>
				<span><?php _e( 'by', 'signals' ); ?> <a href="http://www.webfactoryltd.com/" target="_blank"><?php _e( 'Web Factory Ltd', 'signals' ); ?></a></span>
			</p>

			<?php if ( isset( $signals_header_addon ) ) { echo $signals_header_addon; } ?>
		</div><!-- .signals-header -->
    