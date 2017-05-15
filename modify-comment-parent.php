<?php
/**
 * Plugin Name: Modify Comment Parent
 * Plugin URI: http://salferrarello.com/modify-comment-parent-wordpress-plugin/
 * Description: Add a Comment Parent Field to the Edit Comment page.
 * Version: 1.0.1
 * Author: Sal Ferrarello
 * Author URI: http://salferrarello.com/
 * Text Domain: modify-comment-parent
 * Domain Path: /languages
 *
 * @package modify-comment-parent
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'admin_menu', 'fe_mcp_add_meta_box' );            // Add the meta box.
add_action( 'edit_comment', 'fe_mcp_update_comment_parent' ); // Update the value on save.

/**
 * Define our Parent Comment ID metabox.
 */
function fe_mcp_add_meta_box() {
	add_meta_box( 'fe_mcp_parent_comment_id', 'Parent Comment ID', 'fe_mcp_add_meta_box_callback', 'comment', 'normal', 'high' );
}

/**
 * Output the metabox for the Parent Comment ID.
 *
 * @param WP_Comment $comment The comment currently being editted.
 */
function fe_mcp_add_meta_box_callback( $comment ) {

	// Add an nonce field so when we process the call, we can confirm it came from this form.
	wp_nonce_field( 'fe_modify_comment_parent', 'fe_modify_comment_parent_nonce' );
?>
	<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">Parent Comment ID</th>
			<td>
				<p><input type="text" name="fe_mcp_parent_comment_id" id="fe-mcp-parent-comment-id" value="<?php echo esc_attr( $comment->comment_parent ); ?>"></p>
			</td>
		</tr>
	</tbody>
	</table>
<?php
}

/**
 * Update comment parent on save.
 */
function fe_mcp_update_comment_parent() {
	$comment_parent = intval( filter_input( INPUT_POST, 'fe_mcp_parent_comment_id', FILTER_VALIDATE_INT ) );
	$comment_id     = intval( filter_input( INPUT_POST, 'comment_ID', FILTER_VALIDATE_INT ) );
	$nonce          = filter_input( INPUT_POST, 'fe_modify_comment_parent_nonce', FILTER_SANITIZE_STRING );

	if ( ! $comment_id ) {
		// We don't have a comment to modify, make no changes.
		return;
	}

	if ( ! $nonce ) {
		// We do not have a nonce value, make no changes.
		return $post_id;
	}

	if ( ! wp_verify_nonce( $nonce, 'fe_modify_comment_parent' ) ) {
		// Our nonce value does not match the value we set, make no changes.
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		// This is an autosave, our form has not been submitted, make no changes.
		return;
	}

	if ( ! current_user_can( 'edit_comment', $comment_id ) ) {
		// The current user is not allowed to edit this comment, make no changes.
		return;
	}

	// Remove hooked function so we don't have an infinite loop.
	remove_action( 'edit_comment', 'fe_mcp_update_comment_parent' );

	// Update the comment_parent of our comment.
	wp_update_comment( array(
		'comment_ID'     => $comment_id,
		'comment_parent' => $comment_parent,
	) );

	// Add back the hooked function we removed.
	add_action( 'edit_comment', 'fe_mcp_update_comment_parent' );
}
