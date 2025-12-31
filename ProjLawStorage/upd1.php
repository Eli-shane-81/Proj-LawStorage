<?php
    $con = mysqli_connect("localhost", "root", "", "law");
    $oldval = $_POST["oldval"];
    $sno = $_POST["sno"];
    $par = $_POST["par"];
    $apt = $_POST["apt"];
    $off = $_POST["off"];
    $mob = $_POST["mob"];
    $apd = date('Y-m-d', strtotime($_POST["apd"]));
    $fin = !empty($_POST["fin"]) ? "'" . date('Y-m-d', strtotime($_POST["fin"])) . "'" : "NULL";

    if ($_FILES["file"]["error"] == 0) 
    {
        $filty = $_FILES["file"]["type"];   
        $fileCont = addslashes(file_get_contents($_FILES["file"]["tmp_name"]));
        $q = "UPDATE data SET seno='$sno', part='$par', apty='$apt', offn='$off', mobn='$mob', apde='$apd', find=$fin, filee='$fileCont', file_type='$filty' WHERE seno='$oldval'";
    } 
    else
    { $q = "UPDATE data SET seno='$sno', part='$par', apty='$apt', offn='$off', mobn='$mob', apde='$apd', find=$fin WHERE seno='$oldval'"; }
    if ($con->query($q) === TRUE) 
    {
      if($q != NULL)
      {
        echo "<script>alert('Updated!'); window.location.href = 'int.html';</script>";
        exit();
      }
    }  
    else 
    {
      $ans = mysqli_query($con, $q);
      echo "<script>alert('Limit Exceed or Wrong Input! Try again! Go through README.txt in the app's files'); window.location.href = 'upd.php?rno=$sno'</script>";
      exit();
    }
?>