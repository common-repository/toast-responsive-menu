<?php 

/*
 * Create Toast MM admin page
 */
    function toast_mm_init(){
        add_menu_page('Mobile Menu', 'Mobile Menu', 'manage_options', 'toast_mm', 'toast_mm_options', 'dashicons-menu-alt', 65);
    }
    add_action( 'admin_menu', 'toast_mm_init' );

/*
 * Renders the options page for Toast MM
 */
    function toast_mm_options(){ ?>
    <div class="wrap">
        <div class="toast-mm-buttons">
            <a href="https://www.toastplugins.co.uk/product/mobile-menu/" target="_blank" class="toast-mm-pro-upgrade">Upgrade to pro for £19.99</a>
        </div>
        <div class="toast-mm-body">
            <header class="toast-mm-header">
                <a href="https://www.toastplugins.co.uk/" target="_blank" class="toast-mm-admin-header-logo"><img src="<?php echo plugin_dir_url(__FILE__); ?>../assets/toastplugins.png" alt="Toast Plugins"></a>
                <div class="toast-mm-tabs">
                    <div class="toast-mm-tab active" data-tab="general">
                        <h4>General Options</h4>
                        <p>Setup your menu</p>
                        <div class="icon">
                            <img src="<?php echo plugin_dir_url(__FILE__); ?>../assets/cog.svg" class="cog cog1" alt="Toast Plugins">
                            <img src="<?php echo plugin_dir_url(__FILE__); ?>../assets/cog.svg" class="cog cog2" alt="Toast Plugins">
                        </div>
                    </div>
                    <div class="toast-mm-tab" data-tab="display">
                        <h4>Display Options</h4>
                        <p>Control the display</p>
                        <div class="icon">
                            <?php echo file_get_contents(plugin_dir_path(__FILE__).'../assets/display.svg'); ?>
                        </div>
                    </div>
                    <div class="toast-mm-tab" data-tab="colour">
                        <h4>Colour Options</h4>
                        <p>Control the colours</p>
                        <div class="icon">
                            <?php echo file_get_contents(plugin_dir_path(__FILE__).'../assets/paintbrush.svg'); ?>
                        </div>
                    </div>
                </div>
            </header>
            <div class="toast-mm-tab-areas">
                <?php $toast_mm_options = get_option('toast_mm_options'); ?>
                <div class="toast-mm-tab-area active" data-tab="general">
                    <h2>General Options</h2>
                    <h3 class="option-section-title">Setup your menu</h3>
                    <p>Simply choose a menu and select a width you'd like it to appear below.</p>
                    <?php do_action('toast_mm_general_options', $toast_mm_options); ?>
                </div>

                <div class="toast-mm-tab-area" data-tab="display">
                    <h2>Display Options</h2>
                    <?php do_action('toast_mm_display_options', $toast_mm_options); ?>
                </div>

                <div class="toast-mm-tab-area" data-tab="colour">
                    <h2>Colour Options</h2>
                    <h3 class="option-section-title">Menu Items</h3>
                    <?php do_action('toast_mm_colour_options', $toast_mm_options); ?>
                </div>
            </div>
        </div>
    </div>
<?php }

/*
 * Enqueues the scripts and styles neccessary for Toast MM options page
 */
    function toast_mm_admin_enqueue($hook){
        if($hook == 'toplevel_page_toast_mm'):
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style('toast_mm_admin_css', plugin_dir_url( __FILE__ ).'../css/admin.css');
            wp_enqueue_script('toast_mm_admin_js', plugin_dir_url( __FILE__ ).'../js/admin.js', array('jquery', 'wp-color-picker'), null, true);
        endif;
    }
    add_action('admin_enqueue_scripts', 'toast_mm_admin_enqueue');