<?php
require('lib/common.php');

$twig = twigloader();

$allSongs = query("SELECT * FROM music ORDER BY name ASC");

echo $twig->render('index.twig', [
	'all_songs' => $allSongs
]);
