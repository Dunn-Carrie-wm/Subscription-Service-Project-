<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Sign Up </title>
    <link href="https://assets.onestore.ms/cdnfiles/onestorerolling-1601-22000/shell/v3/scss/shell.min.css"
          rel="stylesheet" type="text/css" media="screen"/>
    <link href="signin.css" rel="stylesheet" type="text/css">
    <script src="signin.js" type="text/javascript"></script>
</head>
<body>
<?php
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=subdb', 'root', 'root');

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
if(@$_POST['formSubmit'] == "Submit")
{
    $errorMessage = "";

    if(empty($_POST['username']))
    {
        $errorMessage = "<li>You forgot to enter your username.</li>";
    }
    if(empty($_POST['email']))
    {
        $errorMessage = "<li>You forgot to enter your email.</li>";
    }
    if(empty($_POST['password']))
    {
        $errorMessage = "<li>You forgot to enter your last password.</li>";
    }


    $stmt = $dbh->prepare("INSERT INTO users (username, email, password ) VALUES (?, ?, ?)");

    $result = $stmt->execute(array($_POST['username'], $_POST['email'], $_POST['password']));

    if(!$result){
        print_r($stmt->errorInfo());
    }
    else{
        $msg = 'Thank you for subscribing to Shelved.';
        $from = 'admin@shelved.com';
        mail($_POST['email'], 'Shelved Subscription' , $msg, 'From:' . $from);
    }

    if(!empty($errorMessage))
    {
        echo("<p>There was an error with your form:</p>\n");
        echo("<ul>" . $errorMessage . "</ul>\n");
    }

}?>


<div class="site__container">
    <h1 style="text-align: center; font-size: 70px;">Sign up</h1>
    <h3 style="text-align: center; font-size: 20px;">By signing up, you are agreeing to subscribing to weekly newsletter. </h3>
    <div class="grid__container">

        <form method="post" class="form form--login">

            <div class="form__field">
                <label class="fontawesome-user" for="login__username"><span class="hidden">Username</span></label>
                <input type="text" name="username" placeholder="Username or E-mail"/>

            </div>
            <div class="form__field">
                <label class="fontawesome-lock" for="login__password"><span class="hidden">Email</span></label>
                <input type="text" name="email" placeholder="Email"/>

            </div>

            <div class="form__field">
                <label class="fontawesome-lock" for="login__password"><span class="hidden">Password</span></label>
                <input type="password" name="password" placeholder="Password"/>

            </div>

            <div class="form__field">
                <input type="submit" name="formSubmit" value="Submit" onclick="newPage()"/>
            </div>

        </form>

    </div>

</div>

</body>
</html>