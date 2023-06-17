<!DOCTYPE html>
<html>
<head>
    <title>Form Registrasi</title>
</head>
<body>

<?php
// Setel variabel kosong untuk menyimpan pesan error
$nameErr = $emailErr = $passwordErr = "";
$name = $email = $password = "";

// Cek apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi nama
    if (empty($_POST["name"])) {
        $nameErr = "Nama harus diisi";
    } else {
        $name = test_input($_POST["name"]);
        // Cek apakah nama hanya terdiri dari huruf dan spasi
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Hanya huruf dan spasi yang diperbolehkan";
        }
    }

    // Validasi email
    if (empty($_POST["email"])) {
        $emailErr = "Email harus diisi";
    } else {
        $email = test_input($_POST["email"]);
        // Cek apakah format email valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email tidak valid";
        }
    }

    // Validasi password
    if (empty($_POST["password"])) {
        $passwordErr = "Password harus diisi";
    } else {
        $password = test_input($_POST["password"]);
        // Anda dapat menambahkan validasi tambahan untuk password sesuai kebutuhan
    }

    // Jika tidak ada pesan error, proses registrasi
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
        // Proses pendaftaran pengguna, misalnya dengan menyimpan data ke database
        // Di sini Anda dapat menambahkan kode untuk menyimpan data ke database

        // Tampilkan pesan sukses
        echo "<h2>Registrasi berhasil!</h2>";
        echo "Nama: " . $name . "<br>";
        echo "Email: " . $email . "<br>";
    }
}

// Fungsi untuk membersihkan data input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Form Registrasi</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Nama:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <span class="error"><?php echo $nameErr; ?></span><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
    <span class="error"><?php echo $emailErr; ?></span><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <span class="error"><?php echo $passwordErr; ?></span><br><br>

    <input type="submit" name="submit" value="Daftar">
</form>

</body>
</html>
