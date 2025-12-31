<?php
    echo "<head> <meta charset='UTF-8'> <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='table.css'> <link rel='icon' href='icn.ico' type='image/x-icon'>
    <title>All Records</title>
        <style> tr:nth-child(even) td { background-color: #eaeaea; }
                tr:hover td { background-color: #c6e7b8;} 
            img {
                    max-width: 100%;  max-height: 100%;  width: fit-content;  height: fit-content;
                }
</style></head>";    
    $con = mysqli_connect("localhost", "root", "", "law"); $var=NULL;
    $ad = date('d-m-Y', strtotime($var['apde']));
    $fd = !empty($vab['fin']) ? "'" . date('d-m-Y', strtotime($vab['fin'])) . "'" : "NULL";
    $q = "insert into data (appdate, findate) VALUES ('$ad', $fd)";
    mysqli_query($con, $q);
    $q = "select *from data";
    $rs = mysqli_query($con, $q);
    $n = mysqli_num_rows($rs);
    echo "<div class='table-container'><form autocomplete='off'><b style='color:white;'>Search :</b>  <input type='text' id='searchInput' placeholder=' Search...' autofocus></form><br>
    <td colspan='10'><center><a href='int.html'><input type='button' value='Back'></center></a> <br>
    <div id='previewContainer' class='preview-container'></div>";
    echo "<form><table border='1' id='dataTable'>
    <tr>
        <th>Sr.No.</th>
        <th>Party Name</th>
        <th>Application Type</th>
        <th>Officers Name</th>
        <th>Mobile Number</th>
        <th>Application Date</th>
        <th>Final Date</th>
        <th>E-file</th>
        <th colspan=2>Operate</th>
    </tr>"; 
    $i=1;
while ($row = mysqli_fetch_assoc($rs)) 
{ 
    echo "<tr>
        <td align=center>".htmlspecialchars($i)."</td>
        <td align=center>".htmlspecialchars($row['part'])."</td>
        <td align=center>".htmlspecialchars($row['apty'])."</td>
        <td align=center>".htmlspecialchars($row['offn'])."</td>
        <td align=center>".htmlspecialchars($row['mobn'])."</td>
        <td align=center>". date('d-m-Y', htmlspecialchars(strtotime($row['apde']))) ."</td>";
    echo !empty(htmlspecialchars($row['find'])) ? "<td align=center>". date('d-m-Y', htmlspecialchars(strtotime($row['find']))) ."</td>" : "<td align=center>&#128683;</td>";
 
    if ($row['filee'] !== NULL && strpos($row['file_type'], 'image') !== false) {
        echo "<div class='preview-container'>
                <td>
                    <input type='button' class='preview-btn' value='&#128269' onclick='togglePreview(this)' style='background-color:#ff000000; border:none; '>
                    <div class='preview' style='display:none;'>
                        <img src='data:{$row['file_type']};base64," . htmlspecialchars(base64_encode($row['filee'])) . "' width='auto' height='auto'>
                    </div>
                </td>
            </div>";
    } elseif ($row['filee'] !== NULL && $row['file_type'] == 'application/pdf') { //&#128269
        echo "<div class='preview-container'>
                <td>                    
                    <input type='button' class='preview-btn' value='&#x1F50D;' onclick='togglePreview(this)' style='background-color:#ff000000; font:black; border:none;'>
                    <div class='preview' style='display:none;'>
                        <iframe src='data:application/pdf;base64," . htmlspecialchars(base64_encode($row['filee'])) . "' width='100%' height='auto'></iframe>
                    </div>
                </td>
            </div>";
    } else {
        echo "<div class='preview-container'>
                <td>
                    <input type='button' class='preview-btn' value='&#128269' onclick='togglePreview(this)' style='background-color:#ff000000; border:none;'>
                    <div class='preview' style='display:none; '>
                        <b style='color:white;background-color: #383434; border: 1px solid #ff000000; font-family:Segoe UI, Tahoma, Geneva, sans-serif; font-size:80px;'>No file added</b>
                    </div>
                </td>
            </div>";
    }
    echo "<td><a href=del.php?rno=".htmlspecialchars($row['seno'])."><input type='button' id='Dbtn' value='Delete'></a></td>
    <td><a href=upd.php?rno=".htmlspecialchars($row['seno'])."><input type='button' id='Ubtn' value='Update'></a></td></tr></div>";
    $i++;
}
echo "</table></form></div> ";
echo "</div></div>";
echo "<footer>Developed by Purab Nehru</footer>";
?>
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let searchTerm = this.value.trim().toLowerCase();
        let table = document.getElementById('dataTable');
        let rows = table.querySelectorAll('tr');

        rows.forEach((row, index) => {
            if (index === 0) return;

            let cells = row.querySelectorAll('td');
            let match = false;

            cells.forEach(cell => {
                if (cell.innerText.toLowerCase().includes(searchTerm)) {
                    match = true;
                }
            });
            if (match) {
                row.style.display = ''; // show row
            } else {
                row.style.display = 'none'; // hide row
            }
        });
    });

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
   
    function previewFile(filePath) {
    const modal = document.getElementById('previewModal');
    const previewImage = document.getElementById('previewImage');

    previewImage.src = filePath;

    modal.style.display = 'flex';
  }

  function closePreview() {
    const modal = document.getElementById('previewModal');
    modal.style.display = '';
  }
</script>