<?php

require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-stk-casino-importer.php';

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
        // Import casino starter set
        Stk_Casino_Importer::import();
    }
}
