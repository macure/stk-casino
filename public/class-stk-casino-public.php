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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/stk-casino-public.js', array('jquery'), $this->version, false);
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
            "name" => __("Casinos", "stk-casino"),
            "singular_name" => __("Casino", "stk-casino"),
        );

        $args = array(
            "label" => __("Casinos", "stk-casino"),
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

        /**
         * Post Type: Slots.
         */

        $labels = [
            "name" => __("Slots", "minisite"),
            "singular_name" => __("Slot", "minisite"),
        ];

        $args = [
            "label" => __("Slots", "minisite"),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => ["slug" => "slot", "with_front" => true],
            "query_var" => true,
            "supports" => ["title", "editor", "thumbnail", "custom-fields"],
        ];

        register_post_type("slot", $args);
    }

    /**
     * Register custom fields as a local group
     * for versioning, and performance
     *
     * @return void
     */
    public function register_local_field_group()
    {
        if (function_exists('acf_add_local_field_group')) :

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
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5cdc18b5188f2',
                                    'operator' => '!=',
                                    'value' => '1',
                                ),
                            ),
                        ),
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
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5cdc18b5188f2',
                                    'operator' => '!=',
                                    'value' => '1',
                                ),
                            ),
                        ),
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
                        'key' => 'field_5cd166a520688',
                        'label' => 'Manual currency settings',
                        'name' => 'manual_currency_settings',
                        'type' => 'true_false',
                        'instructions' => 'This will override any global currency settings',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5cdc18b5188f2',
                                    'operator' => '!=',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => 'Use manual settings',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_5cd1662c6031f',
                        'label' => 'Currency Settings',
                        'name' => 'currency_settings',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5cd166a520688',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                                array(
                                    'field' => 'field_5cdc18b5188f2',
                                    'operator' => '!=',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_5cd165b56031e',
                                'label' => 'Currency code',
                                'name' => 'currency_code',
                                'type' => 'text',
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
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_5cd16460f3bef',
                                'label' => 'Currency code position',
                                'name' => 'currency_code_position',
                                'type' => 'radio',
                                'instructions' => 'Position of the currency code. Default value will be whatever is set in the global settings',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'choices' => array(
                                    'default' => 'Default',
                                    'before' => 'Before',
                                    'after' => 'After',
                                ),
                                'allow_null' => 0,
                                'other_choice' => 0,
                                'default_value' => 'default',
                                'layout' => 'vertical',
                                'return_format' => 'value',
                                'save_other_choice' => 0,
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_5cdc18b5188f2',
                        'label' => 'Bonus - override',
                        'name' => 'bonus_override',
                        'type' => 'true_false',
                        'instructions' => 'Override bonus values with the custom text',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => 'Use text override',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_5cdc19423f628',
                        'label' => 'Bonus Text (Alternative)',
                        'name' => 'bonus_text_alternative',
                        'type' => 'textarea',
                        'instructions' => 'Leave empty if you would like to show no text',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5cdc18b5188f2',
                                    'operator' => '==',
                                    'value' => '1',
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
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => 'br',
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
                        'key' => 'field_5cc2db8b1db4b',
                        'label' => 'Spin type',
                        'name' => 'spin_type',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5cdc17bf932b3',
                                    'operator' => '!=',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'free' => 'FreeSpins',
                            'free_alt_1' => 'Free Spins',
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
                                array(
                                    'field' => 'field_5cdc17bf932b3',
                                    'operator' => '!=',
                                    'value' => '1',
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
                    array(
                        'key' => 'field_5cdc17bf932b3',
                        'label' => 'Spin - override',
                        'name' => 'spin_override',
                        'type' => 'true_false',
                        'instructions' => 'Override spin values with the custom text',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => 'Use text override',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_5cdc164f33d67',
                        'label' => 'Spin Text (Alternative)',
                        'name' => 'spin_text_alternative',
                        'type' => 'textarea',
                        'instructions' => 'Leave empty if you would like to show no text',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5cdc17bf932b3',
                                    'operator' => '==',
                                    'value' => '1',
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
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => 'br',
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
                    array(
                        'key' => 'field_605369bc010f7',
                        'label' => 'Affiliate CTA Label',
                        'name' => 'affiliate_cta_label',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Get Bonus',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5d95dcdb4c00d',
                        'label' => 'Terms & Conditions',
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
                        'key' => 'field_5d95dd33ee1b5',
                        'label' => 'Show',
                        'name' => 'terms_and_conditions_show',
                        'type' => 'true_false',
                        'instructions' => 'Display Terms & Conditions text',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_5d95ddafee1b6',
                        'label' => 'Text',
                        'name' => 'terms_and_conditions_text',
                        'type' => 'wysiwyg',
                        'instructions' => 'Terms & Conditions text',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5d95dd33ee1b5',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'visual',
                        'toolbar' => 'full',
                        'media_upload' => 0,
                        'delay' => 0,
                    ),
                    array(
                        'key' => 'field_5fa2c775886e0',
                        'label' => 'Payment',
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
                        'key' => 'field_5fa2c797886e1',
                        'label' => 'Payment Method',
                        'name' => 'payment_methods',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'amex' => 'American Express',
                            'bitcoin' => 'Bitcoin',
                            'boku' => 'Boku',
                            'citadel' => 'Citadel',
                            'click-and-buy' => 'Click and Buy',
                            'echeck' => 'E- Check',
                            'ecopayz' => 'EcoPayz',
                            'entropay' => 'Entropay',
                            'flexepin' => 'Flexepin',
                            'giropay' => 'GiroPay',
                            'ideal' => 'iDeal',
                            'idebit' => 'iDebit',
                            'instadebit' => 'Instadebit',
                            'interac' => 'Interac',
                            'klarna' => 'Klarna',
                            'mastercard' => 'MasterCard',
                            'neosurf' => 'Neosurf',
                            'neteller' => 'Neteller',
                            'paynplay2' => 'Pay N Play',
                            'paypal' => 'PayPal',
                            'paysafecard' => 'PaySafe Card',
                            'rapidtransfer' => 'Rapid Transfer',
                            'skrill' => 'Skrill',
                            'sofort' => 'Sofort',
                            'trustly' => 'Trustly',
                            'visa' => 'Visa',
                        ),
                        'allow_custom' => 0,
                        'default_value' => array(),
                        'layout' => 'horizontal',
                        'toggle' => 0,
                        'return_format' => 'array',
                        'save_custom' => 0,
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

        endif;

        if (function_exists('acf_add_local_field_group')) :

            acf_add_local_field_group(array(
                'key' => 'group_5d88cb84c5aae',
                'title' => 'Casino Style',
                'fields' => array(
                    array(
                        'key' => 'field_5d88cba839c40',
                        'label' => 'Featured image background',
                        'name' => 'featured_image_background',
                        'type' => 'color_picker',
                        'instructions' => 'Choose the background colour for featured image.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '#d7dfe2',
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
                'position' => 'side',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));

        endif;

        if (function_exists('acf_add_local_field_group')) :

            acf_add_local_field_group(array(
                'key' => 'group_5fa5ccdc983ec',
                'title' => 'Slot Data',
                'fields' => array(
                    array(
                        'key' => 'field_5fa5cce99fd0e',
                        'label' => 'Casino',
                        'name' => 'slot_casino',
                        'type' => 'relationship',
                        'instructions' => 'Select casino in which slot can be played',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => array(
                            0 => 'casino',
                        ),
                        'taxonomy' => '',
                        'filters' => array(
                            0 => 'search',
                        ),
                        'elements' => array(
                            0 => 'featured_image',
                        ),
                        'min' => 1,
                        'max' => 1,
                        'return_format' => 'object',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'slot',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));

        endif;
    }
}
