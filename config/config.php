<?php

  // DB Params
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'stockphp');


  //authentication in sending mail
  define('MAIL_PASS', '');

  //set default timezone
  date_default_timezone_set('Europe/Brussels');

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)));
  // URL Root
  define('URLROOT', 'http://localhost/King-tech');
  // Site Name
  define('SITENAME', 'King Tech');
  // App Version
  define('APPVERSION', '1.0.0');