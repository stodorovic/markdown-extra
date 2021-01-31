<?php

/**
 * Class
 */
class Tests_Markdown extends Markdown_Unit_Test_Case {

	protected $_post_id = null;

	/**
	 * Set it up
	 */
	public function setUp() {
		parent::setUp();

		// Create a post
		$this->_post_id = $this->factory->post->create(
			array(
				'post_title'   => 'Test Post',
				'post_type'    => 'post',
				'post_content' => "# This is an H1\n\n* Red\n* Green\n* Blue\n",
				'post_status'  => 'publish',
			)
		);

	}

	/**
	 * Test filter
	 *
	 */
	public function test_filter() {
		global $post;

		$this->go_to( get_permalink( $this->_post_id ) );
		
		//var_dump( $GLOBALS['post'] );
		var_dump( apply_filters( 'the_content', $post->post_content ) );
		//var_dump( the_content() );
	}
}
