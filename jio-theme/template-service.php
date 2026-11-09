<?php
/**
 * Service detail page. Chosen automatically for the service pages under /solutions/ (see inc/service-pages.php).
 */
get_header();
echo jio_render_service_page( jio_current_service_slug() ); // Escaped inside jio_fill_template().
get_footer();
