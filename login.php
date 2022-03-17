<?php
require('lib/common.php');

if (isset($_POST['logout'])) {
	setcookie('login-token', '');
	redirect('/');
}

$error = '';

$rdir = (isset($_REQUEST['rdir']) ? $_REQUEST['rdir'] : '/');

if (isset($_POST['action'])) {
	$name = (isset($_POST['name']) ? $_POST['name'] : null);
	$pass = (isset($_POST['pass']) ? $_POST['pass'] : null);

	$logindata = fetch("SELECT id,password,token FROM users WHERE name = ?", [$name]);

	if (!$name || !$pass || !$logindata || !password_verify($pass, $logindata['password'])) $error .= 'Invalid credentials.';

	if ($error == '') {
		setcookie('login-token', $logindata['token'], 2147483647);

		redirect($rdir);
	}
}

$twig = twigloader();
echo $twig->render('login.twig', [
	'error' => $error,
	'secretclub' => $secretClub,
	'rdir' => $rdir
]);
