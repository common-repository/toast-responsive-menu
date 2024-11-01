<?php 
/*
 * Enqueued below are a number of default MM settings
 */

function toast_mm_general_options($toast_mm_options){ ?>
	<div class="toast-mm-options-area">
        <?php $menus = wp_get_nav_menus(); ?>
        <div class="option">
            <h3>Select a menu</h3>
            <p>Select a menu from your predefined WordPress menus.</p>
            <p><strong>Note:</strong> You can <strong>create</strong> and <strong>edit</strong> your WordPress menus <a href="<?php echo admin_url(); ?>nav-menus.php" target="_blank">here</a></p>
        	<select name="menu">
                <?php foreach($menus as $menu): ?>
                    <option value="<?php echo $menu->slug; ?>" <?php if($toast_mm_options['menu'] == $menu->slug): ?>selected<?php endif; ?>><?php echo $menu->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="option">
            <h3>Display from width</h3>
            <p>The number of pixels to display the menu from.</p>
            <input name="display_width" placeholder="Default: 768" value="<?php echo $toast_mm_options['display_width']; ?>" type="number">
                            px
        </div>
    </div>
 <?php }
 add_action('toast_mm_general_options', 'toast_mm_general_options', 5);

 function toast_mm_display_options($toast_mm_options){ ?>
    <h3 class="option-section-title">Advanced menu styling</h3>
    <div class="toast-mm-options-area">
        <div class="row">
            <div class="option pro-option half">
                    <h3>Menu icon position</h3>
                    <p>Select where the title & icon should show within your title bar.</p>
                    <select name="menu_icon_position">
                        <option value="left" <?php if($toast_mm_options['menu_icon_position'] == 'left'): ?>selected<?php endif; ?>>Left</option>
                        <option value="right" <?php if($toast_mm_options['menu_icon_position'] == 'right'): ?>selected<?php endif; ?>>Right</option>
                    </select>
            </div>
            <div class="option pro-option half">
                    <h3>Menu open direction</h3>
                    <p>Select the direction you'd like the menu to open from.</p>
                    <select name="open_direction">
                        <option value="left" <?php if($toast_mm_options['open_direction'] == 'left'): ?>selected<?php endif; ?>>Left</option>
                        <option value="right" <?php if($toast_mm_options['open_direction'] == 'right'): ?>selected<?php endif; ?>>Right</option>
                        <option value="top" <?php if($toast_mm_options['open_direction'] == 'top'): ?>selected<?php endif; ?>>Top</option>
                        <option value="bottom" <?php if($toast_mm_options['open_direction'] == 'bottom'): ?>selected<?php endif; ?>>Bottom</option>
                    </select>
            </div>
        </div>
        <div class="option pro-option">
            <h3>Capitalize Menu Items?</h3>
            <input type="checkbox" <?php if(isset($toast_mm_options['capitalize']) && $toast_mm_options['capitalize'] == 'on'): ?>checked<?php endif; ?> name="capitalize" id="capitalize">
            <label for="capitalize">Enable to capitalize text within the menu</label>
        </div>
    </div>


    <h3 class="option-section-title">Logo settings</h3>
	<div class="toast-mm-options-area">
        <div class="row">
            <div class="option half pro-option">
                <h3>Menu Logo</h3>
                <p>Select a logo to display.</p>
                <?php wp_enqueue_media(); ?>
                <div class='image-preview-wrapper <?php if(isset($toast_mm_options['menu_logo']) && ! $toast_mm_options['menu_logo']): ?>empty<?php endif; ?>' data-associated-input="menu_logo">
                    <?php if(isset($toast_mm_options['menu_logo'])): ?>
                        <?php echo wp_get_attachment_image($toast_mm_options['menu_logo'], 'full', false, array('class' => 'image-preview')); ?>
                    <?php else: ?>
                            <img>
                    <?php endif; ?>
                </div>
                <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" data-associated-input="menu_logo"/>
                <input type="button" class="button remove-image" data-associated-input="menu_logo" value="<?php _e( 'Remove image' ); ?>" data-associated-input="menu_logo"/>
                <input type='hidden' name='menu_logo' value=''>
            </div>
            <div class="option half pro-option">
                <h3>Logo Position</h3>
                <p>Where to display the logo?</p>
                <select name="logo_position">
                    <option value="menu_bar_right" <?php if(isset($toast_mm_options['logo_position']) && $toast_mm_options['logo_position'] == 'menu_bar_right'): ?>selected<?php endif; ?>>Menu Bar (right)</option>
                    <option value="menu_bar_left" <?php if(isset($toast_mm_options['logo_position']) && $toast_mm_options['logo_position'] == 'menu_bar_left'): ?>selected<?php endif; ?>>Menu Bar (left)</option>
                    <option value="menu_area_top" <?php if(isset($toast_mm_options['logo_position']) && $toast_mm_options['logo_position'] == 'menu_area_top'): ?>selected<?php endif; ?>>Menu area (top)</option>
                    <option value="menu_area_bottom" <?php if(isset($toast_mm_options['logo_position']) && $toast_mm_options['logo_position'] == 'menu_area_bottom'): ?>selected<?php endif; ?>>Menu area (bottom)</option>
                </select>
            </div>
        </div>
    </div>
 <?php }
 add_action('toast_mm_display_options', 'toast_mm_display_options', 5);

 function toast_mm_colour_options($toast_mm_options){ ?>
	 <div class="toast-mm-options-area">
            <div class="row">
                <div class="option half">
                	<h3>Menu Bar Colour</h3>
                    <p>Select the colour of your menu bar</p>
                    <input type="text" value="<?php echo $toast_mm_options['bar_colour']; ?>" name="bar_colour" class="colour-picker">
                </div>
                <div class="option half">
                    <h3>Menu Bar Text Colour</h3>
                    <p>Select the colour of your menu bar text & icon</p>
                    <input type="text" value="<?php echo $toast_mm_options['bar_text_colour']; ?>" name="bar_text_colour" class="colour-picker">
                </div>
            </div>

            <div class="row">
                <div class="option half">
                	<h3>Menu Colour</h3>
                    <p>Select the colour of your menu</p>
                    <input type="text" value="<?php echo $toast_mm_options['menu_colour']; ?>" name="menu_colour" class="colour-picker">
 				</div>
                <div class="option half">
                	<h3>Menu Text Colour</h3>
                    <p>Select the colour of your menu text & icon</p>
                    <input type="text" value="<?php echo $toast_mm_options['menu_text_colour']; ?>" name="menu_text_colour" class="colour-picker">
                </div>
            </div>
            <div class="row">
                <div class="option half">
                	<h3>Submenu Colour</h3>
                    <p>Select the colour of your submenus</p>
                    <input type="text" value="<?php if(isset($toast_mm_options['submenu_colour'])): echo $toast_mm_options['submenu_colour']; endif; ?>" name="submenu_colour" class="colour-picker">
 				</div>
                <div class="option half">
                	<h3>Submenu Text Colour</h3>
                    <p>Select the colour of your submenu text & icon</p>
                    <input type="text" value="<?php if(isset($toast_mm_options['submenu_text_colour'])): echo $toast_mm_options['submenu_text_colour']; endif; ?>" name="submenu_text_colour" class="colour-picker">
                </div>
            </div>
            <div class="row">
                <div class="option half">
                	<h3>Menu Item Border Colour</h3>
                    <p>Select the border colour of your menu items</p>
                    <input type="text" value="<?php if(isset($toast_mm_options['border_colour'])): echo $toast_mm_options['border_colour']; endif; ?>" name="border_colour" class="colour-picker">
 				</div>
            </div>
        </div>
 <?php }
add_action('toast_mm_colour_options', 'toast_mm_colour_options', 5);

//Generate Toast Title
function toast_mm_title($toast_mm_options){ ?>
<div class="toast-banner-banner-title-area">
        <div class="toast-mm-banner__hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
    <div class="toast-mm-banner__title">Menu</div>
</div>
<?php }
add_action('toast_mm_title', 'toast_mm_title', 5);