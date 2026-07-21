<?php
include_once("config.php");
$result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>SIM RS - Data Alat</title>
    <style>
        header { background-color: orange; color: white; padding: 10px; }
        table { width: 80%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        .header-bg { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Alat Elektromedis</h2>
    <a href="add.php">Tambah Alat Baru</a><br/><br/>

    <table>
        <tr class="header-bg">
            <th>Nama Alat</th> <th>Tahun</th> <th>Merek</th> <th>Lokasi</th> <th>Aksi</th>
        </tr>
        <?php
        while($user_data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$user_data['nama_alat']."</td>";
            echo "<td>".$user_data['tahun']."</td>";
            echo "<td>".$user_data['merek']."</td>";
            echo "<td>".$user_data['lokasi']."</td>";
            echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]'>Delete</a></td></tr>";
        }
        ?>
    </table>
</body>
</html>