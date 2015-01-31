/**
* @var date_format string
* @return string date
*/
function get_site_last_modified( $atts ) {
global $wpdb;
if ( is_array( $atts ) ) {
extract( shortcode_atts( array(
'date_format' => '', //use site wide format (default)
), $atts ) );
} else {
$date_format = $atts;
}
$query = "SELECT post_modified
FROM $wpdb->posts
ORDER BY post_date DESC
";
//Using $wpdb for a cached result
$site_mod_date = $wpdb->get_var( $query );
if ( empty( $date_format ))
$date_format = get_option( 'date_format' ) . ' - ' . get_option( 'time_format' );
return mysql2date( $date_format, $site_mod_date );
}

/**
* @var date_format string
* Displays the date / time of the last modified post
*/
function site_last_modified( $date_format = '' ) {
echo get_site_last_modified( $date_format );
}

// shortcode
add_shortcode( 'site_last_modified', 'get_site_last_modified' );
