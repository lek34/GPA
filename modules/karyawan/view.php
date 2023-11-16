<section class="content-header">
      <div class="container-fluid">
      <?php
        if (isset($_GET['alert'])) {
          $alert =  $_GET['alert'];
          switchAlert($alert);
          }
?>
        <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Data Karyawan</h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

<?php
  $query = "SELECT hl.nama_kebun as lokasi , hj.jabatan as jabatan, hu.unit as unit , hk.id, hk.nik , hk.nama , hk.jk , hk.tahun FROM hrm_karyawan hk
            INNER JOIN hrm_jabatan hj ON hk.jabatan = hj.id
            INNER JOIN hrm_unit hu ON hk.unit = hu.id
            INNER JOIN hrm_kebun hl ON hk.lokasi = hl.id
            WHERE hk.status = 'Y';";
  $execQuery = mysqli_query($conn, $query)
               or die('Ada kesalahan pada query tampil data user: '.mysqli_error($conn));;
?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-plus-square"></i> Tambah Karyawan
                      </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="center">No.</th>
                    <th class="center">Nik</th>
                    <th class="center">Nama</th>
                    <th class="center">JK</th>
                    <th class="center">Unit</th>
                    <th class="center">Jabatan</th>
                    <th class="center">Lokasi</th>
                    <th class="center">TMK</th>
                    <th class="center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($execQuery)){
                      $id_karyawan = $data['id'];
                      $nik  = $data['nik'];
                      $nama = $data['nama'];
                      $jk = $data['jk'];
                      $unit = $data['unit'];
                      $jabatan = $data['jabatan'];
                      $lokasi = $data['lokasi'];
                      $tahun = $data['tahun'];
                    ?>
                      <tr>
                        <td><?=$id_karyawan;?></td>
                        <td><?=$nik?></td>
                        <td><?=$nama?></td>
                        <td><?=$jk?></td>
                        <td><?=$unit?></td>
                        <td><?=$jabatan?></td>
                        <td><?=$lokasi?></td>
                        <td><?=$tahun?></td>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?=$id_karyawan;?>"><i class = "far fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id_karyawan;?>"><i class = "far fa-trash-alt"></i></button>
                      </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Karyawan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/karyawan/proses.php?act=insert" method="post" enctype="multipart/form-data">
                <label>NIK</label>
                <input type="text" name="nik" placeholder="NIK" class="form-control" required>
                <br>
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Nama" class="form-control" required>
                <br>
                <label>Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" placeholder="JK" required>
                  <option value="">---Pilih---</option> 
                  <option value="Pria">Pria</option> 
                  <option value="Perempuan">Perempuan</option> 
                </select>
                <br>
                <label>Unit</label>
                <select name="unit" class="form-control">
                        <?php
                        $pilihanunit = mysqli_query($conn, "SELECT * from hrm_unit where status = 'Y'");
                        while ($fetcharray = mysqli_fetch_array($pilihanunit)) {
                          $unit = $fetcharray['unit'];
                          $id = $fetcharray['id'];
                          ?>
                          <option value="<?= $id;?>">
                            <?= $unit; ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                      <br>
                <label>Jabatan</label>
                <select name="jabatan" class="form-control">
                        <?php
                        $pilihanjabatan = mysqli_query($conn, "SELECT * from hrm_jabatan where status = 'Y'");
                        while ($fetcharray = mysqli_fetch_array($pilihanjabatan)) {
                          $jabatan = $fetcharray['jabatan'];
                          $id = $fetcharray['id'];
                          ?>
                          <option value="<?= $id;?>">
                            <?= $jabatan; ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                      <br>
                <label>Lokasi</label>
                <select name="lokasi" class="form-control">
                        <?php
                        $pilihanlokasi = mysqli_query($conn, "SELECT * from hrm_kebun where status = 'Y'");
                        while ($fetcharray = mysqli_fetch_array($pilihanlokasi)) {
                          $lokasi = $fetcharray['nama_kebun'];
                          $id = $fetcharray['id'];
                          ?>
                          <option value="<?= $id;?>">
                            <?= $lokasi; ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                      <br>
                <label>Tahun</label>
                <input type="text" name="tahun" placeholder="Tahun" class="form-control" required>
                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addKaryawan" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div><!-- Modal Close -->
  
  
    <!-- The Modal -->
    <div class="modal fade" id="edit<?=$id_supplier;?>">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/user/proses.php?act=insert" method="post">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" class="form-control" required>
                <br>
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
                <br>
                <label>Nama User</label>
                <input type="text" name="nama_user" placeholder="User" class="form-control" required>
                <br>
                <label>Hak Akses</label>
                <select class="form-control" name="hakakses" placeholder="Hak Akses" required>
                  <option value="Super Admin">Super Admin</option> 
                  <option value="User">User</option> 
                </select>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addUser" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div><!-- Modal Close -->