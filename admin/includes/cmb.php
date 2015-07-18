<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category FireTree_Plugin_Repo
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'firetree_plugin_repo_fields' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function firetree_plugin_repo_fields( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['firetree_plugin_repo_file'] = array(
		'id'         => 'firetree_plugin_repo_file',
		'title'      => __( 'Plugin File', 'cmb' ),
		'pages'      => array( 'firetree_plugin_repo', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Plugin ZIP file', 'cmb' ),
				'desc' => __( 'Upload or enter the URL to the plugin zip file.', 'cmb' ),
				'id'   => $prefix . 'plugin_zip',
				'type' => 'file',
			),
		),
	);
	
	$meta_boxes['firetree_plugin_repo_description'] = array(
		'id'         => 'firetree_plugin_repo_description',
		'title'      => __( 'Plugin Description Panel', 'cmb' ),
		'pages'      => array( 'firetree_plugin_repo', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => __( 'Description', 'cmb' ),
				//'desc'    => __( '', 'cmb' ),
				'id'      => $prefix . 'plugin_description',
				'type'    => 'wysiwyg',
				'options' => array( 'textarea_rows' => 10, ),
			),
		),
	);
	
	$meta_boxes['firetree_plugin_repo_changelog'] = array(
		'id'         => 'firetree_plugin_repo_changelog',
		'title'      => __( 'Plugin Changelog Panel', 'cmb' ),
		'pages'      => array( 'firetree_plugin_repo', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => __( 'Changelog', 'cmb' ),
				//'desc'    => __( 'Plugin changelog', 'cmb' ),
				'id'      => $prefix . 'plugin_changelog',
				'type'    => 'wysiwyg',
				'options' => array( 'textarea_rows' => 15, ),
			),
		),
	);
	
	$meta_boxes['firetree_plugin_repo_faq'] = array(
		'id'         => 'firetree_plugin_repo_faq',
		'title'      => __( 'Plugin FAQ Panel', 'cmb' ),
		'pages'      => array( 'firetree_plugin_repo', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => __( 'FAQ', 'cmb' ),
				//'desc'    => __( 'Plugin changelog', 'cmb' ),
				'id'      => $prefix . 'plugin_faq',
				'type'    => 'wysiwyg',
				'options' => array( 'textarea_rows' => 15, ),
			),
		),
	);
	
	$meta_boxes['firetree_plugin_repo_version'] = array(
		'id'         => 'firetree_plugin_repo_version',
		'title'      => __( 'Plugin Version Info', 'cmb' ),
		'pages'      => array( 'firetree_plugin_repo', ), // Post type
		'context'    => 'side',
		'priority'   => 'low',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Version', 'cmb' ),
				'desc' => __( 'Latest version of your plugin', 'cmb' ),
				'id'   => $prefix . 'plugin_version',
				'type' => 'text_small',
			),
			array(
				'name' => __( 'Release Date', 'cmb' ),
				'desc' => __( 'Latest version release date', 'cmb' ),
				'id'   => $prefix . 'plugin_release_date',
				'type' => 'text_datetime_timestamp',
			),
			array(
				'name' => __( 'Required WP', 'cmb' ),
				'desc' => __( 'Required WordPress version', 'cmb' ),
				'id'   => $prefix . 'plugin_required_wp',
				'type' => 'text_small',
			),
			array(
				'name' => __( 'Tested WP', 'cmb' ),
				'desc' => __( 'Tested WordPress version', 'cmb' ),
				'id'   => $prefix . 'plugin_tested_wp',
				'type' => 'text_small',
			),
		),
	);
	
	$meta_boxes['firetree_plugin_repo_download_count'] = array(
		'id'         => 'firetree_plugin_repo_download_count',
		'title'      => __( 'Download Counter', 'cmb' ),
		'pages'      => array( 'firetree_plugin_repo', ), // Post type
		'context'    => 'side',
		'priority'   => 'low',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' 		=> __( 'Downloaded', 'cmb' ),
				'id'   		=> $prefix . 'plugin_download_count',
				'desc'		=> __( 'Number of updates served', 'cmb' ),
				'default'	=> '1',
				'type' 		=> 'text_medium',
			),
		),
	);
	
	$meta_boxes['firetree_plugin_repo_config'] = array(
		'id'         => 'firetree_plugin_repo_config',
		'title'      => __( 'Updater Configuration', 'cmb' ),
		'pages'      => array( 'firetree_plugin_repo', ), // Post type
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' 			=> __( 'Update Code', 'cmb' ),
				'desc' 			=> __( 'Add this code to your main plugin file and copy FTPR_Auto_Update.php to the root directory of your plugin.', 'cmb' ),
				'id'   			=> $prefix . 'plugin_update_code',
				'type' 			=> 'ftpr_textarea_code',
				'attributes'	=> array(
					'readonly'		=> true,
					),
			),
		),
	);

	return $meta_boxes;
}

add_action( 'init', 'firetree_plugin_repo_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function firetree_plugin_repo_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'cmb/init.php';

}

/**
 * Create new field types
 */
add_action( 'cmb_render_plugin_repo_slug', 'firetree_plugin_repo_render_slug', 10, 5 );
function firetree_plugin_repo_render_slug( $field_args, $escaped_value, $object_id, $object_type, $field_type_object ) {
	$post_data = get_post( $field_type_object->field->object_id, ARRAY_A );
	echo '<input type="text" class="cmb_text_medium" readonly="readonly" value="' . $post_data['post_name'] . '" />';
	echo '<p class="cmb_metabox_description">' . $field_args['desc'] . '</p>';
}

add_action( 'cmb_render_plugin_remote_path', 'firetree_plugin_repo_render_remote_path', 10, 5 );
function firetree_plugin_repo_render_remote_path( $field_args, $escaped_value, $object_id, $object_type, $field_type_object ) {
	echo '<input type="text" class="cmb_text_medium" readonly="readonly" value="' . site_url( FIRETREE_PLUGIN_REPO_SLUG ) . '" />';
	echo '<p class="cmb_metabox_description">' . $field_args['desc'] . '</p>';
}

add_action( 'cmb_render_ftpr_textarea_code', 'firetree_plugin_repo_render_textarea_code', 10, 5 );
function firetree_plugin_repo_render_textarea_code( $field_args, $escaped_value, $object_id, $object_type, $field_type_object ) {
	$site_url = '';
	if ( is_multisite() ) {
		$site_url = network_site_url();
	} else {
		$site_url = get_site_url();
	}
	
	$post_data = get_post( $field_type_object->field->object_id, ARRAY_A );
	
	$plugin_update_code = '/*----------------------------------------------------------------------------*' . PHP_EOL;
	$plugin_update_code .= ' * FireTree Plugin Repo - Auto Update' . PHP_EOL;
	$plugin_update_code .= ' *----------------------------------------------------------------------------*/' . PHP_EOL;
	$plugin_update_code .= 'if ( ! class_exists( \'FTPR_Auto_Update\' ) ) {' . PHP_EOL;
	$plugin_update_code .= '	include( dirname( __FILE__ ) . \'/FTPR_Auto_Update.php\' );' . PHP_EOL;
	$plugin_update_code .= '}' . PHP_EOL;
	$plugin_update_code .= '' . PHP_EOL;
	$plugin_update_code .= 'function ' . str_replace( '-', '_', $post_data['post_name'] ) . '_updater() {' . PHP_EOL;
	$plugin_update_code .= '	$ftpr_updater = new FTPR_Auto_Update( \'' . $site_url . '\', plugin_basename( __FILE__ ), array( ' . PHP_EOL;
	$plugin_update_code .= '			\'version\'	=> \'' . get_post_meta( $post_data['ID'], '_cmb_plugin_version', true ) . '\',' . PHP_EOL;
	$plugin_update_code .= '			\'plugin_id\'	=> \'' . $post_data['post_name'] . '\'' . PHP_EOL;
	$plugin_update_code .= '		)' . PHP_EOL;
	$plugin_update_code .= '	);' . PHP_EOL;
	$plugin_update_code .= '}' . PHP_EOL;
	$plugin_update_code .= 'add_action( \'admin_init\', \'' . str_replace( '-', '_', $post_data['post_name'] ) . '_updater\' );' . PHP_EOL;
	
	//$plugin_update_code .= 'function FTPR_Activate_Auto_Update() {' . PHP_EOL;
	//$plugin_update_code .= '    if ( ! class_exists( \'FTPR_Auto_Update\' ) ) {' . PHP_EOL;
	//$plugin_update_code .= '        require_once (\'FTPR_Auto_Update.php\');' . PHP_EOL;
	//$plugin_update_code .= '    }' . PHP_EOL;
	//$plugin_update_code .= '    $FTPR_Plugin_Current_Version = \'\';' . PHP_EOL;
	//$plugin_update_code .= '    $FTPR_Plugin_Id = \'\';' . PHP_EOL;
    //$plugin_update_code .= '    $FTPR_Plugin_Remote_Path = \'' . $site_url . '\';' . PHP_EOL;
	//$plugin_update_code .= '    $FTPR_Plugin_Slug = plugin_basename(__FILE__);' . PHP_EOL;
    //$plugin_update_code .= '    new FTPR_Auto_Update ($FTPR_Plugin_Current_Version, $FTPR_Plugin_Remote_Path, $FTPR_Plugin_Slug, $FTPR_Plugin_Id);' . PHP_EOL;
	//$plugin_update_code .= '}';

	
	echo '<pre>';
	echo '<textarea class="cmb_textarea_code" cols="60" rows="15" readonly="1">' . $plugin_update_code . '</textarea>';
	echo '</pre>';
	echo '<p class="cmb_metabox_description">' . $field_args['desc'] . '</p>';
}