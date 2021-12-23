<!DOCTYPE HTML>
<html>
<head>
    <title>U-Bus | Batalkan Tiket</title>
<?php
    require 'koneksi.php';
    require 'components/header.php';
    $userID = $_SESSION['penggunaID'];
    if(empty($_SESSION['penggunaID']) || $_SESSION['penggunaID'] == ''){
    header("Location: index.php");
    die();
    }
?>
<style>
  body {
  /*  background-image: url("http://www.banggaberubah.com/assets/article_image/original/UMN_1.png");
    background-color: #cccccc;
    background-size: 100%; */
    background: rgb(43,159,220);
    background: radial-gradient(circle, rgba(43,159,220,1) 0%, rgba(0,179,237,1) 93%, rgba(0,212,255,1) 100%);
    font-family: 'Josefin Sans', sans-serif;
  }
</style>
</head>
  <body>
    <?php
    if (isset($_GET['alert'])) {
    echo '<script>myfunction()</script>';
    } ?>

      <div class="container">
      <div class="row">
      <div class="col-md col-sm-3 text-left mt-4">
          <h2>Batalkan Tiket</h2>
          </div>
          <div class="col-md col-sm-3 mt-4 text-right">
            <p><button type="button" class="btn btn-info" onclick=location.href='beranda.php'>< Kembali ke beranda</button> <p>
      </div>
      <?php
      require 'db-init.php';
      $userID = $_SESSION['penggunaID'];
      $sql1 = "SELECT * FROM tiket JOIN rute ON tiket.ruteID = rute.ruteID WHERE penggunaID = '$userID' ORDER BY tglBerangkat DESC;";
      $result1 = $koneksi->query($sql1);
      $numrows = mysqli_num_rows($result1);
      if ($numrows==0) {
        echo "<div class='container text-center' style='margin-top: 150px;'>
        <div class= 'col-md-8 col-lg align-self-center'>
        <center>
            <h2>Kamu tidak mempunyai tiket..</h2>
            <div class='col-md col-sm-3 mt-4 text-center'>
          <p>	<button type='button' class='btn btn-light' onclick=location.href='pesantiket.php'>Pesan Tiket Dulu!</button> <p>
          </div>
            </center>
      </div>
          </div>";
        }
        else{
          echo'<table class="table">
              <thead>
                  <tr>
                      <th>BusID</th>
                      <th>Rute ID</th>
                      <th>Tanggal Berangkat</th>
                      <th>Asal</th>
                      <th>Tujuan</th>
                      <th>Waktu Tiba</th>
                      <th>Waktu Berangkat</th>
                      <th>noKursi</th>
                      <th>Batalkan</th>
                  </tr>
              </thead>
              <tbody>';
                    require 'db-init.php';
                    $userID = $_SESSION['penggunaID'];
                    $sql = "SELECT kategoriID FROM pengguna WHERE penggunaID='$userID';";
                    $result = $koneksi->query($sql);
                    $row = $result->fetch_assoc();
                    $userType = $row['kategoriID'];
                    $sql1 = "SELECT * FROM tiket JOIN rute ON tiket.ruteID = rute.ruteID WHERE penggunaID = '$userID' ORDER BY tglBerangkat DESC;";
                    $result1 = $koneksi->query($sql1);
                    while ($row = $result1->fetch_assoc()) {
                        echo '<tr>
                        <td>' . $row["busID"] . '</td>
                        <td>' . $row["ruteID"] . '</td>
                        <td>' . $row["tglBerangkat"] . '</td>
                        <td>' . $row["asal"] . '</td>
                        <td>' . $row["tujuan"] . '</td>
                        <td>' . $row["wktBerangkat"] . '</td>
                        <td>' . $row["wktTiba"] . '</td>
                        <td>' . $row["noKursi"] . '</td>
										<td><a href="batal-tiket.php?bis=' . $row["busID"] . '&seat=' . $row["noKursi"] . '" class="btn btn-danger  role="button" onclick="myFunction()" value="Show alert box">Batal</a></td>
						      </tr>';
                    }
                    }
                    ?>

              </tbody>
          </table>

  </body>
