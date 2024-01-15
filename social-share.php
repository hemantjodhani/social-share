<?php
/**
 * Plugin Name: Social Share
 * Description: A truly amazing plugin.
 * Version: 1.0
 * Author: Hemant
 */

define( 'SOCIAL_SHARE_PLUGIN_PATH', __FILE__ );
define( 'SOCIAL_SHARE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


/** This function includes the settings page. */
function menu_page() {
	include 'includes/social-code.php';
}
/**  This function is for registration of submenu .*/
function admin_page() {
	add_submenu_page( 'options-general.php', 'Social share', 'Social share', 'manage_options', 'socialShare', 'menu_page' );
}
add_action( 'admin_menu', 'admin_page' );

/**  Get social buttons function print selected icons on blog page .*/
function get_social_buttons() {
	if ( is_single() ) {

		$selected_handles = get_option( 'selected_social_handles' );

		foreach ( $selected_handles as $key => $value ) {
			if ( 'linkedin' === $value ) { ?>
				<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() ); ?>&title=<?php echo esc_attr( get_the_title() ); ?>"><img src="<?php echo SOCIAL_SHARE_PLUGIN_URL . 'includes/images/icons8-linkedin-48.png'; ?>"></a>
			<?php } elseif ( 'twitter' === $value ) { ?>
				<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo esc_attr( get_the_title() ); ?>"><img src="<?php echo SOCIAL_SHARE_PLUGIN_URL . 'includes/images/icons8-twitterx-48.png'; ?>"></a>
			<?php } elseif ( 'facebook' === $value ) { ?>
				<a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" title="Share on Facebook"><img src="<?php echo SOCIAL_SHARE_PLUGIN_URL . 'includes/images/icons8-facebook-48.png'; ?>"></a>
			<?php } elseif ( 'pinterest' === $value ) { ?>
				<a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url( get_the_post_thumbnail_url() ); ?>&description=<?php echo esc_attr( get_the_title() ); ?>" title="Share on Pinterest"><img src="<?php echo SOCIAL_SHARE_PLUGIN_URL . 'includes/images/icons8-pinterest-50.png'; ?>"></a>
				<?php
			} elseif ( 'mailto' === $value ) {
				$author_email = get_the_author_meta( 'user_email' );
				?>
				<a href="mailto:<?php echo esc_attr( $author_email ); ?>"><img src="<?php echo SOCIAL_SHARE_PLUGIN_URL . 'includes/images/email.png'; ?>"></a>
			<?php }
		}
	}
}
?>
