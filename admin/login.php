<?php 

include 'config/core.php';

// jika tombol login ditekan 
if(isset($_POST['login'])){
    $username   = mysqli_escape_string($db, $_POST['username']);
    $password   = mysqli_escape_string($db, $_POST['password']);

    // ambil data akun berdasarkan username
    $checkuser = mysqli_query($db, "SELECT * FROM karyawan WHERE username ='$username'");

    // check validasi akun
    if(mysqli_num_rows($checkuser) === 1){
        // check password
        $rows = mysqli_fetch_assoc($checkuser);
        if(password_verify($password, $rows['password'])){
        // set session
            $_SESSION['login']      = true;
            $_SESSION['id_karyawan'] = $rows['id_karyawan'];
            $_SESSION['username'] = $rows['username'];
            $_SESSION['nama_karyawan'] = $rows['nama_karyawan'];
            $_SESSION['role'] = $rows['role'];

            header("Location: index.php");
            exit;
        }
    }
    // jika password atau username gagal
    $error = true;
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Halaman Login</title>

    <!-- Styles -->
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/helper.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body style="background-color: #436274">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="login-content">
                        <div class="login-form">
                            <h4>LOGIN</h4><br>

                            <!-- KETIKA LOGIN ERROR ATAU SALAH KATASANDI DAN PASSWORD -->
                            <?php if(isset($error)): ?>
                                <div align="center" class="mb-2 alert alert-danger alert-dismissible fade-show" role="alert">
                                    <i><b>Username / Password SALAH</b></i>
                                </div>
                            <?php endif; ?>

                            <form method="post" action="">
                                <div class="form-group">
                                    <label><b>Username</b></label>
                                    <input type="text" class="form-control" placeholder="Masukkan Username Anda" name="username">
                                </div>
                                <div class="form-group">
                                    <label><b>Password</b></label>
                                    <input type="password" class="form-control" placeholder="Masukkan Password Anda" name="password">
                                </div>

                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="login">Sign in</button>

                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="https://api.whatsapp.com/send?phone=6285380452063&text=Hai%20Admin%20Saya%20Ingin%20Registrasi%20akun..."> Sign Up Here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>