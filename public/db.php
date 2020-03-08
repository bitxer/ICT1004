<!--
    This is a test file and will be removed in production
-->
<?php
    require_once("../app/model/User.php");
    $values = [
        'loginid'=>'b',
        'password'=>'b',
        'email'=>'b',
        'name'=>'b',
        'isadmin'=>0
    ];
    // Select with filter
    var_dump(get_user("*", ['id'=>['=', 15]]));

    //Add user
    $user = new User($values);
    $user->add();
    echo "<h1>Added user</h1><br>";
    var_dump(get_user());
    $user = get_user()[1];

    //Update user
    var_dump($user);
    $values = [
        'loginid'=>'c',
        'password'=>'c',
        'email'=>'c',
        'name'=>'c',
        'isadmin'=>0
    ];
    foreach ($values as $key=>$val) {
        $user->setValue($key, $val);
    }
    var_dump($user);
    echo "<h1>Update user</h1><br>";
    $user->update();
    var_dump(get_user());


    echo "<h1>Delete user</h1><br>";
    $user->delete();
    var_dump(get_user());

?>