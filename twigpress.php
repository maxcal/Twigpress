<?php

/*
  Plugin Name: Twigpress
  Plugin URI: http://www.github.com/maxcal/twigpress/
  Description: Use the Twig Engine for your wordpress templates, built on the work of Fabien Potencier and Darko Golešö .
  Version: 0.1
  Author: Max Calabrese,
  Author URI: http://github.com/maxcal
  License: GPL2
 */

/*  Copyright Max Calabrese 2012

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

/**
 * This is a generic bootstrap
 * Feel free to roll your own.
 */
require_once __DIR__."/vendor/autoload.php";

$Twigpress = new Twigpress_Environment();

if (function_exists("add_action")){
    add_action('init', array($Twigpress, 'init'));
}