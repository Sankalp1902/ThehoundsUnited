<?php
  
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
       
        $x=$_POST['username'];
        $y=$_POST['password'];
  

   
       $link = new mysqli("localhost","root","","houndsunited");

if ($link -> connect_errno) {
  echo "Failed to connect to MySQL: " . $link -> connect_error;
  exit();
}
       
       
      $sql = "SELECT name FROM signup WHERE id = '$x' and password = '$y'";
      $result = mysqli_query($link,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);      
      $name = $row["name"];      
      $count = mysqli_num_rows($result);                
      // If result matched $myusername and $mypassword, table row must be 1 row
	 if($count==1) 
         {
            $_SESSION["nm"] = $name;
            $_SESSION["status"]="Active";
            $_SESSION["id"] = $x;
            header("location: index.php");
         }
      else if($count==0)
        {
          echo "<script>
            alert('Wrong Login id or password! Create new account or try again.');
            window.location.href='index.php';
            </script>";            
        }
        else
        {
          echo "<script>
            alert('Whats happenning!?!?!?');
            window.location.href='index.php';
            </script>";            
        }
        
        echo "Stop trying that shitty hack!";
   }
?>
