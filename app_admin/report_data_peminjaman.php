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
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                $query = mysqli_query($koneksi, "SELECT * FROM tb_report_peminjaman");
                while ($pjm = mysqli_fetch_array($query)) {
                  $no++
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $pjm['gedung']; ?></td>
                    <td><?php echo $pjm['ruangan']; ?></td>
                    <td><?php echo $pjm['keperluan']; ?></td>
                    <td><?php echo $pjm['tanggalwaktu_mulai']; ?></td>
                    <td><?php echo $pjm['tanggalwaktu_selesai']; ?></td>
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
