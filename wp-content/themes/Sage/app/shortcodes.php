<?php
namespace App;

/**
 * Add the shortcodes
 */
add_action( 'init', function() {
  add_shortcode('resources', function() {

    // Start object caching or output
    ob_start();

    // Set the template we're going to use for the Shortcode
    $template = 'partials/shortcodes/shortcode-resources';

    // Set up template data
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);

    // Echo the shortcode blade template
    echo Template($template, $data);

    // Return cached object
		return ob_get_clean();
  });
});