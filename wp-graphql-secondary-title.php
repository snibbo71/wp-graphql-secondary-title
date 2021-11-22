<?php
/**
 * Plugin Name:     WPGraphQL Generate Secondary Title
 * Plugin URI:      https://github.com/snibbo71/wp-graphql-secondary-title
 * Description:     A WPGraphQL Extension that adds the secondary title from the secondary title plugin which must be installed. The secondary title plugin is available from https://en-gb.wordpress.org/plugins/secondary-title/
 * Author:          Steve Brown
 * Author URI:      https://www.most-useful.com/
 * Version:         1.0.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

/* Note that unless you have Jason Bahl's WPGraphQL WordPress plugin, this will do nothing */
add_action( 'graphql_register_types', function() {

        register_graphql_field( 'ContentNode', 'secondaryTitle', [
                'type' => 'String',
                'description' => 'Adds a secondary title to the tree',
                'resolve' => function( \WPGraphQL\Model\Post $post, $args, $context, $info ) {
                        if ( function_exists('get_secondary_title') ) {
                                $title = get_secondary_title($post->databaseId);
                                return $title;
                        } else {
                                return 'Secondary Title Plugin Not Installed';
                        }
                },
        ]);

} );
