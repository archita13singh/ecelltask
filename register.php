<?php

// Include config file
include('connection.php');



// Define variables and initialize with empty values
$name = $password = $confirm_password =$sname= $contact=$email=$address=$gender= "";
$sname_err = $password_err = $confirm_password_err =$name_err=$contact_err=$email_err= "";
 
// Processing form data when form is submitted
	
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
   	 
            $gender = $_POST["gender"];
            
             $address = $_POST["address"];

            


       
    // Validate password
    if(empty(mysqli_real_escape_string($link,$_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(mysqli_real_escape_string($link,$_POST["password"])) < 8){
        $password_err = "Password must have atleast 8 characters.";
    } 
	
	 
	
	else{
        $password = mysqli_real_escape_string($link,$_POST["password"]);
		$password=filter_var($password,FILTER_SANITIZE_STRIPPED);
    }
    
    // Validate confirm password
    if(empty(mysqli_real_escape_string($link,$_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
		
    } else{
        $confirm_password = mysqli_real_escape_string($link,$_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	
	
	
	    // Validate name
    if(empty(mysqli_real_escape_string($link,$_POST["name"]))){
        $name_err = "Please enter name";
    }
	
	else if(preg_match('/[^a-z\s-]/i',$_POST['name']))
    {
        $name_err = "Enter only alphabets or letters";
    }
	

     else{
         $name = mysqli_real_escape_string($link,$_POST["name"]);
       }

           // Validate contact

	
	if(!preg_match('/^[0-9]{10}+$/',$_POST['contact']))
    {
        $contact_err = "Invalid Contact Number";
    }
	

     else{
         $contact = mysqli_real_escape_string($link,$_POST["contact"]);
       }
	

   
    
	


	    // Validate Start Up name
    if(empty(mysqli_real_escape_string($link,$_POST["sname"]))){
        $sname_err = "Please enter name";
    }
	
	else if(preg_match('/[^a-z\s-]/i',$_POST['sname']))
    {
        $sname_err = "Enter only alphabets or letters";
    }
	

     else{
         $sname = mysqli_real_escape_string($link,$_POST["sname"]);
       }

	
	    // Validate email

               if(empty(mysqli_real_escape_string($link,$_POST["email"]))){
        $email_err = "Please enter the email address";
            } 


             $email = mysqli_real_escape_string($link,$_POST["email"]);
             $email = filter_var($email, FILTER_SANITIZE_EMAIL);
             $email=filter_var($email,FILTER_SANITIZE_STRIPPED);

             // Check e-mail
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
             {
                         
               $email_err="Invalid Email:Enter a valid email address";
             }
                            

     
    else{
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE email = '$email'";

         $result = mysqli_query($link, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result); 
        
      
                
                if($count == 1){
                    $email_err = "This email address is already registered.";
                }
        } 
				
						
			
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($password_err) && empty($confirm_password_err) && empty($sname_err) && empty($address_err) && empty($email_err) && empty($contact_err)){

       // $password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        
// Prepare an insert statement
        $sql = "INSERT INTO users (name, gender, email, sname, address, contact, password) VALUES ('$name', '$gender','$email','$sname','$address','$contact','$password')";

      
       if (mysqli_query($link, $sql))
       {
         echo '<script> alert("User is registered successfully"); 
                        window.location.href="login.php";  </script>';
            } 
            else{
                '<script> alert("User is not registered"); 
                        window.location.href="register.php";  </script>';
            }
    
    
}
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>


	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">


</head>
<body>


<h1 style="color: #4B088A;text-align: center">Welcome to E-Summit'24 </h1>

<br>


<h2>Registration Form of Startup Expo</h2>




	<form method="post">
<table class="tcenter">
	
<tr>
	<td> <label>Name:</label>	</td>
	<td><input type="text" name="name" required> 
	 <span class="help-block"><?php echo $name_err; ?></span> </td>
</tr>


<tr>

	<td> <label>Gender:</label> </td>
	<td> 
		Male<input type="radio" name="gender" value="Male" required>  &emsp;
		Female	<input type="radio" name="gender"  value="Female" required>  &emsp;
		Transgender<input type="radio" name="gender"  value="Transgender" required> </td>

	
</tr>


<tr>
<td> <label>Email:</label> </td>
<td><input type="text" name="email" required> 

<span class="help-block"><?php echo $email_err; ?></span>  </td>

</tr>



<tr>
<td> <label>Name of StartUp</label> </td>

<td>	<input type="text" name="sname" required>  <span class="help-block" style="color: red" ><?php echo $sname_err; ?></span>	 </td>

</tr>


<tr>

	<td> <label>Address of StartUp</label> </td>
	<td><textarea rows="8" cols=24 name="address" required></textarea>
	 </td> 
</tr>


<tr>

	<td> <label>Contact No.</label> </td>

	<td>		<input type="text" name="contact" required>
	<span class="help-block"><?php echo $contact_err; ?></span> </td> 
</tr>



<tr>
<td> <label>Create Password:</label> </td>
<td>		<input type="password" name="password" required>
<span class="help-block"><?php echo $password_err; ?></span>   </td>

</tr>

<tr>
<td> <label>Confirm Password:</label> </td>
<td>		<input type="password" name="confirm_password" required> 
<span class="help-block"><?php echo $confirm_password_err; ?></span>  </td>

</tr>



<tr>
	<td style="padding-left: 52px;"><input type="submit"  name="submit" value="Register"> </td>
	<td style="padding-left: 52px;">  <input type="reset" value="Reset"></td>
</tr>

<tr>
	<td style="padding-left: 52px;">Already Have a Account?</td>
	<td style="padding-left: 52px;"><a href="login.php" >Login Here</td>
</tr>

</table>

		
 

	</form>

</body>
</html>