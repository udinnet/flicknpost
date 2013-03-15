<?php
defined('DS') ? NULL: define('DS',DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? NULL:define('SITE_ROOT', DS.'var'.DS.'www'.DS.'html'.DS.'dev'.DS.'fnp');
defined('LIB_PATH')?NULL:define('LIB_PATH',SITE_ROOT.DS.'includes');

//basic config file
require_once (LIB_PATH.DS.'config.php');

//basic functions
require_once (LIB_PATH.DS.'functions.php');
require_once (LIB_PATH.DS.'templater.php');
require_once (LIB_PATH.DS.'postmaster.php');

//core objects
require_once (LIB_PATH.DS.'session.php');
require_once (LIB_PATH.DS.'database.php');
require_once (LIB_PATH.DS.'database_object.php');  // Needs late static binding PHP 5.3

//database related objects
require_once (LIB_PATH.DS.'user.php');
require_once (LIB_PATH.DS.'photograph.php');
require_once (LIB_PATH.DS.'comment.php');
require_once (LIB_PATH.DS.'pagination.php');
?>
