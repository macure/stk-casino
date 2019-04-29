<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Stk_Casino
 * @subpackage Stk_Casino/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Stk_Casino
 * @subpackage Stk_Casino/public
 * @author     Marko Curcic <marko.curcic@stkfinans.no>
 */
class Stk_Casino_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Stk_Casino_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Stk_Casino_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/stk-casino-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Stk_Casino_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Stk_Casino_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/stk-casino-public.js', array( 'jquery' ), $this->version, false);
    }

    /**
     * Register custom post types
     * Exported from CPT UI plugin
     *
     * @return void
     */
    public function register_custom_post_types()
    {
        /**
         * Post Type: Casinos.
         */
        $labels = array(
            "name" => __("Casinos", "minisite"),
            "singular_name" => __("Casino", "minisite"),
        );

        $args = array(
            "label" => __("Casinos", "minisite"),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "delete_with_user" => false,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => array("slug" => "casino", "with_front" => true),
            "query_var" => true,
            "menu_icon" => "dashicons-plus-alt",
            "supports" => array("title", "editor", "thumbnail", "custom-fields"),
            "taxonomies" => array("category", "post_tag"),
        );

        register_post_type("casino", $args);
    }

    /**
     * Register custom fields as a local group
     * for versioning, and performance
     *
     * @return void
     */
    public function register_local_field_group()
    {
        acf_add_local_field_group(array(
            'key' => 'group_5cc1a0c8d9505',
            'title' => 'Casino Data',
            'fields' => array(
                array(
                    'key' => 'field_5cc1a41d5b2c4',
                    'label' => 'Bonus',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_5cc1a0cf0df21',
                    'label' => 'Bonus Percentage',
                    'name' => 'bonus_percentage',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => 'Ex. 100',
                    'prepend' => '',
                    'append' => '%',
                    'min' => 0,
                    'max' => '',
                    'step' => 10,
                ),
                array(
                    'key' => 'field_5cc1a1360df22',
                    'label' => 'Bonus Maximum',
                    'name' => 'bonus_maximum',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => 'Ex. 600',
                    'prepend' => '',
                    'append' => 'NOK',
                    'min' => 0,
                    'max' => '',
                    'step' => '',
                ),
                array(
                    'key' => 'field_5cc2ddec6ea26',
                    'label' => 'Spins',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_5cc2db751db4a',
                    'label' => 'Spins',
                    'name' => 'spins',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'table',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_5cc2db8b1db4b',
                            'label' => 'Spin type',
                            'name' => 'spin_type',
                            'type' => 'select',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'choices' => array(
                                'free' => 'FreeSpins',
                                'real' => 'RealSpins',
                                'big' => 'BigSpins',
                            ),
                            'default_value' => array(),
                            'allow_null' => 1,
                            'multiple' => 0,
                            'ui' => 0,
                            'return_format' => 'value',
                            'ajax' => 0,
                            'placeholder' => '',
                        ),
                        array(
                            'key' => 'field_5cc2dc081db4c',
                            'label' => 'Number of spins',
                            'name' => 'spin_number',
                            'type' => 'number',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_5cc2db8b1db4b',
                                        'operator' => '!=empty',
                                    ),
                                ),
                            ),
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'min' => '',
                            'max' => '',
                            'step' => '',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_5cc1a4325b2c5',
                    'label' => 'Rating',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_5cc1a4fffd8d3',
                    'label' => 'User Rating',
                    'name' => 'user_rating',
                    'type' => 'range',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'min' => 0,
                    'max' => 5,
                    'step' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_5cc1a559fd8d4',
                    'label' => 'Our Rating',
                    'name' => 'our_rating',
                    'type' => 'range',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'min' => 0,
                    'max' => 5,
                    'step' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_5cc2de2950223',
                    'label' => 'Affiliate',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_5cc2de400843f',
                    'label' => 'Affiliate Link',
                    'name' => 'affiliate_link',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'casino',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'acf_after_title',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));
    }
}
