<?php
if($_SERVER['HTTP_HOST'] == 'localhost'):
    define('BASE', 'http://localhost/feegow');
else:
    define('BASE', 'https://localhost/feegow');
endif;
define('THEME', 'feegow');

if (!empty($_SESSION['THEME'])):
    define('THEME', $_SESSION['THEME']);
endif;

define('INCLUDE_PATH', BASE . '/themes/' . THEME);
define('REQUIRE_PATH', 'themes/' . THEME);