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
                    <h1>Data Lokasi</h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

<?php
  $query = "SELECT * from hrm_kebun WHERE status = 'Y'";
  $execQuery = mysqli_query($conn, $query);
?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-plus-square"></i> Tambah Lokasi
                      </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Kebun</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($execQuery)){
                      $id_lokasi = $data['id'];
                      $lokasi = $data['nama_kebun'];
                      
                    ?>
                      <tr>
                      <td><?=$id_lokasi?></td>
                      <td><?=$lokasi?></td>
                      <td class="center">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?=$id_lokasi?>"><i class = "far fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id_lokasi ;?>"><i class = "far fa-trash-alt"></i></button>
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
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Lokasi</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/lokasi/proses.php?act=insert" method="post">
        
                
                <label>Nama Lokasi</label>
                  <input type="text" name="lokasi" placeholder="Nama Lokasi" class="form-control" required>
                
                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addLokasi" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>

<!-- Edit Modal -->
<?php
  $execQuery = mysqli_query($conn, "SELECT * FROM hrm_kebun");
  while ($data = mysqli_fetch_array($execQuery)) {
    $id = $data['id'];
    $lokasi = $data ['nama_kebun'];
?>
<div class="modal fade" id="edit<?=$id_jasa;?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Jasa</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/master/jasa/proses.php?act=edit" method="post">
                <input type="hidden" name="id" value="<?=$id;?>">
                <label>Nama Lokasi</label>
                <input type="text" name="namajasa" value="<?=$jasa;?>" class="form-control" >
                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="editjasa" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>
<!-- Delete Modal -->
<div class="modal fade" id="delete<?=$id_jasa;?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Hapus Jasa</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              Apakah anda ingin menghapus jasa?
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <form action="modules/master/jasa/proses.php?act=delete" method="post">
            <input type="hidden" name="id_jasa" value="<?=$id_jasa;?>">
            <button type="submit" class="btn btn-primary" name="deletejasa">Yes</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </form> 
        </div>
      </div>
    </div>
  </div>
<?php
  }mysqli_close($conn);
?>