<?php


$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$companyname=$_POST['companyname'];
$companytype=$_POST['companytype'];
$address=$_POST['address'];
$password=$_POST['password1'];
$password2 = $_POST['password2'];


if($password!=$password2) {
  //throw error
  echo "<script>window.location='index.php?passwordmismatch=1';</script>";
  //header("Location:index.php?passwordmismatch=1");
  die();
} else if ($gender==-1) {
  echo "<script>window.location='index.php?genderEmpty=1';</script>";
  //header("Location:index.php?genderEmpty=1");
} else {

    //connecting to database
    require('../connect.php');

    //checking if email already exists
    $sql0 = "SELECT count(`emp_id`) AS numEmployees FROM `employers` WHERE `email`='$email' LIMIT 1";
    $result=$conn->query($sql0);
    $row=mysqli_fetch_assoc($result);

      if($row['numEmployees']>0) {
        echo "<script>window.location='index.php?emailexists=1';</script>";
        //header("Location:index.php?emailexists=1");
        die();
      } 
      
      else {
          //if email doesn't already exist, register the guy

          //hashing the password
          $password=hash('sha256', $password);

          $sql = "INSERT INTO `employers` (firstname, lastname, age, gender, email, companyname, companytype, address, password)
          VALUES ('$firstname', '$lastname', $age, $gender, '$email', '$companyname','$companytype','$address','$password')";
          
          if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
              $sql="SELECT `emp_id` FROM `employers` WHERE `email`='$email' AND `firstname`='$firstname' AND `lastname`='$lastname'";
              $result=$conn->query($sql);

              if(mysqli_num_rows($result)==1) {
                  $row=mysqli_fetch_assoc($result);
                  $userid=$row['emp_id'];
                  session_start();
                  $_SESSION['user']=$userid;
                  $_SESSION['type']='employer';
              }
              
              echo "<script>window.location='./panel/index.php?success=true';</script>";
              //header("Location:./panel/index.php?success=true");
              die();
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }
    
    $conn->close();
}
?>