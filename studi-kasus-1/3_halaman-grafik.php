<?php 
session_start();

if(!isset($_SESSION['login'])) {
  header("Location: 1_halaman1-login.php");
  exit;
}
require 'functions.php';

//jika URL tidak mengandung Userid
if( !isset($_GET['user_id']) ) {
  header("Location: 1_halaman1-login.php");
  exit;
}

//ambil id dari URL
$idLogin = $_GET['user_id'];

$yangLogin = query("SELECT * FROM user WHERE user_id = $idLogin");

$con = mysqli_connect("localhost","root","","pweb_1");
    //Inisialisasi nilai variabel awal
    $nama_reason= "";
    $jumlah=null;
    //Query SQL
    $sql="select E_REASON,COUNT(*) as 'total' from event GROUP by E_REASON";
    $hasil=mysqli_query($con,$sql);

    while ($data = mysqli_fetch_array($hasil)) {
       
        $E_R=$data['E_REASON'];
        $E_REASON.= "'$E_R'". ", ";
        $jum=$data['total'];
        $jumlah .= "$jum". ", ";

    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman 3 Grafik</title>

    <!-- chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- bootstrap icon -->
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
            <a href="">
            </a>
          </div>
        </div>
      </div>
    </nav>
    <!-- Closing Navbar -->

    <!-- Container Chart -->
    <div class="container">
      <canvas id="myChart"></canvas>
    </div>

    <div class="container my-5">
    <a href="2_halaman-tabel.php?user_id=<?= $idLogin; ?>" type="button" class="btn btn-warning"><i class="bi bi-table"></i> Table</a>
    <a href="logout.php" type="button" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </div>

    <script>
      let myChart = document.getElementById("myChart").getContext("2d");

      let massPopChart = new Chart(myChart, {
        type: "bar",
        data: {
          // labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16"],
          labels: [ <?php echo $E_REASON; ?> ],
          datasets: [
            {
              label: "Trend of Reason",
              data: [<?php echo $jumlah; ?>],          
              backgroundColor: "green",
            },
          ],
        },
        options: {},
      });
    </script>

    <!-- Bootstrap bundle -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
