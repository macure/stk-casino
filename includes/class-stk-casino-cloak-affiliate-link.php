<?php

use samueltissot\WP_Route\WP_Route;
use samueltissot\WP_Route\Request;

class Stk_Casino_Cloak_Affiliate_Link
{
    const CLOAK_ROUTE = '/casino/go/{slug}';

    /**
     * Initialize cloaking
     *
     * @return void
     */
    public function init()
    {
        // Register custom route
        WP_Route::get(self::CLOAK_ROUTE, [$this, 'handleRequest']);
    }

    /**
     * Handle affiliate linnk request
     *
     * @param Request $request
     * @return void
     */
    public function handleRequest(Request $request)
    {
        // Get the slug from url
        $slug = $request->pathVariable('slug');

        // Get casino by slug
        $args = array(
            'name'        => $slug,
            'post_type'   => 'casino',
            'post_status' => 'publish',
            'numberposts' => 1
        );

        $casinos = get_posts($args);
        if ($casinos) {
            // first from Array
            $casino = reset($casinos);
            $affiliateLink = get_field('affiliate_link', $casino);

            if ($affiliateLink) {
                $this->redirectTo($affiliateLink);
            }
        }
    }

    /**
     * Redirect to affilate link
     *
     * @param [type] $url
     * @param integer $status
     * @return void
     */
    public static function redirectTo($url, $status=301)
    {
        wp_redirect($url, $status);
        exit;
    }
}
