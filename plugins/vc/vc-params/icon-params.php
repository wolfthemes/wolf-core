<?php
/**
 * WPBakery Page Builder Extension icon params
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get icon params
 *
 * @return array
 */
// function wolf_core_icon_params() {

// return array(
// 'name' => esc_html__( 'Icon Box', 'wolf-core' ),
// 'description' => esc_html__( 'Icon box from icon library', 'wolf-core' ),
// 'base' => 'vc_icon',
// 'icon' => 'fa fa-rocket',
// 'category' => esc_html__( 'Content', 'wolf-core' ),
// 'params' => array(

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Icon Type', 'wolf-core' ),
// 'value' => array(
// esc_html__( 'Icon', 'wolf-core' ) => 'icon',
// esc_html__( 'Animated Icon', 'wolf-core' ) => 'animated_icon',
// esc_html__( 'Image', 'wolf-core' ) => 'image',
// ),
// 'admin_label' => true,
// 'param_name' => 'media_type',
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Icon library', 'wolf-core' ),
// 'value' => array(
// esc_html__( 'Font Awesome', 'wolf-core' ) => 'fontawesome',
// esc_html__( 'Linearcons', 'wolf-core' ) => 'linearicons',
// esc_html__( 'Linea Icons', 'wolf-core' ) => 'linea-icons',
// esc_html__( 'Elegant Icons', 'wolf-core' ) => 'elegant-icons',
// esc_html__( 'Ionicons', 'wolf-core' ) => 'ionicons',
// esc_html__( 'Dripicons', 'wolf-core' ) => 'dripicons',
// esc_html__( 'Open Iconic', 'wolf-core' ) => 'openiconic',
// esc_html__( 'Typicons', 'wolf-core' ) => 'typicons',
// esc_html__( 'Entypo', 'wolf-core' ) => 'entypo',
// esc_html__( 'Linecons', 'wolf-core' ) => 'linecons',
// esc_html__( 'Mono Social', 'wolf-core' ) => 'monosocial',
// esc_html__( 'Socicon', 'wolf-core' ) => 'socicon',
// esc_html__( 'Material', 'wolf-core' ) => 'material',
// esc_html__( 'Iconmonstr Iconic Font', 'wolf-core' ) => 'iconmonstr-iconic-font',
// esc_html__( 'Wolf Rare Icons', 'wolf-core' ) => 'wolficons',
// ),
// 'admin_label' => true,
// 'param_name' => 'type',
// 'description' => esc_html__( 'Select icon library.', 'wolf-core' ),
// 'dependency' => array(
// 'element' => 'media_type',
// 'value' => 'icon',
// ),
// 'std' => apply_filters( 'wolf_core_default_icon_font', 'fontawesome' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_fontawesome',
// 'value' => 'fa fa-cog',
// 'settings' => array(
// 'emptyIcon' => false,
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'fontawesome',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_linearicons',
// 'value' => 'lnr-sun',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'linearicons',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'linearicons',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_linea-icons',
// 'value' => 'linea-basic-gear',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'linea-icons',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'linea-icons',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_elegant-icons',
// 'value' => 'ei-genius',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'elegant-icons',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'elegant-icons',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_ionicons',
// 'value' => 'ion-android-car',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'ionicons',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'ionicons',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Dripicons', 'wolf-core' ),
// 'param_name' => 'icon_dripicons',
// 'value' => 'dripicons-browser',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'dripicons',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'dripicons',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_openiconic',
// 'value' => 'vc-oi vc-oi-dial',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'openiconic',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'openiconic',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_typicons',
// 'value' => 'typcn typcn-adjust-brightness',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'typicons',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'typicons',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_entypo',
// 'value' => 'entypo-icon entypo-icon-note',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'entypo',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'entypo',
// ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_linecons',
// 'value' => 'vc_li vc_li-heart',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'linecons',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'linecons',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_monosocial',
// 'value' => 'vc-mono vc-mono-fivehundredpx',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'monosocial',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'monosocial',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_socicon',
// 'value' => 'vc-mono vc-mono-fivehundredpx',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'socicon',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'socicon',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_material',
// 'value' => 'vc-material vc-material-cake',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'material',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'material',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_iconmonstr-iconic-font',
// 'value' => 'im im-newsletter',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'iconmonstr-iconic-font',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'iconmonstr-iconic-font',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),
// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'icon_wolficons',
// 'value' => 'wolf-icon-wolfthemes',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'wolficons',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'type',
// 'value' => 'wolficons',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),

// array(
// 'type' => 'attach_image',
// 'heading' => esc_html__( 'Icon Image', 'wolf-core' ),
// 'param_name' => 'image_id',
// 'dependency' => array(
// 'element' => 'media_type',
// 'value' => 'image',
// ),
// ),

// array(
// 'type' => 'iconpicker',
// 'heading' => esc_html__( 'Icon', 'wolf-core' ),
// 'param_name' => 'animated_icon_lineaicons',
// 'value' => 'linea-basic-gear',
// 'settings' => array(
// 'emptyIcon' => false,
// 'type' => 'linea-icons',
// 'iconsPerPage' => 4000,
// ),
// 'dependency' => array(
// 'element' => 'media_type',
// 'value' => 'animated_icon',
// ),
// 'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Icon color', 'wolf-core' ),
// 'param_name' => 'animated_icon_color',
// 'value' => array_merge(
// array(
// esc_html__( 'Default color', 'wolf-core' ) => 'default',
// ),
// wolf_core_get_shared_colors(),
// array(
// esc_html__( 'Custom color', 'wolf-core' ) => 'custom',
// )
// ),
// 'description' => esc_html__( 'Select icon color.', 'wolf-core' ),
// 'param_holder_class' => 'wolf_core_colored-dropdown',
// 'dependency' => array(
// 'element' => 'media_type',
// 'value' => 'animated_icon',
// ),
// ),

// array(
// 'type' => 'colorpicker',
// 'heading' => esc_html__( 'Custom color', 'wolf-core' ),
// 'param_name' => 'animated_icon_custom_color',
// 'description' => esc_html__( 'Select custom icon color.', 'wolf-core' ),
// 'dependency' => array(
// 'element' => 'animated_icon_color',
// 'value' => 'custom',
// ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Background shape', 'wolf-core' ),
// 'param_name' => 'background_style',
// 'value' => array(
// esc_html__( 'None', 'wolf-core' ) => 'none',
// esc_html__( 'Circle', 'wolf-core' ) => 'rounded',
// esc_html__( 'Square', 'wolf-core' ) => 'boxed',
// esc_html__( 'Rounded', 'wolf-core' ) => 'rounded-less',
// esc_html__( 'Outline Circle', 'wolf-core' ) => 'rounded-outline',
// esc_html__( 'Outline Square', 'wolf-core' ) => 'boxed-outline',
// esc_html__( 'Outline Rounded', 'wolf-core' ) => 'rounded-less-outline',
// esc_html__( 'Ban', 'wolf-core' ) => 'ban',
// ),
// 'description' => esc_html__( 'Select background shape and style for icon.', 'wolf-core' ),
// 'dependency' => array(
// 'element' => 'media_type',
// 'value' => 'icon',
// ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Icon color', 'wolf-core' ),
// 'param_name' => 'color',
// 'value' => array_merge(
// array(
// esc_html__( 'Default color', 'wolf-core' ) => 'default',
// ),
// wolf_core_get_shared_colors(),
// array(
// esc_html__( 'Custom color', 'wolf-core' ) => 'custom',
// )
// ),
// 'description' => esc_html__( 'Select icon color.', 'wolf-core' ),
// 'param_holder_class' => 'wolf_core_colored-dropdown',
// 'dependency' => array(
// 'element' => 'background_style',
// 'value' => 'none',
// ),
// ),

// array(
// 'type' => 'colorpicker',
// 'heading' => esc_html__( 'Custom color', 'wolf-core' ),
// 'param_name' => 'custom_color',
// 'description' => esc_html__( 'Select custom icon color.', 'wolf-core' ),
// 'dependency' => array(
// 'element' => 'color',
// 'value' => 'custom',
// ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Background color', 'wolf-core' ),
// 'param_name' => 'background_color',
// 'value' => array_merge( wolf_core_get_shared_colors(), array(
// esc_html__( 'Custom color', 'wolf-core' ) => 'custom',
// )
// ),
// 'description' => esc_html__( 'Select background color for icon.', 'wolf-core' ),
// 'param_holder_class' => 'wolf_core_colored-dropdown',
// 'dependency' => array(
// 'element' => 'background_style',
// 'value_not_equal_to' => array( 'none' ),
// ),
// ),
// array(
// 'type' => 'colorpicker',
// 'heading' => esc_html__( 'Custom background color', 'wolf-core' ),
// 'param_name' => 'custom_background_color',
// 'description' => esc_html__( 'Select custom icon background color.', 'wolf-core' ),
// 'dependency' => array(
// 'element' => 'background_color',
// 'value' => 'custom',
// ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Hover Transition', 'wolf-core' ),
// 'param_name' => 'hover_effect',
// 'value' => array(
// esc_html__( 'None', 'wolf-core' ) => 'none',
// esc_html__( 'Opacity', 'wolf-core' ) => 'opacity',
// esc_html__( 'Inset border', 'wolf-core' ) => 'border-inset',
// esc_html__( 'Sonar', 'wolf-core' ) => 'sonar',
// esc_html__( 'Fill', 'wolf-core' ) => 'fill',
// esc_html__( 'Pop', 'wolf-core' ) => 'pop',
// esc_html__( 'Rotate', 'wolf-core' ) => 'rotate',
// ),
// 'description' => esc_html__( 'Custom hover effects won\'t apply to icon with custom colors settings', 'wolf-core' ),
// 'dependency' => array(
// 'element' => 'background_style',
// 'value_not_equal_to' => array( 'none' ),
// ),
// 'admin_label' => true,
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Position', 'wolf-core' ),
// 'param_name' => 'position',
// 'value' => array(
// esc_html__( 'Top', 'wolf-core' ) => 'top',
// esc_html__( 'Left', 'wolf-core' ) => 'left',
// esc_html__( 'Left from Title', 'wolf-core' ) => 'left_from_title',
// esc_html__( 'Right', 'wolf-core' ) => 'right',
// esc_html__( 'Right from Title', 'wolf-core' ) => 'right_from_title',
// ),
// 'dependency' => array( 'element' => 'box_type', 'value' => array( 'normal' ) ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Container Alignement', 'wolf-core' ),
// 'param_name' => 'container_alignement',
// 'value' => array(
// esc_html__( 'Left', 'wolf-core' ) => 'left',
// esc_html__( 'Center', 'wolf-core' ) => 'center',
// esc_html__( 'Right', 'wolf-core' ) => 'right',
// ),
// 'dependency' => array( 'element' => 'position', 'value' => array( 'left_from_title' ) ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Text Alignement', 'wolf-core' ),
// 'param_name' => 'text_alignement',
// 'value' => array(
// esc_html__( 'Center', 'wolf-core' ) => 'center',
// esc_html__( 'Left', 'wolf-core' ) => 'left',
// esc_html__( 'Right', 'wolf-core' ) => 'right',
// ),
// 'dependency' => array( 'element' => 'position', 'value' => array( 'top' ) ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Size', 'wolf-core' ),
// 'param_name' => 'size',
// 'value' => array(
// esc_html__( 'Small', 'wolf-core' ) => 'fa-2x',
// esc_html__( 'Medium', 'wolf-core' ) => 'fa-3x',
// esc_html__( 'Large', 'wolf-core' ) => 'fa-4x',
// esc_html__( 'Very Large', 'wolf-core' ) => 'fa-5x',
// esc_html__( 'Tiny', 'wolf-core' ) => 'fa-1x',
// ),
// ),

// array(
// 'type' => 'wolf_core_textfield',
// 'heading' => esc_html__( 'Title', 'wolf-core' ),
// 'param_name' => 'title',
// 'placeholder' => esc_html__( 'My title', 'wolf-core' ),
// 'admin_label' => true,
// 'group' => esc_html__( 'Text', 'wolf-core' ),
// ),

// array(
// 'type' => 'wolf_core_textfield',
// 'heading' => esc_html__( 'Title Font Size', 'wolf-core' ),
// 'param_name' => 'title_font_size',
// 'placeholder' => '18px',
// 'group' => esc_html__( 'Text', 'wolf-core' ),
// ),

// array(
// 'type' => 'wolf_core_font_family',
// 'heading' => esc_html__( 'Title Font Family', 'wolf-core' ),
// 'param_name' => 'title_font_family',
// 'group' => esc_html__( 'Text', 'wolf-core' ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Text Transform', 'wolf-core' ),
// 'param_name' => 'title_text_transform',
// 'value' => array(
// esc_html__( 'Default', 'wolf-core' ) => '',
// esc_html__( 'None', 'wolf-core' ) => 'none',
// esc_html__( 'Uppercase', 'wolf-core' ) => 'uppercase',
// ),
// 'group' => esc_html__( 'Text', 'wolf-core' ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Title Tag', 'wolf-core' ),
// 'param_name' => 'title_tag',
// 'value' => array(
// 'h3',
// 'h1',
// 'h2',
// 'h4',
// 'h5',
// 'h6',
// 'span',
// ),
// 'group' => esc_html__( 'Text', 'wolf-core' ),
// ),

// array(
// 'type' => 'wolf_core_textfield',
// 'heading' => esc_html__( 'Title Letter Spacing', 'wolf-core' ),
// 'param_name' => 'title_letter_spacing',
// 'group' => esc_html__( 'Text', 'wolf-core' ),
// ),

// array(
// 'type' => 'textarea',
// 'heading' => esc_html__( 'Text', 'wolf-core' ),
// 'param_name' => 'text',
// 'admin_label' => true,
// 'group' => esc_html__( 'Text', 'wolf-core' ),
// ),

// array(
// 'type' => 'dropdown',
// 'heading' => esc_html__( 'Icon Animation', 'wolf-core' ),
// 'param_name' => 'inner_animation',
// 'value' => array(
// esc_html__( 'No', 'wolf-core' ) => '',
// esc_html__( 'Yes', 'wolf-core' ) => 'yes',
// ),
// ),

// array(
// 'type' => 'wolf_core_textfield',
// 'heading' => esc_html__( 'Icon Animation Delay', 'wolf-core' ),
// 'param_name' => 'inner_animation_delay',
// 'dependency' => array( 'element' => 'inner_animation', 'value' => array( 'yes' ) ),
// ),

// array(
// 'type' => 'vc_link',
// 'heading' => esc_html__( 'Link', 'wolf-core' ),
// 'param_name' => 'link',
// 'group' => esc_html__( 'Text', 'wolf-core' ),
// ),

// array(
// 'type' => 'checkbox',
// 'heading' => esc_html__( 'Scroll to anchor?', 'wolf-core' ),
// 'param_name' => 'scroll_to_anchor',
// 'group' => esc_html__( 'Text', 'wolf-core' ),
// ),
// ),
// 'js_view' => 'VcIconElementView_Backend',
// );
// }
