<?php
function koneksi(){
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "dataTable");
    return $conn;
}

function query($sql){
    $conn = koneksi();
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $conn = koneksi();
  $nama = $_POST['nama'];
  $nis = $_POST['nis'];
  $ipa = $_POST['ipa'];
  $ips = $_POST['ips'];
  $mtk = $_POST['mtk'];
  $agama = $_POST['agama'];
  $inggris = $_POST['inggris'];

  $avg = ($ipa + $ips + $mtk + $agama + $inggris) / 5;
$query = "INSERT INTO siswa (nama, nis, ipa, ips, mtk, agama, inggris, avg) 
              VALUES ('$nama', '$nis', '$ipa', '$ips', '$mtk', '$agama', '$inggris','$avg')";
                if (mysqli_query($conn, $query)) {
                  echo "<script>alert('Data berhasil disimpan');</script>";
              } else {
                  echo "<script>alert('Gagal menyimpan data');</script>";
              }
}


$mahasiswa = query("SELECT * FROM siswa");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css"
    />
  </head>
  <body>
    <div class="container p-5">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Tambah Data Siswa
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Isi Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
        <div class="form-group">
    <label for="exampleInputNama">Nama</label>
    <input type="text" class="form-control" id="exampleInputNama" aria-describedby="emailHelp" placeholder="Enter name" name="nama">
  </div>
        <div class="form-group">
    <label for="exampleInputNis">NIS</label>
    <input type="text" class="form-control" id="exampleInputNis" aria-describedby="emailHelp" placeholder="Enter NIS" name="nis">
  </div>
        <div class="form-group">
    <label for="exampleInputNama">IPA</label>
    <input type="text" class="form-control" id="exampleInputNama" aria-describedby="emailHelp" placeholder="Enter nilai" name="ipa">
  </div>
        <div class="form-group">
    <label for="exampleInputIps">IPS</label>
    <input type="text" class="form-control" id="exampleInputIps" aria-describedby="emailHelp" placeholder="Enter nilai" name="ips">
  </div>
        <div class="form-group">
    <label for="exampleInputMtk">MTK</label>
    <input type="text" class="form-control" id="exampleInputMtk" aria-describedby="emailHelp" placeholder="Enter nilai" name="mtk">
  </div>
        <div class="form-group">
    <label for="exampleInputAgama">AGAMA</label>
    <input type="text" class="form-control" id="exampleInputAgama" aria-describedby="emailHelp" placeholder="Enter nilai" name="agama">
  </div>
        <div class="form-group">
    <label for="exampleInputInggris">INGGRIS</label>
    <input type="text" class="form-control" id="exampleInputInggris" aria-describedby="emailHelp" placeholder="Enter nilai" name="inggris"> 
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
  </form>
      </div>
    </div>
  </div>
</div>
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">nama</th>
          <th scope="col">nis</th>
          <th scope="col">ipa</th>
          <th scope="col">ips</th>
          <th scope="col">mtk</th>
          <th scope="col">agama</th>
          <th scope="col">inggris</th>
          <th scope="col">Rata-rata</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1?>
        <?php foreach ($mahasiswa as $mhs) : ?>
        <tr>
          <th scope="row"><?= $i++; ?></th>
          <td><?= $mhs['nama'];?></td>
          <td><?= $mhs['nis'];?></td>
          <td><?= $mhs['ipa'];?></td>
          <td><?= $mhs['ips'];?></td>
          <td><?= $mhs['mtk'];?></td>
          <td><?= $mhs['agama'];?></td>
          <td><?= $mhs['inggris'];?></td>
          <td><?= $mhs['avg'];?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script
      src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    <script>
      let table = new DataTable("#myTable");
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>
