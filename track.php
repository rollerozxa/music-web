<?php
require('lib/common.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

$track = fetch("SELECT * FROM music WHERE id = ?", [$id]);

if (!$track) error('404', "Invalid track ID.");

$twig = twigloader();
echo $twig->render('track.twig', [
	'track' => $track
]);
