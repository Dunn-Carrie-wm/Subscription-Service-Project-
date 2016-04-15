<?php
require_once ('authorize.php');
?>
​
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Approve a User</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<img src="https://inspirationfeeed.files.wordpress.com/2013/01/rihm-logo-31.jpg" style="height: 50px; width: 50px; position: absolute; margin-top: 40px;  "/>
<h2 style="font-size: 35px; font-family: Damascus; color: rgba(219, 0, 10, 0.75); margin-left: 60px;">Approve Users</h2>
​
<?php

if (isset($_GET['id']) && isset($_GET['username']) && isset($_GET['email'])) {
    // Grab the score data from the GET
    $id = $_GET['id'];
    $username = $_GET['username'];
    $email = $_GET['email'];

}
else if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
}
else {
    echo '<p class="error">Sorry.</p>';
}
if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
        // Connect to the database
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=subdb', 'root', 'root');
        // Approve the score by setting the approved column in the database
        $query = "UPDATE users SET approved = 1 WHERE id = $id";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        // Confirm success with the user
        echo '<p>The user ' . $username . ' was successfully approved.';
    }
    else {
        echo '<p class="error">Sorry, there was a problem approving the user</p>';
    }
}
else if (isset($id) && isset($username) && isset($email) && isset($password)) {
    echo '<p style="font-size: 20px; margin-left: 70px; margin-top: -30px;">Are you sure you want to approve the following user</p>';
    echo '<p style="font-size: 20px; margin-left: 80px;"><strong style="color: #8CA6DB">Name: </strong>' . $username . '<br /><strong style="color: #ff63f0;">Email: </strong>' . $email . '</p>';
    echo '<form method="post" action="approvescore.php">';
    echo '<input type="radio" name="confirm" value="Yes" style="margin-left: 80px; margin-top: 10px;"/> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="Submit" name="submit" style="width: 100px; height: 40px; margin-top: 10px; margin-left: 80px;"/>';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="username" value="' . $username . '" />';
    echo '<input type="hidden" name="email" value="' . $email . '" />';
    echo '</form>';
}
echo '<a href="admin.php"><button style=" background-color: #ff5f10; height: 30px; width: 200px; margin-top: 20px; border-radius: 4px;"> Back to admin page?</button></a>';
?>
​
</body>
</html>