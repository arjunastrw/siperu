<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Peminjaman Ruangan</h3>
            <div class="float-right">
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <a href="index.php?page=tambah-data" class="btn btn-primary">
              <i class="fas fa-plus"></i> Tambah Data
            </a>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Gedung</th>
                  <th>Ruangan</th>
                  <th>Keperluan</th>
                  <th>Tanggal & Waktu Mulai</th>
                  <th>Tanggal & Waktu Selesai</th>
                  <th>Nama</th>
                  <th>Lampiran</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman_admin");
                while ($pjm = mysqli_fetch_array($query)) {
                  $no++
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $pjm['gedung']; ?></td>
                    <td><?php echo $pjm['ruangan']; ?></td>
                    <td><?php echo $pjm['keperluan']; ?></td>
                    <td>
                      <?php
                        $mulaiTimestamp = strtotime($pjm['tanggalwaktu_mulai']);
                        echo date('d-m-Y H:i', $mulaiTimestamp);
                      ?>
                    </td>
                    <td>
                      <?php
                        $selesaiTimestamp = strtotime($pjm['tanggalwaktu_selesai']);
                        echo date('d-m-Y H:i', $selesaiTimestamp);
                      ?>
                    </td>
                    <td><?php echo $pjm['nama']; ?></td>
                    <td>
                      <?php if (!empty($pjm['lampiran'])) : ?>
                        <?php
                          $fileExtension = pathinfo($pjm['lampiran'], PATHINFO_EXTENSION);
                          $fileIcon = getFileIcon($fileExtension);
                        ?>
                        <a href="lampiran/<?php echo $pjm['lampiran']; ?>" target="_blank">
                          <i class="<?php echo $fileIcon; ?>"></i>
                        </a>
                      <?php else : ?>
                        No File
                      <?php endif; ?>
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-cog"></i> Action
                        </button>
                        <div class="dropdown-menu">
                          <a href="index.php?page=edit-data&&id=<?php echo $pjm['id']; ?>" class="dropdown-item text-primary">
                            <i class="fas fa-edit" style="color: blue;"></i> Edit
                          </a>
                          <a href="actions/hapus_data.php?id=<?php echo $pjm['id']; ?>" class="dropdown-item text-danger">
                            <i class="fas fa-trash-alt" style="color: red;"></i> Hapus
                          </a>
                          <a href="actions/setujui_data.php?id=<?php echo $pjm['id']; ?>" class="dropdown-item text-primary">
                            <i class="fas fa-check" style="color: green;"></i> Setujui
                          </a>
                          <a href="actions/tolak_data.php?id=<?php echo $pjm['id']; ?>" class="dropdown-item text-primary">
                            <i class="fas fa-times" style="color: red;"></i> Tolak
                          </a>
                        </div>
                    </td>
                  </tr>
                <?php } ?>
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
  </div>
  <!-- /.container-fluid -->
</section>

<?php
function getFileIcon($fileExtension)
{
    switch ($fileExtension) {
        case 'pdf':
            return 'far fa-file-pdf';
        case 'doc':
        case 'docx':
            return 'far fa-file-word';
        case 'xls':
        case 'xlsx':
            return 'far fa-file-excel';
        case 'jpg':
        case 'jpeg':
        case 'png':
            return 'far fa-file-image';
        default:
            return 'far fa-file';
    }
}
?>

<script>
$(document).ready(function(){
    // Initialize DateTimePicker for input tanggal mulai
    $('#reservationdatetimeStart').datetimepicker({
        format: 'DD-MM-YYYY HH:mm',
        useCurrent: false
    }).on('focus', function() {
        // Change format when focused
        $(this).datetimepicker('format', 'MM/DD/YYYY hh:mm A');
    }).on('blur', function() {
        // Revert format when blurred
        $(this).datetimepicker('format', 'DD-MM-YYYY HH:mm');
    });

    // Initialize DateTimePicker for input tanggal selesai
    $('#reservationdatetimeEnd').datetimepicker({
        format: 'DD-MM-YYYY HH:mm',
        useCurrent: false
    }).on('focus', function() {
        // Change format when focused
        $(this).datetimepicker('format', 'MM/DD/YYYY hh:mm A');
    }).on('blur', function() {
        // Revert format when blurred
        $(this).datetimepicker('format', 'DD-MM-YYYY HH:mm');
    });
});
</script>
