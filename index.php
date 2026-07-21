<?php
include_once("config.php");

// Logika Pencarian Data
$search = "";
if (isset($_GET['cari'])) {
    $search = mysqli_real_escape_string($mysqli, $_GET['cari']);
    $query = "SELECT * FROM alat WHERE 
              nama_alat LIKE '%$search%' OR 
              merek LIKE '%$search%' OR 
              lokasi LIKE '%$search%' OR 
              tahun LIKE '%$search%' 
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM alat ORDER BY id DESC";
}

$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Sistem Informasi Alat Elektromedis</title>
    <!-- Google Fonts & FontAwesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #121212;
            color: #e0e0e0;
            min-height: 100vh;
            padding: 30px 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Header & Identity Card */
        .header-card {
            background: linear-gradient(135deg, #1f1f1f 0%, #2a1b12 100%);
            border-left: 6px solid #ff6b00;
            border-radius: 12px;
            padding: 24px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.5);
            margin-bottom: 30px;
        }

        .header-title h1 {
            font-size: 24px;
            color: #ffffff;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-title h1 i {
            color: #ff6b00;
        }

        .header-title p {
            color: #a0a0a0;
            font-size: 13px;
            margin-top: 4px;
        }

        .student-badge {
            background: rgba(255, 107, 0, 0.15);
            border: 1px solid rgba(255, 107, 0, 0.4);
            padding: 10px 18px;
            border-radius: 8px;
            text-align: right;
        }

        .student-name {
            color: #ff9e43;
            font-weight: 600;
            font-size: 15px;
        }

        .student-nim {
            color: #d0d0d0;
            font-size: 12px;
            letter-spacing: 1px;
        }

        /* Action Bar (Search & Add Button) */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .btn-add {
            background: linear-gradient(45deg, #ff6b00, #ff8800);
            color: #ffffff;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3);
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 0, 0.5);
            background: linear-gradient(45deg, #e66000, #ff7700);
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 8px;
            overflow: hidden;
            width: 320px;
            transition: 0.3s;
        }

        .search-box:focus-within {
            border-color: #ff6b00;
            box-shadow: 0 0 10px rgba(255, 107, 0, 0.2);
        }

        .search-box input {
            background: transparent;
            border: none;
            padding: 12px 16px;
            color: #fff;
            font-size: 14px;
            width: 100%;
            outline: none;
        }

        .search-box button {
            background: transparent;
            border: none;
            color: #ff6b00;
            padding: 12px 16px;
            cursor: pointer;
            transition: 0.2s;
        }

        .search-box button:hover {
            color: #fff;
        }

        /* Table Styling */
        .table-wrapper {
            background: #1e1e1e;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            border: 1px solid #2a2a2a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background: linear-gradient(90deg, #ff6b00, #d45100);
            color: #ffffff;
        }

        th {
            padding: 16px 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 20px;
            font-size: 14px;
            border-bottom: 1px solid #2a2a2a;
            color: #cccccc;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background-color: #262626;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges for Lokasi & Merek */
        .badge-location {
            background: rgba(0, 184, 148, 0.15);
            color: #00b894;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            border: 1px solid rgba(0, 184, 148, 0.3);
        }

        .badge-year {
            background: #2d2d2d;
            color: #ff9e43;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Action Buttons */
        .action-links {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-edit {
            background-color: rgba(241, 196, 15, 0.15);
            color: #f1c40f;
            border: 1px solid rgba(241, 196, 15, 0.3);
        }

        .btn-edit:hover {
            background-color: #f1c40f;
            color: #000;
        }

        .btn-delete {
            background-color: rgba(231, 76, 60, 0.15);
            color: #e74c3c;
            border: 1px solid rgba(231, 76, 60, 0.3);
        }

        .btn-delete:hover {
            background-color: #e74c3c;
            color: #fff;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #777;
        }

        .no-data i {
            font-size: 40px;
            margin-bottom: 10px;
            color: #ff6b00;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            .student-badge {
                text-align: left;
                width: 100%;
            }
            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }
            .search-box {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header & Identitas -->
        <div class="header-card">
            <div class="header-title">
                <h1><i class="fa-solid fa-heart-pulse"></i> SIMRS Elektromedis</h1>
                <p>Sistem Management & Inventaris Alat Kesehatan / Elektromedis</p>
            </div>
            <div class="student-badge">
                <div class="student-name"><i class="fa-solid fa-user-gear"></i> Anggi Febriawan</div>
                <div class="student-nim">NIM: 2202505012</div>
            </div>
        </div>

        <!-- Action Bar: Tombol Tambah & Form Pencarian -->
        <div class="action-bar">
            <a href="add.php" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Alat Baru
            </a>

            <form action="index.php" method="GET" class="search-box">
                <input type="text" name="cari" placeholder="Cari alat, merek, lokasi..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <!-- Tabel Data Alat -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama Alat</th>
                        <th>Tahun</th>
                        <th>Merek</th>
                        <th>Lokasi / Ruangan</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($user_data = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td style='font-weight: 500; color: #fff;'><i class='fa-solid fa-toolbox' style='color: #ff6b00; margin-right: 8px;'></i> " . $user_data['nama_alat'] . "</td>";
                            echo "<td><span class='badge-year'>" . $user_data['tahun'] . "</span></td>";
                            echo "<td>" . $user_data['merek'] . "</td>";
                            echo "<td><span class='badge-location'><i class='fa-solid fa-hospital-user'></i> " . $user_data['lokasi'] . "</span></td>";
                            echo "<td style='text-align: center;'>
                                    <div class='action-links' style='justify-content: center;'>
                                        <a href='edit.php?id=" . $user_data['id'] . "' class='btn-action btn-edit'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                                        <a href='delete.php?id=" . $user_data['id'] . "' class='btn-action btn-delete' onclick='return confirm(\"Yakin ingin menghapus alat ini?\")'><i class='fa-solid fa-trash'></i> Delete</a>
                                    </div>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>
                                <td colspan='5' class='no-data'>
                                    <i class='fa-solid fa-magnifying-glass-minus'></i><br>
                                    Data alat kesehatan tidak ditemukan.
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>