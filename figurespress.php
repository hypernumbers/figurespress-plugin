<?php
/**
 * @package FiguresPress
 * @version 1.0
 */
/*
Plugin Name: FiguresPress
Plugin URI: http://wordpress.org/extend/plugins/figurespress/
Description: Turbocharges WordPress by putting a spreadsheet behind every page
Author: Gordon Guthrie
Version: 1.0
Author URI: http://wordpress.vixo.com
License: GPL2
*/

/*  Copyright 2013 Hypernumbers Ltd (trading as vixo.com) gordon@vixo.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
  Include in the code that provides the shortcode
  This means users can insert [fp cells="a10:b15"]
  In their text and it will insert a vixo control
*/

// setup localisation
  load_plugin_textdomain( 'figurespress-plugin', false, 'figurespress-plugin/languages' );

//include 'includes/figurespress-activate.php';
include 'includes/debug-logger.php';
include 'includes/figurespress-spreadsheet-buttons.php';
include 'includes/figurespress-options.php';
?>