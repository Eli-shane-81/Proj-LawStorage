<?php
  $con = mysqli_connect("localhost", "root", "", "law");
 // $sno = $_POST["sno"];
  $par = $_POST["par"];
  $apt = $_POST["apt"];
  $off = $_POST["off"];
  $mob = $_POST["mob"];
  $apd = $_POST["apd"];
  $fin = $_POST["fin"];
  $apd = date('Y-m-d', strtotime($apd));
  $fin = !empty($fin) ? "'" . date('Y-m-d', strtotime($fin)) . "'" : "NULL";
  $fil = $_FILES["file"];
  $filty = $fil["type"];
  @$fileCont = addslashes(file_get_contents($fil['tmp_name']));
  //$fileCont = addslashes(file_get_contents($fil['tmp_name']='NULL'));
  $q = "insert into data (part, apty, offn, mobn, apde, find,filee,file_type) values('$par', '$apt', '$off', '$mob', '$apd', $fin,'$fileCont','$filty')";
  //$ans = mysqli_query($con, $q);
  if ($con->query($q) === TRUE) 
  {
    if($q != NULL)
    {
      echo "<script>alert('Inserted!'); window.location.href = 'int.html';</script>";
      exit();
    }
  }  
  else 
  {
    $ans = mysqli_query($con, $q);
    echo "<script>alert('FAILED, Please try again! Go through README.txt in the app's files'); window.location.href = 'int.html';</script>";
    exit();
  }
?>