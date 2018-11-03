<html>
<head>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="style1.css">
<title>Cencel ticket</title>
</head>
<body bgcolor="#CCCCCC">
<ul>
<li><a href="Cancel.php">Cancel Ticket</a></li>
 <li><a href="final.php">Confirm Ticket</a></li>
 <li><a href="logout.php">Log Out</a></li>
</ul>
<form action="" method="post">
<label>Email</label><br>
<input type="email" name="email"/><br>
<lable>Seat No</label><br>
<input type="text" name="seat"/><br>
<lable>Bus No:</label><br>
<input type="text" name="busno"/><br>
<label>Date</label><br>
<input type="date" name="date"/><br>
<input type="submit" value="Cancle"/><br>
</form>

</body>
</html>
<?php
   include("Config.php");
  // session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      
      $Date1 = mysqli_real_escape_string($db,$_POST['date']);
      $seat1 = mysqli_real_escape_string($db,$_POST['seat']);
	  $Email1 = mysqli_real_escape_string($db,$_POST['email']);
	   $B = mysqli_real_escape_string($db,$_POST['busno']);
	   
	  
	   
	   $sql="SELECT * FROM tricket WHERE Email='$Email1' and Date='$Date1' and seat='$seat1'and BusNo='$B'";
	  $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
     
      $count = mysqli_num_rows($result);
	
      if($count == 1) 
	    {
	  $sql="DELETE  FROM tricket WHERE Email='$Email1' and Date='$Date1' and seat='$seat1'and BusNo='$B'";
	  if ($db->query($sql) === TRUE) 
	     {
    $sql="SELECT * FROM  businfo WHERE BusNo='$B' and Date='$Date1'";
	   $result=$db->query($sql);
	 while($row = mysqli_fetch_array($result))
      {
     $avile=$row["Avile"];
	 $m=$avile+1;
	 $sql="UPDATE businfo SET Avile='$m' WHERE Busno='$B' and Date='$Date1'";
	  if ($db->query($sql) === TRUE) 
	        {
	        echo "Cancel ticket succesfully ,Plz contruct With Nearest Hanif counter to back Tk with hard copy of ticket";
            }
     }
         }
		 }
 else {
    echo "No record " ;
      }
	  
	  
	  }
	  ?>