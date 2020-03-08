<?php
# Web application parameters.
define("APP_TITLE", "FastTrade 08");
define("APP_ROOT", trim(dirname($_SERVER["REQUEST_URI"])));
define("APP_DOMAIN", trim($_SERVER["SERVER_NAME"]));
define("APP_TZ", "Asia/Singapore");

# Sensitive parameters.
require_once("app/private/database.php");
?>