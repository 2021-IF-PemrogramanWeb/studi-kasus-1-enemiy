<?php 
session_start();

if(isset($_SESSION['login'])) {
  header("Location: 2_halaman-tabel.php");

  exit;
}

require_once 'functions.php';

// tombol login ditekan
if(isset($_POST['login'])) {
  $login = login($_POST);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman 1 - Login</title>
    <!-- bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="1_halaman1-login.css">
</head>

<body class="container h-100">
    <div class="row justify-content-md-center">
        <div class="card-wrapper text-center">
            <div class="brand">
                <img src="logo.jpg" alt="logo">
            </div>
            <div class="card fat">
                <div class="card-body">
                    <form action="" method="post" class="login-validation" novalidate="">
                    <?php if(isset($login['error'])) : ?>
            <p class="text-center text-danger"><?= $login['pesan']; ?></p>
          <?php endif; ?>
                        <div class="form-group">
                            <label for="email" class="text-center ">User</label>
                            <input id="email" type="email" class="form-control" name="username" value=" " required autofocus>
                        </div>

                        <div class="form-group ">
                            <label for="password" class="text-center">password</label>
                            <input id="password" type="password" class="form-control" name="password" required data-eye>

                        </div>
                        <button name="login" type="submit" class="btn btn-primary btn-lg ">
										Login
									</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js " integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM " crossorigin="anonymous "></script>
</body>
</html>