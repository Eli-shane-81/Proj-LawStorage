<?php
    echo "<head> <meta charset='UTF-8'> <meta name='viewport' content='width=device-width, initial-scale=1.0'> <title>Pending Or Done</title>
    <link rel='stylesheet' href='table.css'> <link rel='icon' href='icn.ico' type='image/x-icon'></head>";
    $con=mysqli_connect("localhost","root","","law");

    $q = isset($_POST['pend']) ? "select *from data where find is NULL" : "select *from data where find";
    $rs=mysqli_query($con,$q);
    echo "<div id='previewContainer' class='preview-container'></div>";
    echo "<form><table border='2'>
    <tr>
        <th>Party Name</th>
        <th>Application Type</th>
        <th>Officers Name</th>
        <th>Mobile Number</th>
        <th>Application Date</th>
        <th>Final Date</th>
        <th>Photo</th>
        <th colspan=2>Operate</th>
    </tr>";

    while ($row = mysqli_fetch_assoc($rs)) 
    {       
        echo "<tr>
        <td align=center>".htmlspecialchars($row['part'])."</td>
        <td align=center>".htmlspecialchars($row['apty'])."</td>
        <td align=center>".htmlspecialchars($row['offn'])."</td>
        <td align=center>".htmlspecialchars($row['mobn'])."</td>
        <td align=center>". date('d-m-Y', htmlspecialchars(strtotime($row['apde']))) ."</td>";
    echo !empty(htmlspecialchars($row['find'])) ? "<td>". date('d-m-Y', htmlspecialchars(strtotime($row['find']))) ."</td>" : "<td align=center>&#128683;</td>";   // NULL

    if ($row['filee'] !== NULL && strpos($row['file_type'], 'image') !== false) {
        echo "<div class='preview-container'>
                <td>
                    <input type='button'  class='preview-btn' value='&#128269' onclick='togglePreview(this)' style='background-color:#ff000000; border:none; '>
                    <div class='preview' style='display:none;'>
                        <img src='data:{$row['file_type']};base64," . htmlspecialchars(base64_encode($row['filee'])) . "' width='auto' height='auto'>
                    </div>
                </td>
            </div>";
    } elseif ($row['filee'] !== NULL && $row['file_type'] == 'application/pdf') {
        echo "<div class='preview-container'>
                <td>
                    <input type='button' align='center' class='preview-btn' value='&#128269' onclick='togglePreview(this)' style='background-color:#ff000000; border:none; display: flex; justify-content: center; align-items: center;'>
                    <div class='preview' style='display:none;'>
                        <iframe src='data:application/pdf;base64," . htmlspecialchars(base64_encode($row['filee'])) . "' width='100%' height='auto'></iframe>
                    </div>
                </td>
            </div>";
    } else {
        echo "<div class='preview-container'>
                <td>
                    <input type='button' class='preview-btn' value='&#128269' onclick='togglePreview(this)' style='background-color:#ff000000; border:none;'>
                    <div class='preview' style='display:none;'>
                        <b style='color:white; font-family:Segoe UI, Tahoma, Geneva, sans-serif; font-size:40px;'>No file added</b>
                    </div>
                </td>
            </div>";
    }

    echo "<td><a href=del.php?rno=".htmlspecialchars($row['seno'])."><input type='button' id='Dbtn' value='Delete'></a></td>
          <td><a href=upd.php?rno=".htmlspecialchars($row['seno'])."><input type='button' id='Ubtn' value='Update'></a></td></tr></div>";
    }
    echo "</table></form><br><br><center><a href='int.html'><input type='button' value='back'></a></center>";
    echo "<footer>Developed by Purab Nehru</footer>";
?>
<script>
    function togglePreview(button) {
    var preview = button.nextElementSibling;
    var previewContainer = document.getElementById('previewContainer');
    if (previewContainer.style.display === 'none' || previewContainer.innerHTML !== preview.innerHTML) {
        previewContainer.innerHTML = preview.innerHTML;
        previewContainer.style.display = 'block';
    } else {
        previewContainer.style.display = 'none';
    }
}
document.addEventListener('click', function(event) {
    var previewContainer = document.getElementById('previewContainer');
    var isClickInside = previewContainer.contains(event.target) || event.target.classList.contains('preview-btn');

    if (!isClickInside) {
        previewContainer.style.display = 'none';
    }
});
</script>

