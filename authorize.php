<?php
$adminuser='Books';
$password='Books';
if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != $adminuser) || ($_SERVER['PHP_AUTH_PW'] != $password)){
    header('HTTP/ 1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Guitar Wars"');
    exit('<h2> Shelved </h2> Sorry, You must enter a valid username and password to'. 'access this page.');
}
?>