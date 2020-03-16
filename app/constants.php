<?php
# Web application parameters.
define("APP_TITLE", "FastTrade 08");
define("APP_ROOT", trim(dirname($_SERVER["REQUEST_URI"])));
define("APP_DOMAIN", trim($_SERVER["SERVER_NAME"]));
define("APP_TZ", "Asia/Singapore");

// Session ID key
define("SESSION_LOGIN", "loginid");
define("SESSION_UNAME", "S_UNAME");
define("SESSION_RIGHTS", "S_RIGHTS");
define("SESSION_CSRF_TOKEN", "_csrf");
define("SESSION_CSRF_EXPIRE", "_csrf-expire");

# Sensitive parameters.
require_once("app/private/database.php");
?>