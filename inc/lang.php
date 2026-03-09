<?php

/**
 * Multi-language support for HaLong24h
 *
 * Usage:
 *   1. Include this file after session_start()
 *   2. Use __('key') to get translated string
 *   3. Switch language via ?lang=vi or ?lang=en
 */

// Default language
define('DEFAULT_LANG', 'vi');
define('SUPPORTED_LANGS', ['vi', 'en']);

// Detect admin context (admin lang is independent from frontend)
$_is_admin_context = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false);
$_lang_session_key = $_is_admin_context ? 'admin_lang' : 'lang';

// Detect and set language
if (isset($_GET['lang']) && in_array($_GET['lang'], SUPPORTED_LANGS)) {
    $_SESSION[$_lang_session_key] = $_GET['lang'];
}

$current_lang = $_SESSION[$_lang_session_key] ?? DEFAULT_LANG;

// Load language file
$lang_file = __DIR__ . '/../lang/' . $current_lang . '.php';
if (file_exists($lang_file)) {
    $GLOBALS['_LANG'] = require $lang_file;
} else {
    $GLOBALS['_LANG'] = require __DIR__ . '/../lang/vi.php';
}

/**
 * Get translated string
 * @param string $key Translation key
 * @param string $default Fallback text (if empty, returns key)
 * @return string
 */
function __($key, $default = '') {
    if (isset($GLOBALS['_LANG'][$key])) {
        return $GLOBALS['_LANG'][$key];
    }
    return $default ?: $key;
}

/**
 * Echo translated string
 */
function _e($key, $default = '') {
    echo __($key, $default);
}

/**
 * Get current language code
 */
function current_lang() {
    $is_admin = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false);
    $key = $is_admin ? 'admin_lang' : 'lang';
    return $_SESSION[$key] ?? DEFAULT_LANG;
}

/**
 * Check if current language is the given one
 */
function is_lang($lang) {
    return current_lang() === $lang;
}

/**
 * Generate URL with language parameter
 */
function lang_url($url, $lang) {
    $separator = (strpos($url, '?') !== false) ? '&' : '?';
    return $url . $separator . 'lang=' . $lang;
}
