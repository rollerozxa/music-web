<?php

function isCli() {
	return php_sapi_name() == "cli";
}
