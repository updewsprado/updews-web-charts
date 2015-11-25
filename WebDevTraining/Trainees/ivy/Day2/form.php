<html>
<head>
</head>
<body style="background-color:lightgrey">
<center>
  <div id="header">
  <h1>City Cars</h1>
  </div>


<p>This is a paragraph.</p>


<?php
require('connect.php');

if (isset($_POST['submit']))
{
 $email1 = $_POST['email1'];
 $email2 = $_POST['email2'];
 

 if($email1 == $email2)
 {
   
   $name = mysql_escape_string($_POST['name']);
   $age = mysql_escape_string($_POST['age']);
   $email1 = mysql_escape_string($_POST['email1']);
   $email2 = mysql_escape_string($_POST['email2']);


   $check = mysql_query("SELECT * FROM users WHERE email = '$email1'")or die(mysql_error());
   if (mysql_num_rows($check)>=1) echo "Email Address already taken";
   //Put everyting in DB
   else{
   mysql_query("INSERT INTO `users` (`id`, `name`, `age`, `email`) VALUES (NULL, '$name', '$age', '$email1')") or die(mysql_error());
   echo "Registration Successful";
   }
 }
 else{
  echo "Sorry, your email's  do not match. <br />";
 }




}
else{
$form = <<<EOT
<form action="form.php" method="POST">
Name:&nbsp <input type="text" name="name" /><br />
Age: &nbsp &nbsp&nbsp<input type="number" name="age" /><br />
Email:&nbsp <input type="text" name="email1" /><br />
Confirm Email: <br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="text" name="email2" /><br />
<input type="submit" value="Register" name="submit" />
</form>
EOT;

echo $form;

}

?>
</center>
</body>
</html>