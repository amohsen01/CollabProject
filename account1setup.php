<?php
session_start();
$pictureNewName = ""; 
$db_user = "root";
$db_pass = "Y@853211min";
$db_name = "projectdb";
//$db_server = "Mysql@collablab.dyndns.org:3306"; 
$db_server2 = "localhost:3305"; 

$link = mysqli_connect($db_server2, $db_user, $db_pass, $db_name);


$query = "SELECT idregs FROM accounts WHERE idregs='".$_SESSION['idregs']."'";
    $results = mysqli_query($link, $query);
  if(mysqli_num_rows($results)>0){
if (isset($_POST['uploadProject'])) {	

    $prname=  mysqli_real_escape_string($link,$_POST['q3_projectName']);
    $github=  mysqli_real_escape_string($link,$_POST['q7_githubLink']);
    #$file = mysqli_real_escape_string($link,$_POST['file']);
    $description_long = mysqli_real_escape_string($link,$_POST['q10_description']);
    $description_short = mysqli_real_escape_string($link,$_POST['q11_shortDescription']);
    $cat = mysqli_real_escape_string($link,$_POST['q16_categories']);
    # $day=mysqli_real_escape_string($link,$_POST['q14_dueDate[0]']);
    $numTeams=  mysqli_real_escape_string($link,$_POST['q3_teamNum']);

  
        $picture = $_FILES['picture'];
          $picture_name=$picture['name'];
          $picturetmpName=$picture['tmp_name'];
          $pictureSize=$picture['size'];
          $pictureError=$picture['error'];
          $pictureType=$picture['type'];
        
        $fileExt= explode('.', $picture_name);
        $fileActualExt=strtolower(end($fileExt));
        
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($fileActualExt, $allowed)) {
          if ($pictureError === 0) {
            if($pictureSize <1000000)
            {
 
        
        $pictureNewName = "project".$_SESSION['idregs'].".".$fileActualExt;
        $fileDest='uploads/'.$pictureNewName;
        move_uploaded_file($picturetmpName,$fileDest);
        
        
        
            }
            else
            {
              echo "TOO big";
            }
          }
          else
          {
        echo "ERROR";
          }
        }
        else
        {
        echo "You cannot upload";
        }//end of pics
        
     


      $sql = "INSERT INTO projects (pr_name, pr_dscp, numOfTeam, github_link, pr_img, dueDate, MainID ,pr_shrtdscp, cat) 
      VALUES('$prname', '$description_long', '$numTeams', '$github','$pictureNewName', CURDATE(), '".$_SESSION['idregs']."', '$description_short',  '$cat')";
      mysqli_query($link, $sql) or die(mysqli_error($link));

      
}
}

else
{
  echo '<script language="javascript">';
        echo  'alert("Yxxx")';
        echo '</script>';
  
 }
 
?>