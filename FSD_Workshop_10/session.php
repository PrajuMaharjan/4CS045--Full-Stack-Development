<?php
session_set_cookie_params([
	'httponly'=>true,
	'samesite'=>'Lax',
	'lifetime'=>0,
	'path'=>'/',
	'secure'=>false
]);

session_start();