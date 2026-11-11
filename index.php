<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Praktikum PHP</title>
</head>

<body>
    <h1>Belajar PHP</h1>
    <?php
    echo "<p>PHP berhasil dijalankan.</p>";
    echo "<p>Waktu server: " . date("d-m-Y H:i:s") . "</p>";
    ?>

    <?php
    $nama = "Siti";
    $tugas = 90;
    $uts = 89;
    $uas = 86;
    $nilaiAkhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
    if ($nilaiAkhir >= 85) {
        $predikat = "A";
    } elseif ($nilaiAkhir >= 75) {
        $predikat = "B";
    } elseif ($nilaiAkhir >= 60) {
        $predikat = "C";
    } else {
        $predikat = "D";
    }
    echo "Nama: " . htmlspecialchars($nama) . "<br>";
    echo "Nilai akhir: " . number_format($nilaiAkhir, 2) . "<br>";
    echo "Predikat: " . $predikat;
    ?>

    <?php
    $mahasiswa = ["Alya", "Bima", "Citra", "Doni"];
    echo "<h3>Daftar Mahasiswa</h3><ol>";
    foreach ($mahasiswa as $nama) {
        echo "<li>" . htmlspecialchars($nama) . "</li>";
    }
    echo "</ol>";
    ?>

    <?php
    function hitungDiskon($harga, $persen)
    {
        $potongan = $harga * ($persen / 100);
        return $harga - $potongan;
    }
    $hargaAkhir = hitungDiskon(150000, 10);
    echo "Harga setelah diskon: Rp" . number_format($hargaAkhir, 0, ",", ".");

    function hitungLuasPersegiPanjang($panjang, $lebar)
    {
        return $panjang * $lebar;
    }

    $panjang = 10;
    $lebar = 5;
    $luas = hitungLuasPersegiPanjang($panjang, $lebar);

    echo "<h3>Luas Persegi Panjang</h3>";
    echo "Panjang: " . $panjang . "<br>";
    echo "Lebar: " . $lebar . "<br>";
    echo "Luas: " . $luas;
    ?>

    <!-- cari.php -->
    <form method="GET" action="">
        <label for="kata">Kata kunci:</label>
        <input id="kata" name="kata" type="text">
        <button type="submit">Cari</button>
    </form>
    <?php
    if (isset($_GET["kata"])) {
        $kata = trim($_GET["kata"]);
        echo "Kata kunci: " . htmlspecialchars($kata, ENT_QUOTES, "UTF-8");
    }
    ?>

    <!-- index.php -->
    <form method="POST" action="">
        <label for="nama">Nama:</label>
        <input id="nama" name="nama" type="text" required>
        <label for="prodi">Program Studi:</label>
        <input id="prodi" name="prodi" type="text" required>
        <button type="submit" name="kirim">Kirim Data</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nama = trim($_POST["nama"] ?? "");
        $prodi = trim($_POST["prodi"] ?? "");
        if ($nama === "" || $prodi === "") {
            echo "<p>Semua kolom wajib diisi.</p>";
        } else {
            echo "<h3>Data diterima</h3>";
            echo "Nama: " . htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "<br>";
            echo "Program Studi: " . htmlspecialchars($prodi, ENT_QUOTES, "UTF-8");
        }
    }
    ?>

    <?php
    $hasil = null;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $barang = trim($_POST["barang"] ?? "");
        $hargaInput = $_POST["harga"] ?? "";
        $jumlahInput = $_POST["jumlah"] ?? "";
        if (
            $barang === "" || !is_numeric($hargaInput) ||
            !ctype_digit((string) $jumlahInput) ||
            (float) $hargaInput < 0 || (int) $jumlahInput < 1
        ) {
            $error = "Periksa kembali nama barang, harga, dan jumlah.";
        } else {
            $harga = (float) $hargaInput;
            $jumlah = (int) $jumlahInput;
            $subtotal = $harga * $jumlah;
        }
    }

    ?>
    <form method="POST">
        <label>Nama barang <input name="barang" required></label>
        <label>Harga <input name="harga" type="number" min="0" step="0.01" required></label>
        <label>Jumlah <input name="jumlah" type="number" min="1" step="1" required></label>
        <button type="submit">Hitung</button>
    </form>

    <?php
    if (isset($error)) {
        echo "<p>" . htmlspecialchars($error) . "</p>";
    } elseif (isset($subtotal)) {
        echo "<p>Barang: " . htmlspecialchars($barang) . "</p>";
        echo "<p>Subtotal: Rp" . number_format($subtotal, 0, ",", ".") . "</p>";
    }
    ?>

    <?php
    $data = null;
    $error = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nama = trim($_POST["nama"] ?? "");
        $nim = trim($_POST["nim"] ?? "");
        $prodi = trim($_POST["prodi"] ?? "");
        $semesterInput = $_POST["semester"] ?? "";
        $email = trim($_POST["email"] ?? "");
        if ($nama === "")
            $error[] = "Nama wajib diisi.";
        if ($nim === "")
            $error[] = "NIM wajib diisi.";
        if ($prodi === "")
            $error[] = "Program studi wajib diisi.";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = "Format email tidak valid.";
        }
        if (
            !ctype_digit((string) $semesterInput) ||
            (int) $semesterInput < 1 || (int) $semesterInput > 14
        ) {
            $error[] = "Semester harus berupa angka 1–14.";
        }
        if (!$error) {
            $data = compact("nama", "nim", "prodi", "email");
            $data["semester"] = (int) $semesterInput;
        }
    }
    ?>
</body>

</html>