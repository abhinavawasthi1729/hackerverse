
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
              <input type="submit" value="Sign Up" name="submit">
        </form>
      </div>
    </div>
  </div>
 
     <?php
       /*$con = mysqli_connect("localhost","root","");
        $db=mysqli_select_db($con,"hackerverse");
        $id;
        if ($con) {
            echo "connection successful";
        }
        else{
          die('Could not connect: '.mysqli_errno());
        }
            if(isset($_POST["submit"]))
            {
                                
                $institution=$_POST['colname'];
                $teamName=$_POST['team'];
                $name1=$_POST['mem1'];
                $email_id=$_POST['email'];
                $number1=$_POST['phone1'];
                $number2=$_POST['phone2'];
                $name2=$_POST['mem2'];
                
                
                $name3=$_POST['mem3'];
              
                $name4=$_POST['mem4'];
               
                $name5=$_POST['mem5'];
                
                $query=mysqli_query($con,"Insert into `hackerverse`.`signup` ( `collgeName`, `teamName`, `teamMember1`, `Email`, `Phone1`, `Phone2`, `teamMember2`, `teamMember3`, `teamMember4`, `teamMember5`) values('$institution','$teamName','$name1','$email_id','$number1','$number2','$name2','$name3','$name4','$name5')");
             
                if($query)
                {
					echo "<script type = 'text/javascript'>alert('Registration Successful')</script>";
					//echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
             }
             else
             {
				echo "<script type = 'text/javascript'>alert('Registration Not Successful!! Please try again!')</script>";
				//echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
                 echo "error: $query <br> $con->error";  
             }
            }*/

        ?>

<?php
    session_start();
    //connect to DB
    $db=mysqli_connect('localhost','root','','hackerverse') ;
    if (!$db) {
      die('Could not connect: '.mysqli_errno());
      }
     
      if(isset($_POST['submit']))
      {
          //registration
          $par1="";
          $par2="";
          $par3="";
          $par4="";
          $par5="";

          $team="";
          $phone1="";
          $phone2="";
          $colname="";
          $email="";
          $password1="";
          $password2="";

          $par1=mysqli_real_escape_string($db,$_POST['mem1']);
          $par2=mysqli_real_escape_string($db,$_POST['mem2']);
          $par3=mysqli_real_escape_string($db,$_POST['mem3']);
          $par4=mysqli_real_escape_string($db,$_POST['mem4']);
          $par5=mysqli_real_escape_string($db,$_POST['mem5']);

          $team=mysqli_real_escape_string($db,$_POST['team']);
          $phone1=mysqli_real_escape_string($db,$_POST['phone1']);
          $phone2=mysqli_real_escape_string($db,$_POST['phone2']);
          $colname=mysqli_real_escape_string($db,$_POST['colname']);
          $email=mysqli_real_escape_string($db,$_POST['email']);
          $password1=mysqli_real_escape_string($db,$_POST['password1']);
          $password2=mysqli_real_escape_string($db,$_POST['password2']);


          //form validation
          $errors=array();

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
          if(empty($password1)){
              array_push($errors,"Password is required");
          }
          
          if($password1!=$password2){
              array_push($errors,"Password do not match");
              //echo "<script type='text/javascript'> alert('Password do not match') </script>";
              
          }
        
          //check if teamName or email already exist

          $team_check_query="select * from `hackerverse`.`signup` where collegeName='$colname' or Email='$email'";
          $result=mysqli_query($db,$team_check_query);
         
              $user=mysqli_fetch_assoc($result);

              if($user){
                  if($user['teamName']===$team){
                      array_push($errors,"Team name already exist");
                      //echo "<script type='text/javascript'> alert('Team name already exist') </script>";
                    }

                  if($user['Email']===$email){
                      array_push($errors,"Email already exist");
                      //echo "<script type='text/javascript'> alert('Email already exist') </script>";
                      
                  }
              }
             
          //register user if no error

          if(count($errors)==0){
              $password=md5($password1);
              $query="INSERT INTO `hackerverse`.`signup`(`collegeName`, `teamName`, `teamMember1`, `Email`, `Phone1`, `Phone2`, `teamMember2`, `teamMember3`, `teamMember4`, `teamMember5`) VALUES ('$colname','$team','$par1','$email','$phone1','$phone2','$par2','$par3','$par4','$par5')";
              $result=mysqli_query($db,$query);
              if($result)
              {
                echo "<script type = 'text/javascript'>alert('Registration Successful')</script>";
            }
            else
              {
                echo "<script type = 'text/javascript'>alert('Registration Not Successful!! Please try again!')</script>";
                echo "error: $query <br> $db->error";  
              }
              
              $team_check_query="select * from `hackerverse`.`signup` where Email='$email'";
               $result=mysqli_query($db,$team_check_query);
         
              

              if($result){
                  $user=mysqli_fetch_assoc($result);
                  $sno= $user['Sno'];
                 // echo $sno;
              }
              
              $password1=md5($password1);
              $query="INSERT INTO `credentials`( `Sno`,`email`, `password`) VALUES ('$sno','$email','$password1')";
              $result=mysqli_query($db,$query);
              if(!$result){
                echo "credentials not inserted $db->error";
              }
              
              $_SESSION['username']=$team;
              $_SESSION['success']="You are logged in";
              //header("location:index.php");
          }
          else{
                  echo "<strong> &nbsp;&nbsp;&nbsp;&nbsp; Errors : </strong> <br>";
                  
                  foreach ($errors as $error){
                  
                      echo "<ul> <li>$error </li> </ul>";
                   
                  }
                  
              }
        }  
        
        
    
    
    
    

?>

</body>

</html>
