<?php
function firetree_plugin_repo_updater() {

	if ( isset( $_GET[ 'action' ] ) && isset( $_GET[ 'plugin_id' ] ) ) {
	
		if ( $_GET[ 'action' ] != 'ftpr_update' ) {
			exit();
		}
		
		$plugin_id = '';

		if ( isset( $_GET[ 'plugin_id' ] ) ) {
			$plugin_id = $_GET[ 'plugin_id' ];
		}
		
		$args = array(
			'post_type' 		=> 'firetree_plugin_repo',
			'posts_per_page'	=> 1,
			'name'				=> $plugin_id,
			);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			global $post;
	
			if (isset($_POST['action'])) {
				
				switch ($_POST['action']) {
					
					case 'version':
						
						echo get_post_meta( $post->ID, '_cmb_plugin_version', true );
						break;
						
					case 'info':
						
						if ( is_multisite() ) {
							$site_url = network_site_url();
						} else {
							$site_url = site_url();
						}
						
						$response = array(
							'author'		=> get_the_author_meta( 'display_name', $post->post_author ),
							'homepage'		=> (string) $site_url . '/',
							//$obj->rating = ''; // rating 0-100% shows as 5 stars
							//$obj->num_ratings = ''; // shows below stars, "based on xxxx ratings"
							'slug'			=> $post->post_name,
							'name'			=> $post->post_title,
							//$obj->plugin_name = $post->post_title;
							//$obj->new_version = get_post_meta( $post->ID, '_cmb_plugin_version', true );
							'version'		=> get_post_meta( $post->ID, '_cmb_plugin_version', true ),
							'requires'		=> get_post_meta( $post->ID, '_cmb_plugin_required_wp', true ),
							'tested'		=> get_post_meta( $post->ID, '_cmb_plugin_tested_wp', true ),
							'downloaded'	=> get_post_meta( $post->ID, '_cmb_plugin_download_count', true ),
							'last_updated'	=> human_time_diff( get_post_meta( $post->ID, '_cmb_plugin_release_date', true ), current_time( 'timestamp', 1 ) ) . ' ago',
							//$obj->last_updated = (string) gmdate( 'm-d-Y', get_post_meta( $post->ID, '_cmb_plugin_release_date', true ) );
							'sections'		=> serialize(
								array(
									'description'	=> wpautop( strip_tags( stripslashes( get_post_meta( $post->ID, '_cmb_plugin_description', true ) ), '<p><li><ul><ol><strong><a><em><span><br>' ) ),
									'changelog'		=> wpautop( strip_tags( stripslashes( get_post_meta( $post->ID, '_cmb_plugin_changelog', true ) ), '<p><li><ul><ol><strong><a><em><span><br>' ) ),
									'faq'			=> wpautop( strip_tags( stripslashes( get_post_meta( $post->ID, '_cmb_plugin_faq', true ) ), '<p><li><ul><ol><strong><a><em><span><br>' ) ),
								)
							),
							'download_link'	=> get_post_meta( $post->ID, '_cmb_plugin_zip', true ),
						);
						echo json_encode( $response );
				}
					
			} else {
				// Increment the counter
				$download_count = get_post_meta( $post->ID, '_cmb_plugin_download_count', true );
				if ( $download_count == '' || $download_count == null || $download_count == '0' ) {
					$download_count == 1;
				} else {
					(int)$download_count++;
				}
				update_post_meta( $post->ID, '_cmb_plugin_download_count', $download_count );
				
				header('Cache-Control: public');
				header('Content-Description: File Transfer');
				header('Content-Type: application/zip');
				echo file_get_contents( get_post_meta( $post->ID, '_cmb_plugin_zip', true ) );
			}
		
		endwhile;
		
		exit();
	}

}
add_action( 'template_redirect', 'firetree_plugin_repo_updater' );
?>