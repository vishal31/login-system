<?php require 'include/header.inc.php';
//include/signup.inc.php

if (isset($_POST['submit'])) {

  require 'include/dbconnstart.inc.php';

  if (!$conn) {
         die(mysqli_connect_error());
      }
        else {
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
          //header("Location: index.php");
          //exit();
    }
    else {
           //check length
           if (strlen($fname) > 30) {

               $fname_len = "Enter less than 30 characters";
              //  header("Location: index.php?signup=fname");
                //exit();

              $lname; $email; $phone_num;
              }

               if(strlen($lname) > 30) {
                   $fname_len;
                  //  header("Location: index.php?signup=fname");
                    //exit();
                      $fname; $email; $phone_num;
                   }

         if(strlen($phone_num) > 10 || strlen($phone_num) < 10) {
              $phone_num_len = "Enter 10 digits";
               //header("Location: index.php?signup=phone_num");
                //exit();
            $fname;  $lname; $email;
          }

          if(strlen($new_pswrd) < 8) {
               $pswrd_small = "Password is too small, enter atleast more than 8 characters";

         }

           elseif($new_pswrd != $conf_pswrd) {
                $pswrd_match = "Password does'nt matched";

          }

            else {

                  $md5_paswrd = md5($conf_pswrd);
                  $sql = "INSERT INTO user_info VALUES(NULL,'$fname','$lname','$email','$phone_num','$md5_paswrd')";
                  $result = mysqli_query($conn, $sql);
                  $query_error = mysqli_error($conn);
                  //$row_check = mysqli_num_rows($result);
                  if ( !$result) {
                           if (strpos($query_error,$phone_num)) {
                                $success = 'USER EXIST WITH THIS MOBILE NUMBER';
                           }
                  }
                   else {
                          $success = "Success";
                       }

            }

    }

  }

}



 ?>



<div class="container <?php if (isset($_SESSION['user_id'])) { echo 'hide';} else { echo 'show';} ?>">

  <h3 class="center <?php if (isset($all_field)) { echo 'red-text';} elseif (isset($success)) { echo 'green-text';} else {echo "Black";}  ?>"><?php if (isset($all_field)) { echo $all_field;} elseif (isset($success)) { echo $success;} else {echo "Sign Up";} ?> </h3>

        <form action="index.php" method="post">

              <div class="input-field">
                   <input type="text" name="fname" id="fname" value="<?php  if (!isset($fname_len)) { if (isset($fname)) { echo  $fname; } }  ?>">
                   <label for="fname" class="<?php if (isset($fname_len)) { echo 'red-text';} else {echo "black-text";} ?>" ><?php if (isset($fname_len)) { echo $fname_len;} else {echo "First name";} ?></label>
              </div>

              <div class="input-field">
                   <input type="text" name="lname" id="lname" value="<?php  if (!isset($lname_len)) { if (isset($fname)) { echo  $lname; } }  ?>">
                   <label for="lname" class="<?php if (isset($lname_len)) { echo 'red-text';} else {echo "black-text";} ?>" ><?php if (isset($lname_len)) { echo $fname_len;} else {echo "Last name";} ?></label>
              </div>

              <div class="input-field">
                   <input type="email" name="email" id="email" value="<?php  if (isset($email)) { echo  $email; }  ?>">
                   <label for="email"> E-mail </label>
              </div>

              <div class="input-field">
                   <input type="number" name="phone_num" id="phone_num" value="<?php  if (!isset($phone_num_len)) { if (isset($phone_num)) { echo  $phone_num; } }  ?>">
                   <label for="phone_num" class="<?php if (isset($phone_num_len)) { echo 'red-text';} else {echo "black-text";} ?>"><?php if (isset($phone_num_len)) { echo $phone_num_len;} else {echo " Phone Number";} ?></label>
              </div>

              <div class="input-field">
                   <input type="password" name="new_pswrd" id="new_pswrd">
                   <label for="new_pswrd" class="<?php if (isset($pswrd_small)) { echo 'red-text';} else {echo "black-text";} ?>" ><?php if (isset($pswrd_small)) { echo $pswrd_small;} else {echo "New Password";} ?></label>
              </div>

              <div class="input-field">
                   <input type="password" name="conf_pswrd" id="conf_pswrd">
                   <label for="conf_pswrd" class="<?php if (isset($pswrd_match)) { echo 'red-text';} else {echo "black-text";} ?>" ><?php if (isset($pswrd_match)) { echo $pswrd_match;} else {echo "Confirm Password";} ?></label>
              </div>

              <div class="input-field center">
                   <button type="submit" name="submit" class="btn dark btn-large waves-effect"> Sign Up </button>
              </div>
        </form>

</div>








<?php require 'include/footer.inc.php' ?>
