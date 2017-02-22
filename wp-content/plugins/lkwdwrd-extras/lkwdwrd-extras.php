<?php
/**
 * Plugin Name: LkWdwrd Extras
 * Plugin URI:  http://lkwdwrd.com/
 * Description: Extra goodies for LkWdwrd.com
 * Version:     0.1.0
 * Author:      Luke Woodward
 * Author URI:  http://lkwdwrd.com
 * License:     GPLv2+
 * Text Domain: lkwdwrd
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 10up (email : info@10up.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using yo wp-make:plugin
 * Copyright (c) 2014 10up, LLC
 * https://github.com/lkwdwrd/generator-wp-make
 */

// Useful global constants
define( 'LKWDWRD_VERSION', '0.1.0' );
define( 'LKWDWRD_URL',     plugin_dir_url( __FILE__ ) );
define( 'LKWDWRD_PATH',    dirname( __FILE__ ) . '/' );
define( 'LKWDWRD_INC',     LKWDWRD_PATH . 'includes/' );

// Include files
require_once LKWDWRD_INC . 'class-lkwdwrd-extras.php';
require_once LKWDWRD_INC . 'class-post-series.php';

// Wireup actions
add_action( 'plugins_loaded', array( 'lkwdwrd_extras', 'load' ) );
add_action( 'lkwdwrd_loaded', array( 'LkWdwrd_Post_Series', 'load' ) );
