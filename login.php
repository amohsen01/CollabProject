<?php
$db_user = "root";
$db_pass = "Y@853211min";
$db_name = "projectdb";
//$db_server = "Mysql@collablab.dyndns.org:3306"; 
$db_server2 = "localhost:3305"; 

$link = mysqli_connect($db_server2, $db_user, $db_pass, $db_name);

session_start();
//require_once('users.class.php');
$num1=0;
if (isset($_POST['login_user'])) {

  $username =  $_POST['username'];
  $password =$_POST['password'];
  if (empty($username) || empty($password)) {
    $num1++;
  }
  if ($num1 == 0) {
    //$password = md5($password);
    $query = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";
    $results = mysqli_query($link, $query);
    if (mysqli_num_rows($results) == 1) {
      while($row = mysqli_fetch_assoc($results)){
 $_SESSION['username']    = $row['username'];
 $_SESSION['firstname']    = $row['firstname'];
  $_SESSION['Lastname']    = $row['Lastname'];
   
 $_SESSION['idregs']=$row['idregs'];
   
  }
  
$_SESSION['i1_id']=$id;
      header('location: accountPage1.html');
    }
    else {
      echo '<script language="javascript">';
        echo  'alert("Wrong username or password combination")';

        echo '</script>';
        header('location: index.html');

    }

}
    
}
?>