<?php
/**
 *  Trax runtime environment definitions
 *  @package PHPonTrax
 *  $Id$
 */

/**
 *  Location of the PEAR library on this system
 *
 *  Set automatically by the Pear installer when you install Trax with
 *  the <b>pear install</b> command.  If you are prevented from using
 *  <b>pear install</b>, change "@PHP-DIR@" by hand to the full filesystem
 *  path of the location where you installed the Pear modules needed
 *  by Trax.
 */
define("PHP_LIB_ROOT", "@PHP-DIR@");

/**
 *  Location of the directories constructed by the <b>trax</b>
 *  command.
 */
define("TRAX_ROOT", dirname(dirname(__FILE__)) . "/");

/**
 *  Location of the directory exposed to the public by Apache.
 *
 *  The <b>trax</b> command generates this as <i>TRAX_ROOT</i>/public/
 *  but you will probably want to move the files in public/ to somewhere under
 *  {@link http://httpd.apache.org/docs/2.0/  Apache}
 *  {@link http://httpd.apache.org/docs/2.0/mod/core.html#documentroot DocumentRoot}.
 *  Change the second argument to the full filesystem path to the
 *  directory that holds the files generated in public/
 */
define("TRAX_PUBLIC", dirname(dirname(dirname(__FILE__)))."/public");

/**
 *  Part of URL between domain name and Trax application
 *
 *  That part of the browser's URL after the domain name and before
 *  the location described by <i>TRAX_PUBLIC</i>.  If
 *  <i>TRAX_PUBLIC</i> is the same as
 *  {@link http://httpd.apache.org/docs/2.0/  Apache}
 *  {@link http://httpd.apache.org/docs/2.0/mod/core.html#documentroot DocumentRoot}, 
 *  then TRAX_URL_PREFIX is null.
 */
define("TRAX_URL_PREFIX",       null); # no trailing slash

/**
 *  The file extension of files in app/views.  Normally '.phtml'
 */
define("TRAX_VIEWS_EXTENTION",  "phtml");

/**
 *  Trax mode of operation
 *
 *  Must be one of: 'development', 'test' or 'production'.
 *  May be set in the
 *  {@link http://httpd.apache.org/docs/2.0/  Apache}
 *  configuration with the
 *  {@link  http://httpd.apache.org/docs/2.0/mod/mod_env.html#setenv SetEnv}
 *  directive.  If not set there, then it must be set here.
 */
if(isset($_SERVER) && array_key_exists('TRAX_MODE',$_SERVER)) {
    define("TRAX_MODE",   $_SERVER['TRAX_MODE']);
} else {
    define("TRAX_MODE",   "development");
}

/**
 *  Location of Trax components relative to TRAX_ROOT
 *  @global $GLOBALS['TRAX_INCLUDES']
 */
$GLOBALS['TRAX_INCLUDES'] =
    array( "models" => "app/models",
           "views" => "app/views",
           "controllers" => "app/controllers",
           "helpers" => "app/helpers",
           "layouts" => "app/views/layouts",
           "config" => "config",
           "environments" => "config/environments",
           "lib" => "lib",
           "app" => "app",
           "log" => "log",
           "vendor" => "vendor" ); // FIXME: generated by trax cmd

/**
 *  Set how errors are to be logged
 *
 *  The 'log_errors' 
 *  {@link http://www.php.net/manual/en/ref.errorfunc.php PHP configuration setting}
 *  determines whether PHP error messages should be sent to the
 *  {@link http://httpd.apache.org/docs/2.0/  Apache}
 *  {@link http://httpd.apache.org/docs/2.0/logs.html#errorlog error log}
 *  (log_errors false) or to the log file defined in the 'error_log'
 *  setting (log_errors true).  Trax uses a different log file for
 *  each of the three modes defined in TRAX_MODE.
 *  
 *  In your application you can write a message to this log file with
 *   the call <b>error_log("</b><i>text of message</i><b>")</b>.
 */
ini_set("log_errors", true);
ini_set("error_log",
	TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['log']."/".TRAX_MODE.".log"); 

/**
 *  Whether to generate debugging messages and send errors to the browser
 *
 *  The 'display_errors' 
 *  {@link http://www.php.net/manual/en/ref.errorfunc.php PHP configuration setting}
 *  determines whether error messages should be sent to the browser.
 *  It should be false for production systems.  DEBUG is a define that
 *  you can test for your own purposes.
 */
if(TRAX_MODE == "development") {
    define("DEBUG", true);
    ini_set("display_errors", "On");
} else {
    define("DEBUG", false);
    ini_set("display_errors", "Off");
}

/**
 *  Load database settings from config/database.ini
 */
$GLOBALS['TRAX_DB_SETTINGS'] =
    parse_ini_file(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['config']
                   ."/database.ini",true);
/**
 *  Define location of the Trax PHP modules
 *
 *  Should we use local copy of the Trax libs in vendor/trax or
 *  the server Trax libs in the php libs dir defined in PHP_LIB_ROOT
 */
if(file_exists(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['vendor']."/trax")) {
    define("TRAX_LIB_ROOT", TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['vendor']."/trax");
} elseif(file_exists(PHP_LIB_ROOT."/PHPonTrax/vendor/trax")) {
    define("TRAX_LIB_ROOT", PHP_LIB_ROOT."/PHPonTrax/vendor/trax");
} else {
    error_log("Can't determine where your Trax Libs are located.");
    exit;
}

# Set the include_path
ini_set("include_path",
        ".".PATH_SEPARATOR.   # current directory
        TRAX_LIB_ROOT.PATH_SEPARATOR.  # trax libs (vendor/trax or server trax libs)
        PHP_LIB_ROOT.PATH_SEPARATOR.  # php libs dir (ex: /usr/local/lib/php)
        TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['lib'].PATH_SEPARATOR. # app specific libs extra libs to include
        ini_get("include_path")); # add on old include_path to end

# Include Trax library files.
include_once("session.php");
include_once("input_filter.php");
include_once("trax_exceptions.php");
include_once("inflector.php");
include_once("active_record.php");
include_once("action_view.php");
include_once("action_controller.php");
include_once("action_mailer.php");
include_once("dispatcher.php");
include_once("router.php");

# Include the ApplicationMailer Class which extends ActionMailer for application specific mailing functions
if(file_exists(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['app']."/application_mailer.php")) {
    include_once(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['app']."/application_mailer.php");
}

# Include the application environment specific config file
if(file_exists(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['environments']."/".TRAX_MODE.".php")) {
    include_once(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['environments']."/".TRAX_MODE.".php");
}

/**
 *  Automatically load a file containing a specified class
 *
 *  Given a class name, derive the name of the file containing that
 *  class then load it.
 *  @param string class_name  Name of the class required
 */
function __autoload($class_name) {
    $file = Inflector::underscore($class_name).".php";
    $file_org = $class_name.".php";

    if(file_exists(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['models']."/$file")) {
        # Include model classes
        include_once(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['models']."/$file");
    } elseif(file_exists(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['controllers']."/$file")) {
        # Include extra controller classes
        include_once(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['controllers']."/$file");
    } elseif(file_exists(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['lib']."/$file")) {
        # Include users application libs
        include_once(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['lib']."/$file");
    } elseif(file_exists(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['lib']."/$file_org")) {
        # Include users application libs
        include_once(TRAX_ROOT.$GLOBALS['TRAX_INCLUDES']['lib']."/$file_org");
    }
}

// -- set Emacs parameters --
// Local variables:
// tab-width: 4
// c-basic-offset: 4
// c-hanging-comment-ender-p: nil
// indent-tabs-mode: nil
// End:
?>
