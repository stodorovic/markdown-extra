<?php

/**
 * Class
 */
class Tests_Markdown extends Markdown_Unit_Test_Case {

	/**
	 * Set it up
	 */
	public function setUp() {
		parent::setUp();
	}

	/**
	 * Test filter
	 *
	 */
	public function test_the_content_filter() {
		global $post;

		// Create a post
		$this->_post_id = $this->factory->post->create(
			array(
				'post_title'   => 'Test Post',
				'post_type'    => 'post',
				'post_content' => "# This is an H1\n\n* Red\n* Green\n* Blue\n",
				'post_status'  => 'publish',
			)
		);

		$this->go_to( get_permalink( $this->_post_id ) );
		
		$this->assertSame(
			apply_filters( 'the_content', $post->post_content ),
			"<h1>This is an H1</h1>\n\n<ul>\n<li>Red</li>\n<li>Green</li>\n<li>Blue</li>\n</ul>\n"
		);
	}
}