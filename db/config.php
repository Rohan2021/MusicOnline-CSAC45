<?php
/*
*	This is the configuration file for the whole framework
*	Please set the various constants and variables below
*/

// array to hold all the configuration details
$config = array();

// Define if environment is production or development
// dev - Development Environment
// pro - Production Environment
$config['env'] = 'dev';
 
// setting $debug to true will echo out all the errors
$config['debug'] = TRUE;

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

if ($config['env'] == 'dev') {
    // set the values for the development environment
    //$config['base_url'] = 'http://localhost/smartpolling';
    $config['db_host'] = 'localhost';
    $config['db_name'] = 'vmusic';
    $config['db_user'] = 'root';
    $config['db_pass'] = '123456789';
}
?>
