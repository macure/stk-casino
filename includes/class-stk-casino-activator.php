<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Stk_Casino
 * @subpackage Stk_Casino/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Stk_Casino
 * @subpackage Stk_Casino/includes
 * @author     Marko Curcic <marko.curcic@stkfinans.no>
 */
class Stk_Casino_Activator
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
        // Update options
        self::updateOptions();
    }

    /**
     * Update site wide options
     *
     * @return void
     */
    public static function updateOptions()
    {
        // Intuitive Custom post order
        if (!get_option('hicpo_options')) {
            update_option('hicpo_options', [
                'objects' => [
                    0 => 'post',
                    1 => 'casino',
                ],
                'tags' => [
                    0 => 'category',
                ],
            ]);
        }
    }
}
