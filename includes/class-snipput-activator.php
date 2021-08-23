<?php

/**
 * Fired during plugin activation
 *
 * @link       https://tylerkanz.com
 * @since      1.0.0
 *
 * @package    Snipput
 * @subpackage Snipput/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Snipput
 * @subpackage Snipput/includes
 * @author     Tyler Kanz <tylerkanz@gmail.com>
 */
class Snipput_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		//Create Snipput Front page
		if (is_null(get_page_by_title('Snipputs'))) {
			$add_snipputs = array(
				'post_title'    => wp_strip_all_tags('Snipputs'),
				'post_content'  => '[snipputs]',
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_type'     => 'page',
			);

			// Insert the post into the database
			wp_insert_post($add_snipputs);
		}

		//Create Snipput Entry Page
		if (is_null(get_page_by_title('Enter a Snipput'))) {
			$add_add_snipputs = array(
				'post_title'    => wp_strip_all_tags('Enter a Snipput'),
				'post_content'  => '[enter_a_snipput]',
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_type'     => 'page',
			);

			// Insert the post into the database
			wp_insert_post($add_add_snipputs);
		}

		//Create Snipput DB Table
		$new_cat = wp_insert_category(array('cat_name' => 'Snipputs', 'category_description' => 'Category to house your Snipputs', 'category_nicename' => 'snipputs'));

		$hello_world_post = array(
			'post_title'    => 'Hello from Snipput',
			'post_content'  => "<html>\n <body>\n <h1>Hello World</h1>\n </body>\n</html>",
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_category' => array($new_cat)
		  );
		  
		  // Insert the post into the database
		  wp_insert_post( $hello_world_post );

		  
	}
}
