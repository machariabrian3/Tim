<?php
include ('config.php');
session_start();
$msg = '';
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $db->real_escape_string(htmlspecialchars($_POST["username"]));
    $passcode = $db->real_escape_string(htmlspecialchars($_POST["passcode"]));

    $sql= "SELECT userID FROM login WHERE username='$username' and password='$passcode'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1){
        $msg = '<div class="alert alert-success">Login successful</div>';
    }else{
        $msg ='<div class="alert alert-danger">Login failed terribly</div>';
    }
}
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">

  <head>

    <meta charset "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
     shrink-to-fit=no, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <link rel="stylesheet" href="styler.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

  </head>

  <body>
    <!--Intro BEGINS-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-5 mainPadding v-center">
          <img src="tj3logo.png" class="image-fluid" height="200px" alt="elevete logo">
          <h2 style="color: white;">TJ3 Services</h2>
          <a href="Info.php"><button type="button" class="New btn btn-light" href="#">CreateNew Account</button></a>
        </div>
        <!--/Intro-->

        <!-- vertical line-->
        <div class="col-xs-2 v-line"></div>

        <!--login dialogue BEGINS-->
        <div class="col-xs-5 mainPadding v-center">
          <div class="card bg-secondary text-white">
            <div class="card-title text-center">
              <img class="image-responsive center" src="user-unisex-512.png" alt="Card image">
              <h3>Sign In</h3>

                <?php
                    echo $msg;
                ?>
            </div>

            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group ">
                        <div class="col-sm-12">
                            <input name="username" type="username" class="form-control" id="userName" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input name="passcode" type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox">  Remember me
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="LogIn">
                    </div>

                </form>
              </div>
            </div>
          </div>
          <!--End of Card-->
        </div>
      </div>
    </div>
    <!--END of login dialogue-->

    <!--FOOTER Begins-->
    <footer class="page-footer font-small indigo pt-0">
      <div class="footerColor">

        <!--Footer Links-->
        <div class="container">
          <!--Grid row-->
          <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">

            <!--Grid column-->
            <div class="col-md-8 col-12 mt-5">
              <hr class="rgba-white-light" style="margin: 0 15%; border-color:red">
              <p style="line-height: 1.7rem" class="Info">TJ3 Limited <br/>
                  51 Hardwick Road,Tilechurst - Reading, RG30 41J<br />
                  Tel:0118 942 4518 , Fax: 0118 942 4518<br />
                  Web: <a class="link" href="http://tj3services.com/"> www.tj3services.com</a><br />
                  Email: info@tj3services.com</p>
            </div>
            <!--/Grid column-->
          </div>
          <!--/Grid row-->

          <!--/Footer Links-->

          <!--Copyright-->
          <div class="footer-copyright py-3 text-center">
            © 2018 Copyright
            <a href="#" class="link"> TJ3 Services </a>
          </div>
        </div>
        <!--/Copyright-->
      </div>
    </footer>
    <!--End of FOOTER-->

  </body>

</html>
