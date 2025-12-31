<?php
  $con=mysqli_connect("localhost","root","" ,"law");
  $sno=$_GET["rno"];
  $q="delete from data where seno=$sno";
  if ($con->query($q) === TRUE) 
  {
    if($q != NULL)
    {
      echo "<script>alert('Deleted!'); window.location.href = 'main.php';</script>";
      exit();
    }
  }  
  else 
  {
    mysqli_query($con,$q);
    echo "<script>alert('Delete FAILED, Please try again! Go through README.txt in the app's files'); window.location.href = 'main.php';</script>";
    exit();
  }
?>