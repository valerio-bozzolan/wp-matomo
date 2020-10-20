<?php
/*
Plugin Name: Matomo Stats
Plugin URI: https://matomo.org/
Description: Absolutely lightweight and secure plugin to use an already existing Matomo instance for your WordPress site and have privacy friendly stats. In short: Google Analytics MERDA. The configuration is inside your WP config file.
Version: 0.0.1
Author: Valerio Bozzolan
Author URI: https://boz.reyboz.it/
License: WTFPL
License URI: http://www.wtfpl.net/txt/copying/
*/

defined( 'MATOMO_PATH' ) or exit;
defined( 'MATOMO_SITE' ) or die( 'please define MATOMO_PATH and MATOMO_SITE in your wp-config.php');

add_action( 'wp_footer', function () {

	if( isset( $_SERVER['HTTP_DNT'] ) && $_SERVER['HTTP_DNT'] === '1' ) {
		echo "\n<!-- Hey! You do not want to be tracked (DNT)! Good for you! So no JavaScript tracker for your request! Just this little image... :^) -->\n";
		echo "<!-- For the records... this pixel is not evil: we already can track you looking in the webserver logs, so do not fight about this pixel :^) -->\n";
		printf( '<img src="%smatomo.php?idsite=%d&amp;rec=1" style="border:0" alt="" />',
			MATOMO_PATH,
			MATOMO_SITE
		);
		return;
	}

	$path = MATOMO_PATH;
	$site = MATOMO_SITE;

$js = <<<EOF
	<!-- Matomo -->
	<script>
	var _paq = _paq || [];
	_paq.push(['trackPageView']);
	_paq.push(['enableLinkTracking']);
	(function() {
		var u="$path";
		_paq.push(['setTrackerUrl', u+'piwik.php']);
		_paq.push(['setSiteId', '$site']);
		var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
		g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
	})();
	</script>
	<noscript><p style="position:fixed; top:0;"><img src="$pathmatomo.php?idsite=$site&amp;rec=1" style="border:0;" alt="" /></p></noscript>
	<!-- end Matomo -->
EOF;

	echo $js;
} );

/*
 * Register the stat menu link icon
 */
add_action( 'admin_menu', function () {
    add_menu_page( 'Matomo Stats', 'Matomo Stats', 'manage_options', 'view_matomo_stats', 'function', 'dashicons-performance' );
} );

add_action( 'admin_init', function () {
	if( isset( $_GET['page'] ) && $_GET['page'] === 'view_matomo_stats' ) {
		wp_redirect( MATOMO_PATH );
		exit();
	}
}, 1 );
