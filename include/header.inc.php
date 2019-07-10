<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <link rel="stylesheet" href="materialize/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>


<?php

if (isset($_POST['login_submit'])) {

  require 'include/dbconnstart.inc.php';

    $phone_email = $_POST['username'];
    $password = md5($_POST['pswrd']);

  if (empty($phone_email) || empty($password) )
     {
        $all_field = "IT is empty";
        //header("Location: index.php");
        //exit();
  }
    else {

          $sql = "SELECT * FROM user_info WHERE  email = '$phone_email' OR phone_num = '$phone_email'; ";
          $result = mysqli_query($conn,$sql);

          if (mysqli_num_rows($result) < 1 ) {
              echo "<h1>There is no such user exits</h1>";

          }
          else {
                 $col_array = mysqli_fetch_assoc($result);
                     $dbpaswrd = $col_array['user_paswrd'];

                   if ($password != $dbpaswrd) {
                        echo "Your Password does'nt matched";
                   }
                     elseif ($password === $dbpaswrd){

                            $_SESSION['user_id'] = $col_array['user_id'];
                            $_SESSION['email'] = $col_array['email'];

                     }

                }
    }



}

if (isset($_POST['logout_submit'])) {

      unset($_SESSION['user_id']);
      session_destroy();
}




 ?>


  <body>

      <nav class="black">
           <div class="nav-wrapper">
                 <a href="#" class="brand-logo center"> Login System </a>
                 <a href="#sidenav" class="sidenav-trigger <?php   if (isset($_SESSION['user_id'])) { echo 'show' ; } else {echo 'hide'; } ?>"> open </a>
                <ul class="right hide-on-med-and-down">
                     <li>

                       <form action="index.php" method="post" class="row <?php  if (isset($_SESSION['user_id'])) { echo 'show';} else { echo 'hide';}  ?>" >

                              <div class="input-field col l4">
                                    <button type="submit" name="logout_submit" class="btn waves-effect"> Logout </button>
                              </div>
                       </form>


                         <form action="index.php" method="post" class="row <?php  if (isset($_SESSION['user_id'])) { echo 'hide';} else { echo 'show';}  ?>" >

                                <div class="input-field col l4">
                                      <input type="text" name="username" id="username" style="border-bottom:1px solid white;color:white">
                                      <label for="username"> username or email </label>
                                </div>

                                <div class="input-field col l4">
                                      <input type="password" name="pswrd" id="pswrd" style="border-bottom:1px solid white;color:white">
                                      <label for="pswrd" class=""> Password </label>
                                </div>

                                <div class="input-field col l4">
                                       <button type="submit" name="login_submit" class="btn waves-effect"> Login </button>
                                </div>
                         </form>
                     </li>
                </ul>
           </div>
      </nav>

      <?php

            if (isset($_SESSION['user_id'])) {

                     if (isset($result)) {
                $col_array = mysqli_fetch_assoc($result);

                 $user_fname = $col_array['fname'];
                 $user_lname = $col_array['lname'];
                 $user_email = $col_array['email'];
              }
     }

         ?>

      <ul class="sidenav" id="sidenav">
          <li>
              <div class="user-view">
                    <div class="background">
                          <img src="download.jpeg" alt="">
                    </div>
                    <img src="poly5.jpg" alt="" class="responsive-img circle">
                    <span><?php echo $user_email ; ?></span>
              </div>
          </li>

          <li> Vishal Singh </li>
          <li class="divider">

      </ul>
