<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

$project_name = 'rental_peralatan_teknologi_github';

$pos = strpos($path, $project_name);

$base_url = substr($path, 0, $pos + strlen($project_name));

define('BASE_URL', $base_url);
?>