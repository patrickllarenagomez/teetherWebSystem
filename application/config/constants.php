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

define('NAME', 'name');
define('USER', 1);
define('ADMIN', 2);
define('SUPERADMIN', 3);
define('TBL_MAP', 'tbl_map');
define('TBL_USERS', 'tbl_users');
define('TBL_USER_VERIFICATION', 'tbl_user_verification');
define('USER_ID', 'user_id');
define('USERNAME', 'username');
define('USER_PASSWORD','user_password');
define('USER_LEVEL','user_level');
define('USER_FIRSTNAME','user_firstname');
define('USER_LASTNAME','user_lastname');
define('USER_EMAIL', 'user_email');
define('USER_PIC', 'user_pic');
define('IS_ACTIVE', 'is_active');	
define('VERIFICATION_ID','verification_id');
define('USER_KEY', 'user_key');
define('ACTIVE', 1);
define('INACTIVE', 0);
define('SERVICE_ID', 'service_id');
define('TBL_SERVICE', 'tbl_service');
define('SERVICE_NAME', 'service_name');
define('INSERTED_DATE','inserted_date');
define('SERVICE_BY_USER_ID', 'service_by_user_id');
define('TBL_PATIENTS', 'tbl_patients');
define('PATIENT_ID', 'patient_id');
define('USER_CLINIC_ID', 'user_clinic_id');
define('APPOINTMENT_DATE', 'appointment_date');
define('TBL_STOCKS', 'tbl_stocks');
define('TBL_APPOINTMENTS', 'tbl_appointments');
define('APPOINTMENT_ID','appointment_id');
define('APPOINTMENT_TIME','appointment_time');
define('IS_ACCEPTED','is_accepted');
define('STOCK_ID', 'stock_id');
define('STOCK_NAME', 'stock_name');
define('STOCK_QUANTITY', 'stock_quantity');
define('SERVICE_PRICE','service_price');
define('TBL_STORAGE', 'tbl_storage');
define('STORAGE_ID', 'storage_id');
define('STORAGE_NAME', 'storage_name');
define('NONE', '-----');
define('TBL_STOCKS_HISTORY', 'tbl_stocks_history');
define('STOCK_HISTORY_ID', 'stock_history_id');
define('TBL_INVOICES', 'tbl_invoices');
define('IS_PAID', 'is_paid');
define('IS_VERIFIED', 'is_verified');
define('INVOICE_NAME', 'invoice_name');
define('PAID', 1);
define('UNPAID', 0);
define('DATE_OF_PAYMENT', 'date_of_payment');
define('SYSTEMNAME', 'Teether');