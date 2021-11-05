<?php
if (!file_exists('conf/config.php')) {
	die('Please read the installing instructions in the README file.');
}

// load profiler first
require_once('lib/profiler.php');
$profiler = new Profiler();

require_once('conf/config.php');
require_once('vendor/autoload.php');
foreach (glob("lib/*.php") as $file) {
	require_once($file);
}

// Authentication code.
if (isset($_COOKIE['login-token'])) {
	$id = result("SELECT id FROM users WHERE token = ?", [$_COOKIE['login-token']]);

	if ($id) {
		// Valid password cookie.
		$log = true;
	} else {
		// Invalid password cookie.
		$log = false;
	}
} else {
	// No password cookie.
	$log = false;
}

if ($log) {
	$userdata = fetch("SELECT * FROM users WHERE id = ?", [$id]);
} else {

}

// I'm a self-centered egomaniac! Time itself centers around me!
date_default_timezone_set('Europe/Stockholm');
