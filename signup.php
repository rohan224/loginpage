<?php
$showAlert= false;
$showError= false;
if($_SERVER["REQUEST_METHOD"]== "POST"){

  include 'partials/_dbconnect.php';
  $firstname =$_POST["firstname"];
  $lastname =$_POST["lastname"];
  $email =$_POST["email"];
  $password =$_POST["password"];
  $cpassword =$_POST["cpassword"];

  if(($password == $cpassword)){
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql= "INSERT INTO `user_record` (`first_name`, `last_name`, `email`, `password`)
           VALUES ( '$firstname', '$lastname', '$email', '$hash')";
           $result= mysqli_query($conn, $sql);
           if ($result){
             $showAlert = true;
           }
  } 
  else{
    $showError = "Password do not match.";
  }
  
  
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Sign up for iSecure | iSecure</title>
    <style>
     .btn-primary{
         margin: 6px 230px;
     }
    </style>
  </head>
  <body>
  <?php require 'partials/_nav.php' ?>

  <?php
  if($showAlert){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is created and  now you can login into it.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  ?>

  <?php
  if($showError){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong> Error!</strong> '.$showError.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  ?>
       
        <div class="container">
        <h2 > Sign Up for iSecure</h2>
        
        <form action = "/loginsystem/signup.php" method ="post">

                <div class="form-group col-md-6 my-4">
                  <label for="firstname">First Name</label>
                  <input type="text" class="form-control" id="firstlast" name= "firstname">  
                </div>

                <div class="form-group col-md-6">
                  <label for="lastname">Last Name</label>
                  <input type="text" class="form-control" id="lastname" name= "lastname" >
                </div>

                <div class="form-group col-md-6">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email">
                  <small id="email" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>

                <div class="form-group col-md-6">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group col-md-6">
                  <label for="cpassword">Confirm Password</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword">
                </div>
                
                </div>
                <button type="submit" class=" btn-primary">Sign Up</button>
         </form>


        </div>


    
  </body>
</html>