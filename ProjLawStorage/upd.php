<?php
    $con = mysqli_connect("localhost", "root", "", "law");
    $rno = $_GET['rno'];
    $q = "select *from data where seno=$rno";
    $rs = mysqli_query($con, $q);
    $row = mysqli_fetch_assoc($rs);
    $fildis = NULL;

    if (strpos($row['file_type'], 'image') !== false) {
        $fildis = "<img src='data:{$row['file_type']};base64," . base64_encode($row['filee']) . "' width='100' height='100' />";
    } elseif ($row['file_type'] == 'application/pdf') {
        $fildis = "IT'S A PDF FILE.";
    } else {
        $fildis = "&#128683; No file.";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css"> <link rel="icon" href="icn.ico" type="image/x-icon">
    <title>Update Record</title>
</head>
<body>
    <form action="upd1.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="oldval" value="<?php echo $row['seno']; ?>">
        <td><input type="hidden" name="sno" value="<?php echo htmlspecialchars($row['seno']); ?>">
        <table border="2" >
            <tr>    
                <td>Party Name :</td>
                <td><input type="text" name="par" value="<?php echo htmlspecialchars($row['part']); ?>"></td>
            </tr>
            <tr>
                <td>Application Type :</td>
                <td><input type="text" name="apt" value="<?php echo htmlspecialchars($row['apty']); ?>"></td>
            </tr>
            <tr>
                <td>Office Name :</td>
                <td><input type="text" name="off" value="<?php echo htmlspecialchars($row['offn']); ?>"></td>
            </tr>
            <tr>
                <td>Mob. No. :</td>
                <td><input type="text" name="mob" value="<?php echo htmlspecialchars($row['mobn']); ?>" maxlength="14"></td>
            </tr>
            <tr>
                <td>Application Date :</td>
                <td><input type="date" name="apd" value="<?php echo htmlspecialchars($row['apde']); ?>"></td>
            </tr>
            <tr>
                <td>Final Date :</td>
                <td><input type="date" name="fin" value="<?php echo htmlspecialchars($row['find']); ?>"></td>
            </tr>
            <tr>
                <td>Current file :</td>
                <td><?php echo $fildis; ?></td>
            </tr>
            <tr>
                <td>Upload New File :</td>
                <td><input type="file" name="file" accept="image/*, application/pdf"></td>
            </tr>
        </table><br><br>
        <input type="submit" value="Update" name="up">
    </form>
    <footer>Developed by Purab Nehru</footer>
</body>
</html>