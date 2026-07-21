<?php
include_once("config.php");

$message = "";
if (isset($_POST['Submit'])) {
    $nama_alat = mysqli_real_escape_string($mysqli, $_POST['nama_alat']);
    $tahun     = mysqli_real_escape_string($mysqli, $_POST['tahun']);
    $merek     = mysqli_real_escape_string($mysqli, $_POST['merek']);
    $lokasi    = mysqli_real_escape_string($mysqli, $_POST['lokasi']);

    $result = mysqli_query($mysqli, "INSERT INTO alat(nama_alat, tahun, merek, lokasi) VALUES('$nama_alat', '$tahun', '$merek', '$lokasi')");

    if ($result) {
        $message = "Data alat berhasil ditambahkan!";
    } else {
        $message = "Gagal menambahkan data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS - Tambah Alat Elektromedis</title>
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
            max-width: 700px;
            margin: 0 auto;
        }

        /* Header Card */
        .header-card {
            background: linear-gradient(135deg, #1f1f1f 0%, #2a1b12 100%);
            border-left: 6px solid #ff6b00;
            border-radius: 12px;
            padding: 24px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.5);
            margin-bottom: 25px;
        }

        .header-title h1 {
            font-size: 20px;
            color: #ffffff;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-title h1 i {
            color: #ff6b00;
        }

        .student-badge {
            background: rgba(255, 107, 0, 0.15);
            border: 1px solid rgba(255, 107, 0, 0.4);
            padding: 8px 14px;
            border-radius: 8px;
            text-align: right;
        }

        .student-name {
            color: #ff9e43;
            font-weight: 600;
            font-size: 13px;
        }

        .student-nim {
            color: #d0d0d0;
            font-size: 11px;
        }

        /* Navigation Button */
        .nav-bar {
            margin-bottom: 20px;
        }

        .btn-back {
            color: #a0a0a0;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .btn-back:hover {
            color: #ff6b00;
        }

        /* Form Card */
        .form-card {
            background: #1e1e1e;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            border: 1px solid #2a2a2a;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.15);
            border: 1px solid rgba(46, 204, 113, 0.4);
            color: #2ecc71;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #cccccc;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            color: #ff6b00;
            font-size: 14px;
        }

        .input-wrapper input {
            width: 100%;
            background-color: #121212;
            border: 1px solid #333;
            border-radius: 8px;
            padding: 12px 14px 12px 42px;
            color: #ffffff;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        .input-wrapper input:focus {
            border-color: #ff6b00;
            box-shadow: 0 0 10px rgba(255, 107, 0, 0.2);
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(45deg, #ff6b00, #ff8800);
            color: #ffffff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3);
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 0, 0.5);
            background: linear-gradient(45deg, #e66000, #ff7700);
        }

        @media (max-width: 600px) {
            .header-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .student-badge {
                text-align: left;
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Navigation -->
        <div class="nav-bar">
            <a href="index.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
        </div>

        <!-- Header Card -->
        <div class="header-card">
            <div class="header-title">
                <h1><i class="fa-solid fa-plus-circle"></i> Tambah Alat Elektromedis</h1>
            </div>
            <div class="student-badge">
                <div class="student-name"><i class="fa-solid fa-user-gear"></i> Anggi Febriawan</div>
                <div class="student-nim">NIM: 2202505012</div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <?php if (!empty($message)): ?>
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i> <?php echo $message; ?>
                    <a href="index.php" style="color: #2ecc71; font-weight: 600; margin-left: auto;">Lihat Data</a>
                </div>
            <?php endif; ?>

            <form action="add.php" method="post">
                <div class="form-group">
                    <label>Nama Alat</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-toolbox"></i>
                        <input type="text" name="nama_alat" placeholder="Contoh: Defibrillator" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tahun Pengadaan</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-calendar"></i>
                        <input type="number" name="tahun" min="1900" max="2099" placeholder="Contoh: 2025" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Merek / Pabrikan</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-industry"></i>
                        <input type="text" name="merek" placeholder="Contoh: Mindray" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Lokasi / Ruangan</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-hospital"></i>
                        <input type="text" name="lokasi" placeholder="Contoh: ICU" required>
                    </div>
                </div>

                <button type="submit" name="Submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Data Alat
                </button>
            </form>
        </div>
    </div>

</body>
</html>