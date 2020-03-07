<?php
session_start();

$_SESSION['name'] = 'TempPlaceholder';
?>

User: <?=$_SESSION['name']?> |  or whatever

<?php
    var_dump($data['blog_info']);
?>