<?php

/**
 * Twig loader, initializes Twig with standard configurations and extensions.
 *
 * @param string $subfolder Subdirectory to use in the templates/ directory.
 * @return \Twig\Environment Twig object.
 */
function twigloader($subfolder = '') {
	global $tplCache, $tplNoCache, $log, $userdata;

	$doCache = ($tplNoCache ? false : $tplCache);

	$loader = new \Twig\Loader\FilesystemLoader('templates/' . $subfolder);

	$twig = new \Twig\Environment($loader, [
		'cache' => $doCache,
	]);

	$twig->addExtension(new MusicWebExtension());

	$twig->addGlobal('log', $log);
	$twig->addGlobal('userdata', $userdata);

	return $twig;
}

function track($track) {
	$twig = twigloader('components');
	return $twig->render('track.twig', ['track' => $track]);
}

function redirect($url) {
	header(sprintf('Location: %s', $url));
	die();
}
