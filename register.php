<?php
$name=$_POST['name'];
$email=$_POST['email'];
$user=$_POST['username'];
$phone=$_POST['phone'];
$pass=$_POST['password'];

   
       $link = new mysqli("localhost","root","","houndsunited");

if ($link -> connect_errno) {
  echo "Failed to connect to MySQL: " . $link -> connect_error;
  exit();
}
	$query="SELECT * FROM signup WHERE id='$user'";	
        $result=mysqli_query($link,$query);	
        $row=mysqli_num_rows($result);        
	if($row==0)
	{
		$query1="INSERT INTO signup values ('$name','$email','$user','$pass','$phone')";		
                mysqli_query($link,$query1);		
	}
	else
	{
		echo "<script>
            alert('User already exist');
            window.location.href='index.php';
            </script>";			
	}

echo "<script>
            alert('Please login to continue.');
            window.location.href='index.php';
            </script>";
?>