<?php
$all_handles = array( 'Twitter', 'Facebook', 'LinkedIn', 'Pinterest', 'Mailto' );
if ( isset( $_POST['save'] ) ) {
	if ( wp_verify_nonce( $_POST['hs_nonce'], 'hs_form' ) ) {
		$selected_handles = $_POST['social_handle'];
	}
	if ( get_option( 'selected_social_handles', -1 ) === -1 ) {
		add_option( 'selected_social_handles', $selected_handles );
	} else {
		update_option( 'selected_social_handles', $selected_handles );
	}
}
?>

<h1>Welcome to my first plugin task</h1>
<form action="options-general.php?page=socialShare" method="post">
	<?php wp_nonce_field( 'hs_form', 'hs_nonce' ); ?>
	<ul>
		<?php
		$selected = get_option( 'selected_social_handles' );
		foreach ( $all_handles as $handle ) {
			?>
			<li>
				<input type="checkbox" value="<?php echo strtolower( $handle ); ?>" name="social_handle[]" id="<?php echo $handle; ?>"
					<?php
					if ( $selected ) {
						if ( in_array( strtolower( $handle ), $selected ) ) {
							echo 'checked'; }
					}
					?>
					>
				<label for="<?php echo $handle; ?>"><?php echo $handle; ?></label>
			</li>
		<?php } ?>
	</ul>
	<input type="submit" class="button action" value="Save Changes" name="save">
</form>
