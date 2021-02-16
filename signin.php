<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Sign in - HackerVerse</title>
  <link rel="stylesheet" href="signin.css">
</head>

<body>
  <div class="wrapper">
    <div id="formContent">
      <!-- Tabs Titles -->
      <h2 class="active"> Sign In </h2>
      <h2 class="inactive underlineHover"><a href="signup.html">Sign Up</a></h2>

      <!-- Login Form -->
      <form action="signin.php" method="POST">
        <input type="email" id="login" name="email" placeholder="email" required>
        <input type="password" id="password" name="password" placeholder="password" required>
        <input type="submit" value="Log In" name="login">
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div>

    </div>
  </div>

  <?php
      session_start();
      $db=mysqli_connect('localhost','root','','hackerverse') or die('can not connected to DB');

      $email="";
      $password="";
      if(isset($_POST['login'])){
            $email=mysqli_real_escape_string($db,$_POST['email']);
            $password=mysqli_real_escape_string($db,$_POST['password']);

            $errors=array();
            if(empty($email)){
              array_push($errors,"Email is required");

            }
            if(empty($password)){
              array_push($errors, "Password is required");
            }

              if(count($errors)==0){
                    $password=md5($password);
                    $query="SELECT * FROM `credentials` WHERE email='$email' AND password='$password'";
                    $result=mysqli_query($db,$query);
                   /* if(!$result){
                      echo "can not insert into credentials $query <br> $db->error";
                    }
                    else{
                      echo "logged in successfully";
                    }*/
                    


                    if(mysqli_num_rows($result)){
                      $_SESSION['email']=$email;
                      $_SESSION['success']="you are successfully logged in";

                      $query="SELECT * FROM `user_details` WHERE email='$email'";
                      $result=mysqli_query($db,$query);
                      if($result){
                        $input=mysqli_fetch_assoc($result);
                        if(isset($input)){
                          $_SESSION['username']=$input['teamName'];
                          echo $_SESSION['username'];
                        }
                      }

                      header("location:index.php");
                   }
                   else{
                          array_push($errors,"incorrect email or password");
                          echo "&nbsp;&nbsp;&nbsp;&nbsp;<strong> Errors : </stong>";
                          foreach($errors as $error){
                              
                          echo "<ul><li> $error</li></ul>";
                    }
              
               }
               
                }

      }
      
      

  ?>


</body>

</html>