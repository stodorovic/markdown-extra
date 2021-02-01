<?php

/**
 * @package   Markdown_Extra\Unit_Tests_Bootstrap
 *
 * Unit Tests Bootstrap
 */
class Unit_Tests_Bootstrap {

	/**
	 * Holds instance.
	 *
	 * @var \Unit_Tests_Bootstrap
	 */
	protected static $instance = null;

	/**
	 * Directory where wordpress-tests-lib is installed.
	 *
	 * @var string
	 */
	public $wp_tests_dir;

	/** @var string testing directory */
	public $tests_dir;

	/** @var string plugin directory */
	public $plugin_dir;

	/**
	 * Setup the unit testing environment
	 */
	public function __construct() {

		// Ensure server variable is set for WP email functions.
		if ( ! isset( $_SERVER['SERVER_NAME'] ) ) {
			$_SERVER['SERVER_NAME'] = 'localhost';
		}

		$this->tests_dir    = dirname( __FILE__ );
		$this->plugin_dir   = dirname( dirname( $this->tests_dir ) );
		$this->wp_tests_dir = getenv( 'WP_TESTS_DIR' ) ? getenv( 'WP_TESTS_DIR' ) : '/tmp/wordpress-tests-lib';
		$manual_bootstrap   = isset( $GLOBALS['manual_bootstrap'] ) ? (bool) $GLOBALS['manual_bootstrap'] : true;

		// Load test function so tests_add_filter() is available.
		require_once $this->wp_tests_dir . '/includes/functions.php';

		// Load plugin.
		tests_add_filter( 'muplugins_loaded', array( $this, 'load_markdown_extra' ) );

		// Load the WP testing environment.
		if ( $manual_bootstrap ) {
			require_once $this->wp_tests_dir . '/includes/bootstrap.php';

			// Load testing framework
			// Note: you must copy code of this function to your include function of bootstrap class
			// Or use Unit_Tests_Bootstrap::includes();
			$this->includes();
		}
	}

	/**
	 * Load plugin.
	 */
	public function load_markdown_extra() {
		require_once $this->plugin_dir . '/markdown-extra.php';
	}

	/**
	 * Load specific test cases.
	 */
	public function includes() {

		// Test cases.
		require_once $this->tests_dir . '/framework/class-markdown-unit-test-case.php';
	}

	/**
	 * Get the single class instance.
	 *
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
