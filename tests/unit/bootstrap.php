<?php

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

/**
 * Unit Tests Bootstrap
 *
 * @since 1.3.2
 */
class Unit_Tests_Bootstrap {

	/** @var \Unit_Tests_Bootstrap instance */
	protected static $instance = null;

	/** @var string directory where wordpress-tests-lib    is installed */
	public $wp_tests_dir;

	/** @var string testing directory */
	public $tests_dir;

	/** @var string plugin directory */
	public $plugin_dir;

	/**
	 * Setup the unit testing environment
	 *
	 * @since 1.3.2
	 */
	public function __construct() {

		ini_set( 'display_errors', 'on' );
		error_reporting( E_ALL );

		// Ensure server variable is set for WP email functions.
		if ( ! isset( $_SERVER['SERVER_NAME'] ) ) {
			$_SERVER['SERVER_NAME'] = 'localhost';
		}

		$this->tests_dir    = dirname( __FILE__ );
		$this->plugin_dir   = dirname( dirname( $this->tests_dir ) );
		$this->wp_tests_dir = getenv( 'WP_TESTS_DIR' ) ? getenv( 'WP_TESTS_DIR' ) : '/tmp/wordpress-tests-lib';
		$manual_bootstrap   = isset( $GLOBALS['manual_bootstrap'] ) ? (bool) $GLOBALS['manual_bootstrap'] : true;

		// Load test function so tests_add_filter() is available
		require_once $this->wp_tests_dir . '/includes/functions.php';

		// Load the WP testing environment
		if ( $manual_bootstrap ) {
			require_once $this->wp_tests_dir . '/includes/bootstrap.php';

			// Load Give testing framework
			// Note: you must copy code of this function to your include function of bootstrap class
			// Or use Unit_Tests_Bootstrap::includes();
			$this->includes();
		}
	}

	/**
	 * Load specific test cases
	 *
	 * @since 1.3.2
	 */
	public function includes() {
	}

	/**
	 * Get the single class instance.
	 *
	 * @since 1.3.2
	 * @return Unit_Tests_Bootstrap
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}

Unit_Tests_Bootstrap::instance();
