<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://tylerkanz.com
 * @since      1.0.0
 *
 * @package    Snipput
 * @subpackage Snipput/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Snipput
 * @subpackage Snipput/admin
 * @author     Tyler Kanz <tylerkanz@gmail.com>
 */
class Snipput_Admin
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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Snipput_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Snipput_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/snipput-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Snipput_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Snipput_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/snipput-admin.js', array('jquery'), $this->version, false);
	}
}

// create custom plugin settings menu
add_action('admin_menu', 'snipput_create_menu');

function snipput_create_menu()
{

	//create new top-level menu
	add_submenu_page('options-general.php', 'Snipput Settings', 'Snipput Settings', 'administrator', __FILE__, 'snipput_settings_page');

	//call register settings function
	add_action('admin_init', 'register_snipput_plugin_settings');
}


function register_snipput_plugin_settings()
{
	//register our settings
	register_setting('snipput-settings-group', 'github_url');
	register_setting('snipput-settings-group', 'code_theme');
	register_setting('snipput-settings-group', 'code_theme_url');
}

// create custom plugin settings menu
function snipput_settings_page()
{
	$snipput_options = array(
		'Coy'				=> 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism-coy.min.css',
		'Dark'				=> 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism-dark.min.css',
		'Funky' 			=> 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism-funky.min.css',
		'Okaidia'			=> 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism-okaidia.min.css',
		'Solarized Light'	=> 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism-solarizedlight.min.css',
		'Tomorrow'			=> 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism-tomorrow.min.css',
		'Twilight'			=> 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism-twilight.min.css',
		'Command Line'		=> 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/command-line/prism-command-line.min.css',
	);

?>
	<div class="wrap">
		<h1>Snipput Settings</h1>
		<form method="post" action="options.php">
			<?php settings_fields('snipput-settings-group'); ?>
			<?php do_settings_sections('snipput-settings-group'); ?>
			<table class="form-table">
				<tr valign="top">
					<th>Github URL (Leave empty to disable)</th>
					<td style="width: 200px;"><input type="text" name="github_url" value="<?php echo esc_attr(get_option('github_url')); ?>" /></td>
				</tr>
				<tr valign="top">
					<th>Code Style</th>
					<td style="width: 200px;">
						<select name="code_theme" list="code_themes">
							<?php
							foreach ($snipput_options as $key => $value ) { ?>
								<option value="<?php echo $value;?>" <?php if ($value == esc_attr(get_option('code_theme'))) { echo 'selected'; } ?>><?php echo $key;?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
<?php } ?>