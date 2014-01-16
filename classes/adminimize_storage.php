<?php
/**
 * Adminimizer storage class
 *
 * PHP version 5.2
 *
 * @category   PHP
 * @package    WordPress
 * @subpackage Inpsyde\Adminimize
 * @author     Ralf Albert <me@neun12.de>
 * @license    GPLv3 http://www.gnu.org/licenses/gpl-3.0.txt
 * @version    1.0
 * @link       http://wordpress.com
 */

if ( ! class_exists( 'Adminimize_Storage' ) ) {

class Adminimize_Storage extends ExtendedStandardClass
{
	/**
	 * ID for the ExtendedStandardClass
	 * @var string
	 */
	const ID = 'adminimize_storage';

	/**
	 * Key for options in database
	 * @var string
	 */
	const OPTION_KEY = 'adminimizeOOP';

	public function __construct() {

		$this->set_id( self::ID );

	}

	/**
	 * Setup some base directories
	 * @param string $filename File inside the base directories
	 */
	public function set_basedirs( $filename ) {

		$basedir = dirname( $filename );

		$this->basefile      = $filename;
		$this->basedir       = $basedir;
		$this->basejs        = $basedir . '/js/';
		$this->basename      = plugin_basename( $filename );
		$this->basefolder    = plugin_basename( dirname( $filename ) );
		$this->MW_ADMIN_FILE = plugin_basename( $filename );
		$this->widgets_dir   =  $basedir . 'widgets';

// 		self::set( 'basecss',  $basedir . '/css/' );
// 		self::set( 'classes',  $basedir . '/classes/');


	}

	/**
	 * Get an option from the database
	 * @param string $name Name of the option
	 * @return mixed
	 */
	public function get_option( $name = '' ) {

		// check for use on multisite
		if ( is_multisite() && is_plugin_active_for_network( $this->MW_ADMIN_FILE ) )
			$adminimizeoptions = get_site_option( self::OPTION_KEY );
		else
			$adminimizeoptions = get_option( self::OPTION_KEY );

		// return all options if no name is set
		if ( empty( $name ) )
			return $adminimizeoptions;

		// return specified option
		return ( isset( $adminimizeoptions[$name] ) ) ?
			( $adminimizeoptions[$name] ) : null;

	}

	/**
	 * Set an option in the database
	 * @param string $name Name of the option
	 * @param mixed $value Value to be set
	 */
	public function set_option( $name = '', $value = null ) {

		if ( empty( $name ) )
			return  false;

		$options = $this->get_option();

		$options[$name] = $value;

		if ( is_multisite() && is_plugin_active_for_network( $this->MW_ADMIN_FILE ) )
			return update_site_option( self::OPTION_KEY, $options );
		else
			return update_option( self::OPTION_KEY, $options );

	}

	/**
	 * Get custom options
	 * @param string $option_name
	 * @return array	$anon	Array in format array( 'options' => [array], 'values' => [array] )
	 */
	public function get_custom_options( $option_name = '' ) {

		$custom_options = $this->get_option( $option_name . '_custom' );

		return ( empty( $custom_options ) ) ?
			array( 'options' => array(), 'values' => array(), 'original' => array() ) :
			array(
				'options'  => array_keys( $custom_options ),
				'values'   => array_values( $custom_options ),
				'original' => $custom_options
			);

	}

}

}