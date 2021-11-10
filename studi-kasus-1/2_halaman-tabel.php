<?php 
session_start();

if(!isset($_SESSION['login'])) {
    header("Location: 1_halaman1-login.php");
    exit;
}

require_once 'functions.php';

if(!isset($_GET['user_id'])) {
  header("Location: 1_halaman1-login.php");
  exit;
}

$idOrangLogin = $_GET['user_id'];

$dataKejadian = query("SELECT *
                        FROM event");

$yangLogin = query("SELECT * FROM user WHERE user_id = $idOrangLogin");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman 2 - Tabel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="logo.jpg" alt="" width="30" class="d-inline-block align-text-top" />
        </a>         
        <div class="">
          <div class="navbar-nav ms-auto container-fluid">
        
          </div>
        </div>
      </div>
    </nav>
    <!-- Closing Navbar -->
    

    <!-- Button and Table -->
    <section id="button-table" class="p-5">
      <div class="container">
        <div class="row g-4">
          <div class="col">
            <!-- mobil1 -->
            <div class="row pt-5">
              <div class="card bg-primary">
                <div class="card-body">
                  <p class="card-text fw-bold">Mobil 1</p>
                </div>
              </div>
            </div>

            <!-- Mobil2 -->
            <div class="row pt-1">
              <div class="card bg-success">
                <div class="card-body">
                  <p class="card-text fw-bold">Mobil 2</p>
                </div>
              </div>
            </div>
            
            <div class="row py-1">
              <!-- <a href="tambah.php?user_id=<?= $idOrangLogin; ?>" type="button" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i> Add</a> -->
            </div>
            <div class="row py-1">
              <a href="3_halaman-grafik.php?user_id=<?= $idOrangLogin; ?>" type="button" class="btn btn-warning"><i class="bi bi-file-bar-graph-fill"></i> Graph</a>
            </div>
            <div class="row py-1">
              <button type="button" class="btn btn-info" disabled>Export</button>
            </div>
            <div class="row py-1">
              <a href="logout.php" type="button" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> Logout</a>
            </div>

            
          </div>

          <div class="col-md-10">
            <table class="table table-bordered">
              <thead class="table-dark">
                <tr class="text-center">
                  <th scope="col">No</th>
                  <th scope="col">On</th>
                  <th scope="col">Off</th>
                  <th scope="col">Ack by</th>
                  <th scope="col">Reason</th>
                  <th scope="col">Edit</th>
                </tr>
              </thead>

              <?php if(empty($dataKejadian)) : ?>
                <tr>
                    <td colspan="6"><p>Data Not Found</p></td>
                </tr>
              <?php endif; ?>

              <tbody>
                <?php $i = 1;
                 foreach($dataKejadian as $datKej) :  ?>

                <tr>
                  <th scope="row"> <?=  $i++; ?> </th>
                  <td> <?= $datKej['E_ON']; ?> </td>
                  <td> <?= $datKej['E_OF']; ?> </td>
                  <td>Act: <?= $datKej['E_ACT']; ?> 
                     <br>Dis: <?= $datKej['E_DIST']; ?> 
                  <td> <?= $datKej['E_REASON']; ?></td>
                  <td class="text-center">
                      <a href="#"><i class="bi bi-pencil-square"></i></a> 
                      <a href="#" ><i class="bi bi-trash-fill"></i></a> 
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- Closing BUtton and Table -->

    <!-- Bootstrap bundle -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
