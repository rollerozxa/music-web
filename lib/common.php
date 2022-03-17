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

if (!isCli()) {

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
	if ($_SERVER['PHP_SELF'] != "/login.php" && $secretClub) {
		$rdir = ($_SERVER['REQUEST_URI'] != '/' ? '?rdir='.$_SERVER['REQUEST_URI'] : '');
		redirect('/login.php'.$rdir);
	}
}

} else {
	$log = false;
	$userdata = [];
}

// I'm a self-centered egomaniac! Time itself centers around me!
date_default_timezone_set('Europe/Stockholm');
