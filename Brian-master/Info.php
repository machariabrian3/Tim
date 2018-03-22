<?php
session_start();
include ('config.php');
$msg = '';
$errors = array();
if (isset($_POST['submit_reg'])){
    if ($_POST['passcode'] === $_POST['confirmpasscode']){

        $firstname = $db->real_escape_string(htmlspecialchars($_POST["firstname"]));
        $lastname = $db->real_escape_string(htmlspecialchars($_POST["lastname"]));
        $middlename = $db->real_escape_string(htmlspecialchars($_POST["middlename"]));
        $phonenumber = $db->real_escape_string(htmlspecialchars($_POST["phonenumber"]));
        $email = $db->real_escape_string(htmlspecialchars($_POST['email']));
        $username = $db->real_escape_string(htmlspecialchars($_POST["username"]));
        $passcode = $db->real_escape_string(htmlspecialchars($_POST["passcode"]));
        $confirmpasscode = $db->real_escape_string(htmlspecialchars($_POST["confirmpasscode"]));
        $passcode = md5($passcode);

        $email_query = "SELECT email FROM users WHERE email='$email'";
        $email_result = $db->query($email_query);
        if ($email_result->num_rows > 0){
            $msg = '<div class="alert alert-danger">Email already exists</div>';
        }else{
            if (count($errors)==0){
                $query = "INSERT INTO `users`(`username`, `password`, `firstname`, `lastname`, `middlename`, `phonenumber`, `email`) VALUES ('$username','$passcode','$firstname','$lastname','$middlename','$phonenumber','$email')";
                $run = $db->query($query);
                if ($run){
                    $msg = '<div class="alert alert-success">successful registration</div>';
                }else{
                    $msg = '<div class="alert alert-danger">Unsuccessful registration</div>';
                }
            }
        }
    }else{
        $msg = '<div class="alert alert-danger">Passwords do not match</div>';
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="minutiae.css">

  </head>

  <body>
      <div class="card bg-secondary text-black">
        <div class="col-md-11 elements">
          <div class="card-title">
            <img class="image-responsive center" src="tj3logo.png" alt="Card image">
            <form action="" method="post" id="fileForm" role="form">
              <fieldset><legend class="text-center">Valid information is required to register.<br />(<span class="req">
              <strong>required *</strong></span> )</legend>
                  <div class="alert">
                      <?php
                        echo $msg;
                      ?>
                  </div>

          </div>

            <div class="form-group">
              <label for="firstname"><span class="req">* </span> First name: </label>
              <input class="form-control" type="text" name="firstname" id = "txt" onkeyup = "Validate(this)" required />
              <div id="errFirst">
              </div>

              <div class="form-group">
                <label for="lastname"><span class="req">* </span> Last name: </label>
                <input class="form-control" type="text" name="lastname" id = "txt"
                  onkeyup = "Validate(this)" placeholder="" required />
                <div id="errLast">
                </div>
              </div>

              <div class="form-group">
                <label for="middlename"><span class="req">* </span> Middle name: </label>
                <input class="form-control" type="text" name="middlename" id = "txt"
                  onkeyup = "Validate(this)" placeholder="hyphen or single quote OK"/>
                <div id="errLast">
                </div>
              </div>

              </div><div class="form-group">
                <label for="phonenumber"><span class="req">* </span> Phone Number: </label>
                <input required type="text" name="phonenumber" id="phone" class="form-control phone"
                  maxlength="18" onkeyup="validatephone(this);" placeholder="not used for marketing"/>
              </div>

              <div class="form-group">
                <label for="email"><span class="req">* </span> Email Address: </label>
                <input class="form-control" required type="text" name="email" id = "email"  onchange="email_validate(this.value);" />
                <div class="status" id="status">
                </div>
              </div>

              <div class="form-group">
                <label for="username"><span class="req">* </span> User name:  <small>This will be your login user name</small> </label>
                <input class="form-control" type="text" name="username" id = "txt" onkeyup = "Validate(this)" placeholder="minimum 6 letters" required />
                <div id="errLast">
                </div>
              </div>

              <div class="form-group">
                <label for="password"><span class="req">* </span> Password: </label>
                <input required name="passcode" type="password" class="form-control inputpass" minlength="4" maxlength="16"  id="pass1" /> </p>

                <label for="password"><span class="req">* </span> Password Confirm: </label>
                <input required name="confirmpasscode" type="password" class="form-control inputpass"
                  minlength="4" maxlength="16" placeholder="Enter again to validate"  id="pass2" onkeyup="checkPass(); return false;"/>
                <span id="confirmMessage" class="confirmMessage"></span>
              </div>

              <div class="form-group">

                <?php //$date_entered = date('d/m/Y H:i:s'); ?>
                <input type="hidden" value="<?php //echo $date_entered; ?>" name="dateregistered">
                <input type="hidden" value="0" name="activate" />
                <hr />

                <input type="checkbox" required name="terms" onchange="this.setCustomValidity(validity.valueMissing ?
                  'Please indicate that you accept the Terms and Conditions' : '');" id="field_terms">  
                <label for="terms">I agree with the <a href="terms.php" title="You may read our terms and conditions by clicking on this link">
                  terms and conditions</a> for Registration.</label>
                <span class="req">* </span>
              </div>

              <div class="form-group">
                <input class="btn btn-success" type="submit" name="submit_reg" value="Register">
              </div>
              <h5>You will receive an email to complete the registration and validation process. </h5>
              <h5>Be sure to check your spam folders. </h5>

            </fieldset>
          </form>
          <!--/Register form -->
        </div>

      </div>
      <!--/Card Element-->
    </div>
    <!--/Background Cover-->
  </body>

</html>
