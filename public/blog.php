<?php
session_start();

$_SESSION['name'] = 'Placeholder';
?>

User: <?=$_SESSION['name']?> |  or whatever

<?php
    var_dump($data['blog_info']);
?>