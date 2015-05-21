<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'conquest_data';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

$db['hall_pass']['hostname'] = 'localhost';
$db['hall_pass']['username'] = 'root';
$db['hall_pass']['password'] = '';
$db['hall_pass']['database'] = 'hall_pass';
$db['hall_pass']['dbdriver'] = 'mysql';
$db['hall_pass']['dbprefix'] = '';
$db['hall_pass']['pconnect'] = TRUE;
$db['hall_pass']['db_debug'] = TRUE;
$db['hall_pass']['cache_on'] = FALSE;
$db['hall_pass']['cachedir'] = '';
$db['hall_pass']['char_set'] = 'utf8';
$db['hall_pass']['dbcollat'] = 'utf8_general_ci';
$db['hall_pass']['swap_pre'] = '';
$db['hall_pass']['autoinit'] = TRUE;
$db['hall_pass']['stricton'] = FALSE;

$db['resume']['hostname'] = 'localhost';
$db['resume']['username'] = 'root';
$db['resume']['password'] = '';
$db['resume']['database'] = 'resume';
$db['resume']['dbdriver'] = 'mysql';
$db['resume']['dbprefix'] = '';
$db['resume']['pconnect'] = TRUE;
$db['resume']['db_debug'] = TRUE;
$db['resume']['cache_on'] = FALSE;
$db['resume']['cachedir'] = '';
$db['resume']['char_set'] = 'utf8';
$db['resume']['dbcollat'] = 'utf8_general_ci';
$db['resume']['swap_pre'] = '';
$db['resume']['autoinit'] = TRUE;
$db['resume']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */