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
    public function activate()
    {
        // Update options
        $this->update_options();
        $this->affiliate_tracker_install();
    }

    /**
     * Update site wide options
     *
     * @return void
     */
    public function update_options()
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

    /**
     * Install Affiliate tracker DB table
     *
     * @return void
     */
    public function affiliate_tracker_install()
    {
        global $wpdb;

        if (get_option("stk_casino_db_version") != STK_CASINO_VERSION) {

            $table_name = $wpdb->prefix . 'stk_casino_affiliate_count';
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            created_at date NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX (post_id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);

            add_option('stk_casino_db_version', STK_CASINO_VERSION);
        }
    }
}
