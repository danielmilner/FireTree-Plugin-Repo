<?php
/**
 * FireTree Plugin Repos.
 *
 * @package   FTPR_Auto_Update
 * @author    Daniel Milner <daniel@firetreedesign.com>
 * @version   1.1
 * @license   GPL-2.0+
 * @link      http://firetreedesign.com/
 * @copyright 2014 FireTree Design
 */
class FTPR_Auto_Update
{
	/**
	 * The plugin current version
	 * @var string
	 */
	public $current_version;
 
	/**
	 * The plugin remote update path
	 * @var string
	 */
	public $update_path;
 
	/**
	 * Plugin Slug (plugin_directory/plugin_file.php)
	 * @var string
	 */
	public $plugin_slug;
 
	/**
	 * Plugin name (plugin_file)
	 * @var string
	 */
	public $slug;
 
	/**
	 * Initialize a new instance of the WordPress Auto-Update class
	 * @param string $current_version
	 * @param string $update_path
	 * @param string $plugin_slug
	 * @param string $plugin_id
	 */
	function __construct( $update_path, $plugin_slug, $api_data = null )
	{
		// Set the class public variables
		$this->current_version = $api_data['version'];
		$this->update_path = $update_path;
		if ( substr( $this->update_path, -1 ) !== '/' ) {
			$this->update_path = $this->update_path . '/';
		}
		$this->update_path = $this->update_path . '?action=ftpr_update&plugin_id=' . $api_data['plugin_id'];
		$this->plugin_slug = $plugin_slug;
		list ($t1, $t2) = explode('/', $plugin_slug);
		$this->slug = str_replace('.php', '', $t2);
		$this->slug = str_replace('.php', '', $plugin_slug);
 
		// define the alternative API for updating checking
		add_filter('pre_set_site_transient_update_plugins', array(&$this, 'check_update'));
 
		// Define the alternative response for information checking
		add_filter('plugins_api', array(&$this, 'check_info'), 10, 3);
	}
 
	/**
	 * Add our self-hosted autoupdate plugin to the filter transient
	 *
	 * @param $transient
	 * @return object $ transient
	 */
	public function check_update( $transient )
	{
		// For some reason this breaks update checks
		if ( empty( $transient->checked ) ) {
			return $transient;
		}
 
		// Get the remote version
		$remote_version = $this->getRemote_version();
 
		// If a newer version is available, add the update
		if (version_compare($this->current_version, $remote_version, '<')) {
			$obj = new stdClass();
			$obj->slug = $this->slug;
			$obj->new_version = $remote_version;
			$obj->url = $this->update_path;
			$obj->package = $this->update_path;
			$transient->response[$this->plugin_slug] = $obj;
		}
		//var_dump($transient);
		return $transient;
	}
 
	/**
	 * Add our self-hosted description to the filter
	 *
	 * @param boolean $false
	 * @param array $action
	 * @param object $arg
	 * @return bool|object
	 */
	public function check_info($false, $action, $arg)
	{
		if ($arg->slug === $this->slug) {
			$information = $this->getRemote_information();
			$information->slug = $this->slug;
			return $information;
		}
		return $false;
	}
 
	/**
	 * Return the remote version
	 * @return string $remote_version
	 */
	public function getRemote_version()
	{
		$request = wp_remote_post( $this->update_path, array( 'body' => array( 'action' => 'version' ) ) );
		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			$request = wp_remote_retrieve_body( $request );
			return $request;
			//return $request[ 'body' ];
		}
		return false;
	}
 
	/**
	 * Get information about the remote version
	 * @return bool|object
	 */
	public function getRemote_information()
	{
		$request = wp_remote_post( $this->update_path, array( 'body' => array( 'action' => 'info' ) ) );
		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			$request = json_decode( wp_remote_retrieve_body( $request ) );
			if ( $request && isset( $request->sections ) ) {
				$request->sections = maybe_unserialize( $request->sections );
			}
			return $request;
			//return unserialize( $request[ 'body' ] );
		}
		return false;
	}
 
}
?>