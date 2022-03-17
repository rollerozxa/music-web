<?php
$host = '127.0.0.1';
$db   = 'music';
$user = '';
$pass = '';

$tplCache = 'templates/cache';
$tplNoCache = false; // **DO NOT SET AS TRUE IN PROD - DEV ONLY**

// Array of memcached server(s) for memcache caching. Leave empty to disable memcache caching.
$memcachedServers = [];

$lpp = 20;

// Website domain.
$domain = 'https://example.org';

// Configure whether your instance of music-web requires users to be logged in.
$secretClub = true;
