<?php
include 'koneksi.php';
$db = new database();
?>
<?php
    foreach($db->edit($_GET['nim']) as $data){    
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title align="center">CRUD OOP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="container mt-4">
    <h3 align="center">Edit Data Mahasiswa</h3>
    <form action="proses.php?aksi=update" method="post">
        <table>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" name="nim" style="width:500px;" value="<?php echo $data['nim']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" style="width:500px;" value="<?php echo $data['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" style="width:500px;" value="<?php echo $data['alamat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control" name="telepon" style="width:500px;" value="<?php echo $data['telepon']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </table>
        <?php } ?>
    </form>
</div>
</body>
</html>
