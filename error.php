<?php
$currentFile = $_SERVER['SCRIPT_NAME'];
$arrCurrentFile = split('/', $currentFile);
$base_url = $_SERVER['SERVER_NAME'] . substr($currentFile, 0, strlen($currentFile) - strlen(end($arrCurrentFile))) . 'error';
header("Location: http://" . $base_url);