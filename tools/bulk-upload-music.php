#!/usr/bin/php
<?php
require('lib/common.php');

print("bulk-uploading from music_wip...\n");

foreach (glob("music_wip/*") as $path) {
	$file = explode('/', $path)[1];
	printf("===================================\n");
	printf("Working on '%s' now...\n", $file);

	$extension = strtolower(explode('.', $file)[1]);
	$filename = strtolower(explode('.', $file)[0]);

	$metadata = shell_exec(sprintf("openmpt123 %s --info", $path));

	preg_match('/Title......: (.+)/', $metadata, $title);
	$title = (isset($title[1]) ? $title[1] : $filename);

	printf("Alright so this is a '%s' song called '%s'\n", $extension, $title);

	$filehash = hash("xxh128", file_get_contents($path));

	// Deduplication
	if (file_exists("music/$filehash")) {
		printf("Track has already been uploaded! Continuing. (matches hash %s)\n", $filehash);
		continue;
	}

	query("INSERT INTO music (id, name, title, `format`, uploaded) VALUES (?,?,?,?,?)",
		[$filehash, $filename, $title, $extension, time()]);

	copy($path, "music/$filehash");
}
