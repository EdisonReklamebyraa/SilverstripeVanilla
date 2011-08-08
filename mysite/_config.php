<?php

global $project;
$project = 'mysite';

global $database;
$database = 'vanila';

require_once('conf/ConfigureFromEnv.php');

MySQLDatabase::set_connection_charset('utf8');

SSViewer::set_theme('theme');

SiteTree::enable_nested_urls();

Director::set_dev_servers(array(
        'vanilla.webdeal.edisonservers.no', 
        'localhost'
));  
Director::set_environment_type("dev");
