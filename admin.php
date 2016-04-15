<?php
require_once ('authorize.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<img src="https://inspirationfeeed.files.wordpress.com/2013/01/rihm-logo-31.jpg" style="height: 50px; width: 50px; position: absolute;"/>
<h2 style="font-size: 35px; font-family: Damascus; color: rgba(219, 0, 10, 0.75); margin-left: 60px;">Shelved Admin</h2>
<p style="margin-left: 80px; margin-top: -20px;">Below is a list of all users. It is Admins job to approve and remove people as needed. </p>
​
<?php
// Connect to the database
$dbh = new PDO('mysql:host=127.0.0.1;dbname=subdb', 'root', 'root');
// Retrieve the score data from MySQL
$query = "SELECT * FROM users";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
?>

<?php
// Loop through the array of score data, formatting it as HTML
// Loop through the array of score data, formatting it as HTML
echo '<table style=" width: 1000px; background-color: lightblue;">';
echo '<tr style="font-family: Stencil Std; font-size: 30px;">
    <th>Name</th>
    <th>Email</th>
    <th>Action</th>
    </tr>';
foreach ($result as $row) {
  // Display the score data
  echo '<tr class="scorerow" >
<td style="text-align: center;">
<strong>' . $row['username'] . '</strong>
</td> ';
  echo '<td style="text-align: center;">' . $row['email'] . '</td>';
  echo '<td style="text-align: center;">
<a href="removescore.php?id=' . $row['id'] . '&amp;username=' . $row['username'] . '&amp;email=' . $row['email'] .
      '">Remove</a>';
  if($row['approved'] == '0'){
    echo '/ <a href="approvescore.php?id='. $row['id'] . '&amp;username=' . $row['username'] . '&amp;email=' . $row['email'].
        '">Approved</a>';
  }
  echo '</td>
</tr>';
}
echo '</table>';
?>
​
</body>
</html>