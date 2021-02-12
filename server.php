<?php
    session_start();
    //connect to DB
    $db=mysqli_connect('localhost','root','','hackerverse') ;

    if(!$db){
      die("can not connect to db".mysqli_errno());
    }

    //registration

     if(isset($_POST["submit"])){
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
              $password=md5($password1);
              $query="INSERT INTO `hackerverse`.`signup`(`collgeName`, `teamName`, `teamMember1`, `Email`, `Phone1`, `Phone2`, `teamMember2`, `teamMember3`, `teamMember4`, `teamMember5`) VALUES ('$colname','$team','$par1','$email','$phone1','$phone2','$par2','$par3','$par4','$par5')";
              mysqli_query($db,$query);

              if($query){
                echo "<script type='text/javascript'> alert('Registration successful')</script>";
              }
              else{
                echo "error: $query <br> $db->error";
              }
                

              $_SESSION['username']=$username;
              $_SESSION['success']="You are logged in";
              header("location:index.php");
          }
    
        } 
    
    
    

?>