
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
        $con = mysqli_connect("localhost","root","");
        $db=mysqli_select_db($con,"hackerverse");
        $id;
        if (!$con) {
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
					echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
             }
             else
             {
				//echo "<script type = 'text/javascript'>alert('Registration Not Successful!! Please try again!')</script>";
				//echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
                 echo "error: $query <br> $con->error";  
             }
            }

        ?>
</body>

</html>
