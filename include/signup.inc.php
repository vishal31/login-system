<?php

echo "string";
if (isset($_POST['submit'])) {

require 'dbconnstart.inc.php';

     $fname = mysqli_real_escape_string($conn,$_POST['fname']);
     $lname = mysqli_real_escape_string($conn,$_POST['lname']);
     $email = mysqli_real_escape_string($conn,$_POST['email']);
     $phone_num = mysqli_real_escape_string($conn,$_POST['phone_num']);
     $new_pswrd = mysqli_real_escape_string($conn,$_POST['new_pswrd']);
     $conf_pswrd = mysqli_real_escape_string($conn,$_POST['conf_pswrd']);

    // Check for Empty
    if (empty($fname) || empty($lname) || empty($email) || empty($phone_num) || empty($new_pswrd) || empty($conf_pswrd) )
       {
          $all_field = "Fill all the field";
          header("Location: ../index.php");
          exit();
    }
    else {
           //check length
           if (strlen($fname) > 30 || strlen($lname) > 30) {
                $fname_len = "Enter less than 30 character";
                header("Location: ../index.php");
                exit();
           }

         if(strlen($phone_num) > 10 || strlen($phone_num) < 10) {
                echo $phone_num_len = "Enter 10 digits";
                header("Location: ../index.php");
                exit();
          }

          if(strlen($new_pswrd) < 8) {
               $pswrd_small = "Password is too small, enter atleast more than 8 characters";
               header("Location: ../index.php");
               exit();
         }

           if($new_pswrd === $conf_pswrd) {
                $pswrd_match = "Password does'nt matched";
                header("Location: ../index.php");
                exit();
          }

            else {
              echo $success = "success";
            }

    }

}
        
