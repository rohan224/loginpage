<?php
$login= false;
$showError= false;
if($_SERVER["REQUEST_METHOD"]== "POST"){
  include 'partials/_dbconnect.php';
  $email =$_POST["email"];
  $password =$_POST["password"];

  $sql = "select * from user_record where email ='$email'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1){
    while($row = mysqli_fetch_assoc($result)){
      if (password_verify($password, $row['password'])){
        $login = true;
        header("location: welcome.php");
      }
      else{
        $showError = "Invalid!!";
      }

    }
  }
  else{
    $showError = "Invalid!!";
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

    <title>Login for iSecure | iSecure</title>
    <style>
     .btn-primary{
         margin: 6px 230px;
     }
    </style>
  </head>
  <body>
  <?php require 'partials/_nav.php' ?>

  <?php
  if($login){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are logged in.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  ?>
  <?php
  if($showError){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong> Error </strong> '.$showError.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  ?>


       
        <div class="container">
        <h2 > Login for iSecure</h2>
        
        <form action = "/loginsystem/login.php" method ="post">

                
                <div class="form-group col-md-6">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email">
                  <small id="email" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>

                <div class="form-group col-md-6">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>

                
                </div>
                <button type="submit" class=" btn-primary">login</button>
         </form>


        </div>


    
  </body>
</html>