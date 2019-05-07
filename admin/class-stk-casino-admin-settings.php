<?php

/**
 * The settings of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Stk_Casino
 * @subpackage Stk_Casino/admin
 * 
 * @see https://github.com/DevinVinson/wppb-demo-plugin/blob/master/admin/class-wppb-demo-plugin-settings.php
 */

/**
 * Class Stk_Casino_Admin_Settings
 *
 */
class Stk_Casino_Admin_Settings
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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * This function introduces the theme options into the 'Appearance' menu and into a top-level
     * 'WPPB Demo' menu.
     */
    public function setup_plugin_options_menu()
    {

        //Add the menu to the Plugins set of menu items
        add_plugins_page(
            'STK Casno Options',           // The title to be displayed in the browser window for this page.
            'Stk Casino Options',          // The text to be displayed for this menu item
            'manage_options',              // Which type of users can see this menu item
            'stk_casino_options',           // The unique ID - that is, the slug - for this menu item
            array($this, 'render_settings_page_content')   // The name of the function to call when rendering this menu's page
        );
    }

    public function default_general_options()
    {

        return [
            'currency_alpha_code' => 'KR',
            'currency_code_position' => 'after'
        ];
    }

    /**
     * Renders a simple page to display for the theme menu defined above.
     */
    public function render_settings_page_content($active_tab = '')
    {
        ?>
    <!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">

        <h2><?php _e('Stk Casino Options', 'stk-casino'); ?></h2>
        <?php settings_errors(); ?>

        <?php if (isset($_GET['tab'])) {
            $active_tab = $_GET['tab'];
        } else {
            $active_tab = 'general_options';
        }
        ?>

        <h2 class="nav-tab-wrapper">
            <a href="?page=stk_casino_options&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>"><?php _e('General Options', 'stk-casino'); ?></a>
        </h2>

        <form method="post" action="options.php">
            <?php

            settings_fields('stk_casino_general_options');
            do_settings_sections('stk_casino_general_options');

            submit_button();
            ?>
        </form>

    </div><!-- /.wrap -->
<?php
}

public function initialize_general_options()
{
    if (false == get_option('stk_casino_general_options')) {
        $default_array = $this->default_general_options();
        update_option('stk_casino_general_options', $default_array);
    }

    add_settings_section(
        'stk_currency_section',
        __('Currency Settings', 'stk-casino'),
        [],
        'stk_casino_general_options'
    );

    add_settings_field(
        'Currency alpha code',
        __('Currency aplha code', 'stk-casino'),
        [$this, 'currency_alpha_code_render'],
        'stk_casino_general_options',
        'stk_currency_section'
    );

    add_settings_field(
        'Currency code position',
        __('Currency code position', 'stk-casino'),
        [$this, 'currency_code_position_render'],
        'stk_casino_general_options',
        'stk_currency_section'
    );

    register_setting(
        'stk_casino_general_options',
        'stk_casino_general_options'
    );
}

public function currency_alpha_code_render()
{
    $options_default = $this->default_general_options();
    $options = get_option('stk_casino_general_options');

    // Set the default value if not exists
    if (!isset($options['currency_alpha_code'])) $options['currency_alpha_code'] = $options_default['currency_alpha_code'];
    // Render input
    echo '<input type="text" id="stk_casino_currency_alpha_code" name="stk_casino_general_options[currency_alpha_code]" value="' . $options['currency_alpha_code'] . '" />';
}
public function currency_code_position_render()
{
    $options_default = $this->default_general_options();
    $options = get_option('stk_casino_general_options');

    // Set the default value if not exists
    if (!isset($options['currency_code_position'])) $options['currency_code_position'] = $options_default['currency_code_position'];

    // Render input
    echo '<fieldset>';
    echo '<label><input type="radio" name="stk_casino_general_options[currency_code_position]" value="before" ' . checked('before', $options['currency_code_position'], false) . '> ' . __('Before', 'stk-casino') . '</label><br>';
    echo '<label><input type="radio" name="stk_casino_general_options[currency_code_position]" value="after" ' . checked('after', $options['currency_code_position'], false) . '> ' . __('After', 'stk-casino') . '</label>';
    echo '</fieldset>';
}
}
