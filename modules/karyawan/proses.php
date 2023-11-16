
<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
require_once "../../auth/cek.php";
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
    if ($_GET['act']=='insert') {
        if (isset($_POST['addKaryawan'])){
            $nik = mysqli_real_escape_string($conn, trim($_POST['nik']));
            $nama  = mysqli_real_escape_string($conn, trim($_POST['nama']));
            $jenis_kelamin = mysqli_real_escape_string($conn, trim($_POST['jenis_kelamin']));
            $unit = mysqli_real_escape_string($conn, trim($_POST['unit']));
            $jabatan = mysqli_real_escape_string($conn, trim($_POST['jabatan']));
            $lokasi = mysqli_real_escape_string($conn, trim($_POST['lokasi']));
            $tahun = mysqli_real_escape_string($conn, trim($_POST['tahun']));
            
            $created_user = $_SESSION['id_user'];
           
            $query = "INSERT INTO hrm_karyawan (nik, nama, jk, unit, jabatan, lokasi, tahun, created_user) VALUES ('$nik', '$nama', '$jenis_kelamin','$unit','$jabatan','$lokasi','$tahun','$created_user')";
            $execQuery = mysqli_query($conn, $query)
            or die('Ada kesalahan pada query insert : '.mysqli_error($conn));   
            
                if ($execQuery){
                    header("location: ../../main.php?module=dataKaryawan&alert=1");
                }
        }
    }
    elseif ($_GET['act']=='edit') {
        if (isset($_POST['editUser'])){
            $id_sup = mysqli_real_escape_string($conn, trim($_POST['id_supplier']));
            $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
            $kontak  = mysqli_real_escape_string($conn, trim($_POST['kontak']));
            $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan']));
            $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat']));

            $query = "UPDATE supplier SET nama = '$nama', kontak = '$kontak', keterangan = '$keterangan', alamat = '$alamat' WHERE id_supplier = '$id_sup'";
            $execQuery = mysqli_query($conn, $query);

            if ($execQuery){
                header('location: ../../../main.php?module=dataSup');
            } else {
                echo
                "<script>
                alert ('Data gagal ditambahkan')
                </script>";
                header('location: ../../../main.php?module=dataSup');
            }
        }
        
    }
    elseif ($_GET['act']=='delete') {
        if (isset($_POST['delSup'])){
            $id_sup = mysqli_real_escape_string($conn, trim($_POST['id_supplier']));

            $query = "DELETE FROM supplier WHERE id_supplier = '$id_sup'";
            $execQuery = mysqli_query($conn, $query);

            if ($execQuery){
                header('location: ../../../main.php?module=dataSup');
            } else {
                echo
                "<script>
                alert ('Data gagal ditambahkan')
                </script>";
                header('location: ../../../main.php?module=dataSup');
            }
        }
    }
?>
