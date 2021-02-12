
<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Sign Up - HackerVerse</title>
  <link rel="stylesheet" href="signup.css">
</head>

<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <h2 class="inactive"> <a href="signin.html"> Sign In </a></h2>
      <h2 class="active underlineHover">Sign Up</h2>

      <!-- Login Form -->
      <div class="row">
        <form action="signup.php" method="POST">   
          <div class="column">
              <input type="text" id="mem1" name="mem1" placeholder="Member #1 Name" required>
              <input type="text" id="mem2" name="mem2" placeholder="Member #2 Name">
              <input type="text" id="mem3" name="mem3" placeholder="Member #3 Name">
              <input type="text" id="mem4" name="mem4" placeholder="Member #4 Name">
              <input type="text" id="mem5" name="mem5" placeholder="Member #5 Name">
              <input type="text" id="team" name="team" placeholder="Team Name" required>
             </div>
          <div class="column">
        
              <input type="tel" id="phone1" name="phone1" placeholder="Phone Number" required>
              <input type="tel" id="phone2" name="phone2" placeholder="Alternate Phone Number" >
              <input type="text" id="colname" name="colname" placeholder="College Name" required>
              <input type="email" id="email" name="email" placeholder="Email Address" required>
              <input type="password" id="password1" name="password1" placeholder="Password" required>
              <input type="password" id="password2" name="password2" placeholder="Confirm Password" required>
        
           </div>
              <input type="submit" value="Sign Up">
        </form>
      </div>
    </div>
  </div>
 
  <?php
    
    //connect to DB
    $db=mysqli_connect("localhost","root","","hackerverse") ;

    if(!$db){
      die("can not connect to db".mysqli_errno());
    }

    //registration

     if(isset($_POST["submit"])){
          $par1=$_POST['mem1'];
          $par2=$_POST['mem2'];
          $par3=$_POST['mem3'];
          $par4=$_POST['mem4'];
          $par5=$_POST['mem5'];
          
          

          $team=$_POST['team'];
          $phone1=  $_POST['phone1'];
          $phone2=$_POST['phone2'];
          $colname=$_POST['colname'];
          $email=$_POST['email'];
          $password1=$_POST['password1'];
          $password2=$_POST['password2'];


          //form validation
        /*  $errors=array();

          if(empty($par1)){
              array_push($errors,"Participant 1 is required");
          }
          if(empty($team)){
              array_push($errors,"Team name is required");
          }
          if(empty($phone1)){
              array_push($errors,"Phone number is required");
          }
          if(empty($colname)){
              array_push($errors,"College name is required");
          }
          if(empty($email)){
              array_push($errors,"Email is required");
          }
          if(empty($password)){
              array_push($errors,"Password is required");
          }
          
          if($password1!=$password2){
              array_push($errors,"Password do not match");
          }
          
          //check if teamName or email already exist

          $team_check_query="select * from `hackerverse`.`signup` where collgeName='$colname' or Email='$email';";
          $result=mysqli_query($db,$team_check_query);
          $user=mysqli_fetch_assoc($result);

          if($user){
              if($user['teamName']===$team){
                  array_push($errors,"Team name already exist");
                }

              if($user['Email']=$email){
                  array_push($errors,"Email already exist");
              }
          }

          //register user if no error

          if(count($errors)==0){
              $password=md5($password1);*/
              $query="INSERT INTO `hackerverse`.`signup`(`collgeName`, `teamName`, `teamMember1`, `Email`, `Phone1`, `Phone2`, `teamMember2`, `teamMember3`, `teamMember4`, `teamMember5`) VALUES ('$colname','$team','$par1','$email','$phone1','$phone2','$par2','$par3','$par4','$par5')";
              mysqli_query($db,$query);

              if($query){
                echo "<script type='text/javascript'> alert('Registration successful')</script>";
              }
              else{
                echo "error: $query <br> $db->error";
              }
                
          
    
        } 
    
    
    

?>
</body>

</html>
