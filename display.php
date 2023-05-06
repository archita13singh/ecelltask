<?php

include('connection.php');

    
  
?>


<!DOCTYPE html>
<html>
<head>
	<title>Registered Users</title>


	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">


<style type="text/css">
    
table
{
    border: 1px solid #EDEADE;
    width: 100%;
    border-collapse: collapse ;

}

th,td
{
    border: 1px solid #ccc;
    text-align: center;

}

</style>

</head>
<body>

<div class="container">

  <div class="heading-bg main">

<div class="first">
    <center><a href="index.php"><img src="logo/e-summit_logo.png" class="logo" > </a>  </center>
</div>


<div class="middle" >
    <center>Welcome to E-Summit'24  </center>

</div>

<div class="last" >
    <center><img src="logo/manit_white.png" class="logo1"> </center>

</div>

</div>

<br>

<a href="index.php"> <button class="button">Home </button> </a> </h3>


<br><br>

<h3>List of Registered Members </h3>


<?php

$sql="SELECT * FROM users";
$result=mysqli_query($link,$sql);



?>


<table>
    <tr>
        <th>S.No.</th>
        <th> Person Name</th>
        
    </tr>
    <?php

        $i=1;

        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
            {  
    ?>

    <tr>
        <td><?php echo $i ?>
        <td><?php echo ucwords($row['name']) ?> </td>
        
    </tr>

    <?php $i++; }?>
</table>




</div> <!--Container Close -->



 <!--footer -->
<div class="footer">


 <center> <img src="logo/e-cell_logo.png" height="40"> <br> <span> E CELL MANIT</span> </center>
  



    
</div>  
<!--footer -->


</body>
</html>