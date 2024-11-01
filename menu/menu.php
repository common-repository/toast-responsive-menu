<?php 

/*
 * Enqueue the toast mm associated scripts and styles.
 * 
 */
function toast_mm_enqueue(){
    wp_enqueue_style('toast_mm_css', plugin_dir_url( __FILE__ ).'menu.css');
    wp_enqueue_script('toast_mm_js', plugin_dir_url( __FILE__ ).'menu.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'toast_mm_enqueue');

/*
 * Generate the mobile menu HTML
 */
function toast_mm(){ ?>
    <?php $toast_mm_options = get_option('toast_mm_options'); ?>
    <div class="toast-mm">
        <div class="toast-mm-banner">

        <?php do_action('toast_mm_title', $toast_mm_options); ?>           

        </div>
        <div class="toast-mm-menu">
            <div class="toast-mm-overflow">
            
            <?php wp_nav_menu(array('menu' => $toast_mm_options['menu'])); ?>
            
            </div>
        </div>
    </div>
<?php }
add_action('wp_footer', 'toast_mm', 5);

function toast_mm_dynamic_css(){ ?>
    <?php $toast_mm_options = get_option('toast_mm_options'); ?>
    <style>
        @media(max-width:<?php if($toast_mm_options['display_width']): ?><?php echo $toast_mm_options['display_width']; ?><?php else: ?>768<?php endif; ?>px){
            .toast-mm-banner, .toast-mm-menu, .toast-mm{display:block;}
            .toast-mm-banner{
                background:<?php echo $toast_mm_options['bar_colour']; ?>;
                color:<?php echo $toast_mm_options['bar_text_colour']; ?>
            } 
            .toast-mm-banner__hamburger div{
                background:<?php echo $toast_mm_options['bar_text_colour']; ?>
            }

            .toast-mm-menu{
                background:<?php echo $toast_mm_options['menu_colour']; ?>
            }
            .toast-mm-menu li a{
                color:<?php echo $toast_mm_options['menu_text_colour']; ?>
            }

            .toast-mm-menu .sub-menu li a{
                background:<?php echo $toast_mm_options['submenu_colour']; ?>
            }

            .toast-mm-menu .sub-menu li a{
                color:<?php echo $toast_mm_options['submenu_text_colour']; ?>
            }

            .toast-mm-menu .sub-menu li a{
                color:<?php echo $toast_mm_options['submenu_text_colour']; ?>
            }

            .toast-mm-menu li a{
                border-color:<?php echo $toast_mm_options['border_colour']; ?>
            }
        }
    </style>
<?php }
add_action('wp_head', 'toast_mm_dynamic_css');