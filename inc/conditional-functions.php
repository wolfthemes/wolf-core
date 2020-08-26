<?php
/**
 * %NAME% frontend functions
 *
 * General core functions available on admin.and frontend
 *
 * @author WolfThemes
 * @category Core
 * @package %PACKAGENAME%/Frontend
 * @version %VERSION%
 */

defined( 'ABSPATH' ) || exit;

/**
 * Check if we are on the WPB VC Frontend Editor
 *
 * @return string plugin slug
 */
function wolf_core_is_wpb_vc_frontend() {
    return function_exists( 'vc_is_inline' ) && vc_is_inline() ? true : false;
}