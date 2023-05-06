<?php

include('connection.php');

 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){



        $email = mysqli_real_escape_string($link,$_POST["email"]);
   

   
        $password = mysqli_real_escape_string($link,$_POST["password"]);
   
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){

        // Prepare a select statement
       
         $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";  
        $result = mysqli_query($link, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  


      if($count == 1){  

                                 
                                  header("location: main.php");

                                }


                                else{  

                                  echo '<script> alert("Check your email or password"); </script>';
            
        }    

        
     
}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>


	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">

</head>
<body>

	<div class="login">
	

        <h2>Login for StartUp Expo</h2>
        <p>Please fill in your credentials to login.</p>
        <form method="post">

        	<table>

        		   	<tr>

        		<td>           <label>Email</label> </td>
        		<td>        <input type="text" name="email" required> </td>

        	</tr>
               

               <tr>
               <td> <label>Password</label> </td>

               <td>  <input type="password" name="password"required>


                <tr>
  <td colspan="2" style="padding-left: 80px;"><input type="submit"  name="submit" value="Login"> </td>
  
</tr>
                
			
			<tr>

				<td>		<label>New Member? </label> </td>
				<td><a href="register.php">Click Here for Registration </a></td>

		</tr>


       		



        	</table>

     
        </form>
		 

</body>

</html>