<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define("TAB_TITLE","Yoga with Emilia");
define("API_KEY","USD");
define("OUTLET_REFERENCE","USD");

define('STRIPE_TOKEN_URI', 'https://connect.stripe.com/oauth/token');
define('STRIPE_AUTHORIZE_URI', 'https://connect.stripe.com/oauth/authorize');
define('STRIPE_SECRET_KEY',"sk_test_51Idt8MFCIuLkzsw2ejHwZS9LZr1m3Wyat9ub11kyoWe6cKka7nJXJj5dtbbrtzHN2C84XS6Z0m8dS4mIniWEGr1T00IZnfYwRU");//sk_test_51HU63IBs2CQ90tyB3GMfjB1bCSIPgcUNCe0x9cgC4RqXo9pOp1J9xzqHaheuR3s0pCF7LDbQSYUb7JwWl40HVvJ2009epAwLWw
define('STRIPE_PUBLISHABLE_KEY',"pk_test_51Idt8MFCIuLkzsw2N96OS4TwW6OKdOBiKA8ILzaqLArgorVWzeGFFccTbnfidDdp9hFdDTIRzbWcveIP5eOytl9j00lp9GVimL"); ///pk_test_51HU63IBs2CQ90tyBy39fpSXE56MyQQAR8jCxfbJuav6037Zt6OjRCbILGtQkMes5xRk7WrOuRnY5HVVNP6e0iLnI00fNpcv9lQ
//define('WEBSITE_URL',"http://siegedata.azurewebsites.net");
define('STRIPE_CURRENCY',"usd");

define("INSTA_USER_ID","17841401273880359");
define("INSTA_TOKEN","IGQVJWLXZAnQVVMSWZAQcGJmZAWoyUFk3czRkVTNpdTF4c3lfZAmJwN3pwUVBESGpjdGlfa2ZAxZAlJlakZA2dGZA0LXliMU9BTXA1MXpjNVNQTjNJTWRVdVI1VHFGYi1PbVgzVzJOVGtFZA0szVGdQVk53VlF0cwZDZD");