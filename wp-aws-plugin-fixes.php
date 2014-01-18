<?php
/**
 * Plugin Name: AWS Plugin Fixes
 * Plugin URI: https://github.com/scottylogan/wp-aws-plugin-fixes
 * Description: Quick fixes for some AWS plugins
 * Author: Scotty Logan
 * Author URI: https://github.com/scottylogan
 * Version: 0.1.0
 *
 */

/**
 * fix up the aws client factory initialization args
 * to use the Oregon (us-west-2) region, rather than Virginia (us-east-1)
 */

function aws_get_client_args_filter ( $args ) {
  $args['region'] = 'us-west-2';
  return $args;
}

/**
 * If you've got SSL enabled for logged in users, the S3 plugin
 * will make all the URLs https://, even if you don't check the
 * 'always use https' option.  This undoes that.
 */
function aws_get_attachment_url ( $url, $post_id ) {
  error_log ('url == ' . $url );
  return preg_replace('/^https:/', 'http:', $url);
}

add_filter( 'as3cf_wp_get_attachment_url', 'aws_get_attachment_url');

add_filter('aws_get_client_args', 'aws_get_client_args_filter');
