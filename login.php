<?php
SESSION_START();
include "database.php";

$db = new Database();

$nim_nip = (isset($_SESSION['nim_nip'])) ? $_SESSION['nim_nip'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $nim_nip){
    // Query dosen
    $result = $db->execute("SELECT * FROM dosen_tbl WHERE nip = '".$nim_nip."' AND token = '".$token."'");

    // If dosen, ...
    if($result){
        // Redirect to dashboard dosen
        header("Location: user/dosen/dashboarddosen.php");
    }
    // If not dosen, ...
    else{
        // Query mahasiswa
        $result = $db->execute("SELECT * FROM mahasiswa_tbl WHERE nim = '".$nim_nip."' AND token = '".$token."'");

        // If mahasiswa, ...
        if($result){
            // Redirect to dashboard mahasiswa
            header("Location: user/mahasiswa/dashboardmahasiswa.php");
        }
    }
}

// Get notification
$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Halaman Sign Up dan Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="cont">
        <!--LOG IN-->
        <div class="form sign-in">
        <br>
        <br>
            <h2>Login</h2>
            <form action="login/login_process.php" method="post">
                <!--NAMA-->
                <label>
                    <span>NIM/NIP</span>
                    <input type="text" name="nim_nip" required>
                </label>

                <!--PASSWORD-->
                <label>
                    <span>Password</span>
                    <input type="password" name="password" required>
                </label>

                <!--SUBMIT-->
                <button class="submit">
                    <input type="submit" value="LOGIN">
                </button>
            </form>
        </div>

        <div class="sub-cont">
            <div class="img">
                <div class="img-text m-up">
                    <br> <br> <br> <br> <br>
                    <h2>Belum punya akun?</h2>
                    <p>Daftar Sekarang</p>
                </div>
                <div class="img-text m-in">
                    <br> <br> <br> <br> <br>
                    <h2>Sudah Mendaftar</h2>
                    <p>Silahkan Login</p>
                </div>
                <div class="img-btn">
                    <span class="m-up">Sign Up</span>
                    <span class="m-in">Login</span>
                </div>
            </div>

            <!--SIGN UP-->
            <div class="form sign-up" id="signup">
                <div class="signup"></div>
                <h2>Sign up</h2>
                <form action="login/register_process.php" method="post">
                    <label>
                        <span>Daftar sebagai: </span>
                        <select name="mhs_or_dosen">
                            <option value="1">Dosen</option>
                            <option value="2">Mahasiswa</option>
                        </select>
                    </label>

                    <!--NAMA-->
                    <label>
                        <span>Nama Lengkap</span>
                        <input type="text" name="nama_lengkap" required>
                    </label>

                    <!--NIM-->
                    <label>
                        <span>NIM/NIP</span>
                        <input type="text" name="nim_nip" required>
                    </label>

                    <!--PASSWORD-->
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" required>
                    </label>

                    <!--CONFIRM PASSWORD-->
                    <label>
                        <span>Confirm Password</span>
                        <input type="password" name="password2" required>
                    </label>

                    <!--SUBMIT-->
                    <button class="submit" id="sign-up">
                        <input type="submit" value="SIGN UP">
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

<?php
$db->setNotification($notification);
?>