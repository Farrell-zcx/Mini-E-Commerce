<?php

/**
 * CodeIgniter 4 IDE Helper
 * 
 * File ini TIDAK dijalankan oleh aplikasi.
 * Tujuannya hanya untuk menghilangkan error merah di VS Code (Intelephense)
 * dengan mendeklarasikan fungsi-fungsi bawaan CodeIgniter 4.
 */

// ============================================================
// Helper Functions (dari system/Common.php & system/Helpers/)
// ============================================================

/**
 * Generates a hidden CSRF token input field.
 * @return string
 */
function csrf_field(?string $id = null): string { return ''; }

/**
 * Returns the CSRF token name.
 * @return string
 */
function csrf_token(): string { return ''; }

/**
 * Returns the CSRF hash value.
 * @return string
 */
function csrf_hash(): string { return ''; }

/**
 * Performs simple auto-escaping of data for security.
 * @param mixed $data
 * @param string $context
 * @param string|null $encoding
 * @return mixed
 */
function esc($data, string $context = 'html', ?string $encoding = null) { return $data; }

/**
 * Returns the session instance or session value.
 * @param string|null $key
 * @return \CodeIgniter\Session\Session|mixed
 */
function session(?string $key = null) { return null; }

/**
 * Returns a full site URL string.
 * @param mixed $relativePath
 * @param string|null $scheme
 * @return string
 */
function base_url($relativePath = '', ?string $scheme = null): string { return ''; }

/**
 * Returns a full site URL string.
 * @param string $relativePath
 * @param string|null $scheme
 * @return string
 */
function site_url(string $relativePath = '', ?string $scheme = null): string { return ''; }

/**
 * Convenience method for loading a view.
 * @param string $name
 * @param array $data
 * @param array $options
 * @return string
 */
function view(string $name, array $data = [], array $options = []): string { return ''; }

/**
 * Returns the redirect instance.
 * @param string|null $route
 * @return \CodeIgniter\HTTP\RedirectResponse
 */
function redirect(?string $route = null) {}

/**
 * Returns a service instance.
 * @param string $name
 * @return mixed
 */
function service(string $name, ...$params) { return null; }

/**
 * Returns a shared service instance.
 * @param string $name
 * @return mixed
 */
function single_service(string $name, ...$params) { return null; }

/**
 * Loads a helper file.
 * @param string|array $filenames
 */
function helper($filenames): void {}

/**
 * Returns the old input value.
 * @param string $key
 * @param mixed $default
 * @param string|false $escape
 * @return mixed
 */
function old(string $key, $default = null, $escape = 'html') { return $default; }

/**
 * Returns the current URL string.
 * @return \CodeIgniter\HTTP\URI
 */
function current_url(bool $returnObject = false) { return ''; }

/**
 * Returns the previous URL string.
 * @param bool $returnObject
 * @return \CodeIgniter\HTTP\URI|string|null
 */
function previous_url(bool $returnObject = false) { return ''; }

/**
 * Returns a URI string.
 * @param string|null $uri
 * @return string
 */
function uri_string(?string $uri = null): string { return ''; }

/**
 * Provides access to the global cache object.
 * @return \CodeIgniter\Cache\CacheInterface
 */
function cache(?string $key = null) { return null; }

/**
 * Provide access to the global configuration object.
 * @param string $name
 * @return mixed
 */
function config(string $name) { return null; }

/**
 * Provide access to the global logger.
 * @param string $level
 * @param string $message
 * @param array $context
 * @return void
 */
function log_message(string $level, string $message, array $context = []): void {}

/**
 * Returns the environment setting.
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function env(string $key, $default = null) { return $default; }

/**
 * Set and get flash messages.
 * @param string $name
 * @param string $message
 * @return mixed
 */
function set_cookie($name, string $value = '', string $expire = '', string $domain = '', string $path = '/', string $prefix = '', bool $secure = false, bool $httpOnly = false, ?string $sameSite = null): void {}
