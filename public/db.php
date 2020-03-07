<!--
    This is a test file and will be removed in production
-->
<?php
    require_once("../app/database/Connection.php");
    $db = new MySQL();
    $db->connect();
    // Insert values
    // $fields = ['loginid', 'password', 'email', 'name','isadmin'];
    // $values = ['a', 'a', 'a', 'a', '0'];
    // echo $db->insert('users', $fields, $values);

    // Select values
    // $rows =  $db->query('users', "*", ['loginid' => ['=', 'a']]);
    // var_dump($rows);

    // Update values
    // echo $db->update('users', ['loginid' => 'b'], ['loginid' => ['=', 'a']]);
    // Delete values
    // echo $db->delete('users', ['loginid' => ['=', 'b']]);
?>