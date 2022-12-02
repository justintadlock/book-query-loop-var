<?php
/**
 * Plugin Name:       Book Query Loop Var
 * Plugin URI:        https://github.com/justintadlock/book-query-loop-var
 * Description:       A book custom post type with a Query Loop variation.
 * Version:           1.0.0
 * Requires at least: 6.1
 * Requires PHP:      7.4
 */

namespace BookQueryLoopVar;

// Load classes and files.
require_once 'inc/Book.php';
require_once 'inc/Variation.php';
require_once 'inc/functions-helpers.php';

// Bootstrap the plugin.
plugin();
