<?php
// Fetch the record to be edited
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_prepare($koneksi, "SELECT * FROM events WHERE id=?");
mysqli_stmt_bind_param($query, "s", $id);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
$view = mysqli_fetch_array($result);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Hidden input field for 'id'
  $id = mysqli_real_escape_string($koneksi, $_POST['id']);

  // Other form fields
  $title = mysqli_real_escape_string($koneksi, $_POST['title']);
  $description = mysqli_real_escape_string($koneksi, $_POST['description']);

  // Convert and validate tanggalwaktu_mulai
  $start_date_input = $_POST['start_date_input'];
  $start_date = date('Y-m-d H:i:s', strtotime($start_date));

  // Convert and validate tanggalwaktu_selesai
  $end_date_input = $_POST['end_date_input'];
  $end_date = date('Y-m-d H:i:s', strtotime($end_date));
} {
  // UPDATE query
  $query = "UPDATE events SET title='$title', description='$description', start_date='$start_date', end_date='$end_date', lampiran='$nama_file' WHERE id='$id'";

  // Execute the query
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Successful update
    header('Location: ../index.php?page=data-event');
    exit();
  } else {
    // Handle the error
    $error_message = "Error updating record: " . mysqli_error($koneksi);
    // Log the error to a file or database for further analysis
    // You can also redirect with an error message if needed
    header('Location: ../index.php?page=data-event&error=' . urlencode($error_message));
    exit();
  }
}
?>

<!-- Main Content -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Event</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form method="post" action="action_event/update_data.php" enctype="multipart/form-data">
          <!-- Hidden input field for 'id' -->
          <input type="hidden" name="id" value="<?php echo $view['id']; ?>">

          <div class="row">
            <div class="col-md-6">
              <!-- Form Bagian Kiri -->
              <div class="form-group">
                <label for="gedung">Gedung</label>
                <select class="custom-select" id="gedung" name='gedung'>
                  <option value="<?php echo $view['gedung']; ?>" selected><?php echo $view['gedung']; ?></option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D-Lab Sentral">D-Lab Sentral</option>
                  <option value="E Lab Skill">E Lab Skill</option>
                  <option value="F Dep Ilmu Keperawatan">F Dep Ilmu Keperawatan</option>
                  <option value="G Dep Gizi">G Dep Gizi</option>
                  <option value="H Ked Gigi & Farmasi">H Ked Gigi & Farmasi</option>
                  <option value="I Dep Spesialis">I Dep Spesialis</option>
                  <option value="J Teatrikal">J</option>
                </select>
              </div>
              <div class="form-group">
                <label for="ruangan">Ruangan</label>
                <select class="custom-select" id="ruangan" name='ruangan'>
                  <option value="<?php echo $view['ruangan']; ?>" selected><?php echo $view['ruangan']; ?></option>
                </select>
              </div>
              <div class="form-group">
                <label for="keperluan">Keperluan</label>
                <input type="text" class="form-control" placeholder="Keperluan" name='keperluan' value="<?php echo $view['keperluan']; ?>">
              </div>
              <div class="form-group">
                <label for="details">Details</label>
                <select class="custom-select" id="details" name='details'>
                  <option value="<?php echo $view['details']; ?>" selected><?php echo $view['details']; ?></option>
                  <option value="AC, LED, TV">AC, LED, TV</option>
                  <option value="AC, LCD">AC, LCD</option>
                  <option value="AC, LCD, Sound System">AC, LCD, Sound System</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggalwaktu_mulai">Tanggal & Waktu Mulai</label>
                <div class="input-group date" id="reservationdatetimeStart" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetimeStart" name='tanggalwaktu_mulai' value="<?php echo date('m/d/Y h:i A', strtotime($view['tanggalwaktu_mulai'])); ?>" />
                  <div class="input-group-append" data-target="#reservationdatetimeStart" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="far fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="tanggalwaktu_selesai">Tanggal & Waktu Selesai</label>
                <div class="input-group date" id="reservationdatetimeEnd" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetimeEnd" name='tanggalwaktu_selesai' value="<?php echo date('m/d/Y h:i A', strtotime($view['tanggalwaktu_selesai'])); ?>" />
                  <div class="input-group-append" data-target="#reservationdatetimeEnd" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="far fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="lampiran">Upload File</label>
                <input type="file" name='lampiran' class="form-control" id="lampiran" />
              </div>
            </div>
          </div>
          <div class="row">
            <?php if (!empty($view['lampiran'])) : ?>
              <div class="col-md-6">
                <a href="lampiran/<?php echo htmlspecialchars($view['lampiran']); ?>" target="_blank">
                  <img src="path/to/file-icon.png" alt="File Icon" width="100px">
                </a>
                <p><?php echo basename($view['lampiran']); ?></p>
              </div>
            <?php endif; ?>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</section>

<script>
  document.getElementById('gedung').addEventListener('change', function() {
    var gedungValue = this.value;
    var ruanganDropdown = document.getElementById('ruangan');

    // Empty room options first
    ruanganDropdown.innerHTML = '';

    // Add room options based on the selected building
    switch (gedungValue) {
      case 'A':
        ruanganDropdown.innerHTML = `
          <option value="A.106 - Ruang Studio - (50)">A.106 - Ruang Studio - (50)</option>
          <option value="A.110 - (10)">A.110 - (10)</option>
          <option value="A.112 - (10)">A.112 - (10)</option>
          <option value="A.113 - (50)">A.113 - (50)</option>
          <option value="A.205 - R. Rapat Dekan - (20)">A.205 - R. Rapat Dekan - (20)</option>
          <option value="A.206 - R. Sidang 2 - (15)">A.206 - R. Sidang 2 - (15)</option>
          <option value="A.207 - R. Sidang 3 - (15)">A.207 - R. Sidang 3 - (15)</option>
          <option value="A.216 - R. Sidang Senat - (50)">A.216 - R. Sidang Senat - (50)</option>
          <option value="A.217 - R. Sidang 1 - (50)">A.217 - R. Sidang 1 - (50)</option>
          <option value="A.303 - R. Serba Guna - (300)">A.303 - R. Serba Guna - (300)</option>
          <option value="A.307 - (50)">A.307 - (50)</option>
          <option value="A.308 - (10)">A.308 - (10)</option>
          <option value="A.309 - R. Konsultasi - (10)">A.309 - R. Konsultasi - (10)</option>
          <option value="A.312 - (10)">A.312 - (10)</option>
          <option value="A.314 - (10)">A.314 - (10)</option>
          <option value="A.315 - (10)">A.315 - (10)</option>
          <option value="A.316 - (50)">A.316 - (50)</option>
          <option value="A. Job List IT">A. Job List IT</option>
        `;
        break;
      case 'B':
        ruanganDropdown.innerHTML = `
          <option value="B.101 - BBDM 11 - (12)">B.101 - BBDM 11 - (12)</option>
          <option value="B.102 - BBDM 10 - (12)">B.102 - BBDM 10 - (12)</option>
          <option value="B.103 - BBDM 09 - (12)">B.103 - BBDM 09 - (12)</option>
          <option value="B.104 - BBDM 08 - (12)">B.104 - BBDM 08 - (12)</option>
          <option value="B.105 - BBDM 07 - (12)">B.105 - BBDM 07 - (12)</option>
          <option value="B.106 - BBDM 06 - (12)">B.106 - BBDM 06 - (12)</option>
          <option value="B.108 - BBDM 05 - (12)">B.108 - BBDM 05 - (12)</option>
          <option value="B.109 - BBDM 04 - (12)">B.109 - BBDM 04 - (12)</option>
          <option value="B.110 - BBDM 03 - (12)">B.110 - BBDM 03 - (12)</option>
          <option value="B.111 - BBDM 02 - (12)">B.111 - BBDM 02 - (12)</option>
          <option value="B.112 - BBDM 01 - (12)">B.112 - BBDM 01 - (12)</option>
          <option value="B.113 - Teatrikal - (200)">B.113 - Teatrikal - (200)</option>
          <option value="B.114 - (200)">B.114 - (200)</option>
          <option value="B.116 - (120)">B.116 - (120)</option>
          <option value="B.117 - (120)">B.117 - (120)</option>
          <option value="B.201 - (120)">B.201 - (120)</option>
          <option value="B.202 - (120)">B.202 - (120)</option>
          <option value="B.205 - BBDM 23 - (120)">B.205 - BBDM 23 - (120)</option>
          <option value="B.206 - (120)">B.206 - (120)</option>
          <option value="B.207 - (120)">B.207 - (120)</option>
          <option value="B.208 - (120)">B.208 - (120)</option>
          <option value="B.209 - (120)">B.209 - (120)</option>
          <option value="B.210 - (70)">B.210 - (70)</option>
          <option value="B.211 - (70)">B.211 - (70)</option>
          <option value="B.212 - Smart Class - (100)">B.212 - Smart Class - (100)</option>
          <option value="B.213 - (120)">B.213 - (120)</option>
          <option value="B.301 - BBDM 22 - (12)">B.301 - BBDM 22 - (12)</option>
          <option value="B.302 - BBDM 21 - (12)">B.302 - BBDM 21 - (12)</option>
          <option value="B.303 - BBDM 20 - (12)">B.303 - BBDM 20 - (12)</option>
          <option value="B.304 - BBDM 19 - (12)">B.304 - BBDM 19 - (12)</option>
          <option value="B.305 - BBDM 18 - (12)">B.305 - BBDM 18 - (12)</option>
          <option value="B.307 - BBDM 17 - (12)">B.307 - BBDM 17 - (12)</option>
          <option value="B.308 - BBDM 16 - (12)">B.308 - BBDM 16 - (12)</option>
          <option value="B.309 - BBDM 15 - (12)">B.309 - BBDM 15 - (12)</option>
          <option value="B.310 - BBDM 14 - (12)">B.310 - BBDM 14 - (12)</option>
          <option value="B.311 - BBDM 13 - (12)">B.311 - BBDM 13 - (12)</option>
          <option value="B.312 - BBDM 12 - (12)">B.312 - BBDM 12 - (12)</option>
          <option value="B.313 - (100)">B.313 - (100)</option>
          <option value="B.314 - (120)">B.314 - (120)</option>
          <option value="B.315 - Lab. Komputer 1 - (150)">B.315 - Lab. Komputer 1 - (150)</option>
          <option value="B.317 - Lab. Komputer 2 - (70)">B.317 - Lab. Komputer 2 - (70)</option>
          <option value="B.318 - Lab. Komputer 3 - (70)">B.318 - Lab. Komputer 3 - (70)</option>
        `;
        break;
      case 'C':
        ruanganDropdown.innerHTML = `
          <option value="C.205 - BBDM 24 - (15)">C.205 - BBDM 24 - (15)</option>
          <option value="C.201 - (15)">C.201 - (15)</option>
          <option value="C.202 - (15)">C.202 - (15)</option>
          <option value="C.203 - (15)">C.203 - (15)</option>
          <option value="C.204 - (15)">C.204 - (15)</option>
          <option value="C.206 - BBDM 25 - (15)">C.206 - BBDM 25 - (15)</option>
          <option value="C.207 - (15)">C.207 - (15)</option>
          <option value="C.208 - (15)">C.208 - (15)</option>
          <option value="C.209 - (15)">C.209 - (15)</option>
          <option value="C.210 - (15)">C.210 - (15)</option>
        `;
        break;
      case 'D-Lab Sentral':
        ruanganDropdown.innerHTML = `
          <option value="Aula Lt.5 - (200)">Aula Lt.5 - (200)</option>
          <option value="Ruang Rapat Kaca Lt.1 - (50)">Ruang Rapat Kaca Lt.1 - (50)</option>        `;
        break;
      case 'E Lab Skill':
        ruanganDropdown.innerHTML = `
          <option value="E.202 - (20)">E.202 - (20)</option>
          <option value="E.203 - (20)">E.203 - (20)</option>
          <option value="E.204 - (20)">E.204 - (20)</option>
          <option value="E.205 - (20)">E.205 - (20)</option>
          <option value="E.206 - (20)">E.206 - (20)</option>
          <option value="E.207 - (20)">E.207 - (20)</option>
          <option value="E.208 - (20)">E.208 - (20)</option>
          <option value="E.209 - (20)">E.209 - (20)</option>
          <option value="E.210 - (20)">E.210 - (20)</option>
          <option value="E.211 - (20)">E.211 - (20)</option>
          <option value="E.212 - (20)">E.212 - (20)</option>
          <option value="E.213 - (100)">E.213 - (100)</option>
          <option value="E.302 - (20)">E.302 - (20)</option>
          <option value="E.303 - (20)">E.303 - (20)</option>
          <option value="E.304 - (20)">E.304 - (20)</option>
          <option value="E.305 - (20)">E.305 - (20)</option>
          <option value="E.306 - (20)">E.306 - (20)</option>
          <option value="E.307 - (20)">E.307 - (20)</option>
          <option value="E.308 - (20)">E.308 - (20)</option>
          <option value="E.309 - (20)">E.309 - (20)</option>
          <option value="E.310 - (20)">E.310 - (20)</option>
          <option value="E.311 - (20)">E.311 - (20)</option>
          <option value="E.312 - (20)">E.312 - (20)</option>
          <option value="E.313 - (20)">E.313 - (20)</option>
          <option value="E.401 - (20)">E.401 - (20)</option>
          <option value="E.402 - (20)">E.402 - (20)</option>
          <option value="E.503 - (50)">E.503 - (50)</option>
          <option value="E.504 - (50)">E.504 - (50)</option>
          <option value="E.505 - (50)">E.505 - (50)</option>
          <option value="E.509 - (60)">E.509 - (60)</option>
          <option value="E.510 - (60)">E.510 - (60)</option>
          <option value="E.511 - (60)">E.511 - (60)</option>
        `;
        break;
      case 'F Dep Ilmu Keperawatan':
        ruanganDropdown.innerHTML = `
          <option value="D.102 - (40)">D.102 - (40)</option>
          <option value="D.106 - (10)">D.106 - (10)</option>
          <option value="D.109 - (40)">D.109 - (40)</option>
          <option value="D.202 - (10)">D.202 - (10)</option>
          <option value="D.204 - (40)">D.204 - (40)</option>
          <option value="D.301 - (60)">D.301 - (60)</option>
          <option value="D.302 - (60)">D.302 - (60)</option>
          <option value="D.303 - (60)">D.303 - (60)</option>
          <option value="D.304 - (60)">D.304 - (60)</option>
          <option value="D.305 - (60)">D.305 - (60)</option>
          <option value="D.308 - (50)">D.308 - (50)</option>
        `;
        break;
      case 'G Dep Gizi':
        ruanganDropdown.innerHTML = `
          <option value="G.204">G.204</option>
          <option value="G.301">G.301</option>
          <option value="G.302">G.302</option>
          <option value="G.303">G.303</option>
          <option value="G.304">G.304</option>
          <option value="G.401">G.401</option>
          <option value="G.403">G.403</option>
          <option value="G.404">G.404</option>
          <option value="G.405">G.405</option>
          <option value="G.406">G.406</option>
          <option value="G.407">G.407</option>
          <option value="G.503">G.503</option>
          <option value="G.505">G.505</option>
          <option value="G.101">G.101</option>
          <option value="G.102">G.102</option>
          <option value="G.103">G.103</option>
          <option value="G.104">G.104</option>
          <option value="G.105">G.105</option>
        `;
        break;
      case 'H Ked Gigi & Farmasi':
        ruanganDropdown.innerHTML = `
          <option value="Aula H.308 - (100)">Aula H.308 - (100)</option>
          <option value="H.201 - (100)">H.201 - (100)</option>
          <option value="H.203 - (30)">H.203 - (30)</option>
          <option value="H.204 - (15)">H.204 - (15)</option>
          <option value="H.301 - (50)">H.301 - (50)</option>
          <option value="H.302 - (30)">H.302 - (30)</option>
          <option value="H.303 - (15)">H.303 - (15)</option>
          <option value="H.304 - (15)">H.304 - (15)</option>
          <option value="H.305 - (15)">H.305 - (15)</option>
          <option value="H.306 - (12)">H.306 - (12)</option>
          <option value="H.307 - (12)">H.307 - (12)</option>
        `;
        break;
      case 'I Dep Spesialis':
        ruanganDropdown.innerHTML = `
          <option value="Aula - (100)">Aula - (100)</option>
          <option value="Lapangan - (200)">Lapangan - (200)</option>
          <option value="Ruang 1 - (20)">Ruang 1 - (20)</option>
          <option value="Ruang 2 - (30)">Ruang 2 - (30)</option>
          <option value="Ruang 3 - (20)">Ruang 3 - (20)</option>
          <option value="Ruang 4 - (20)">Ruang 4 - (20)</option>
          <option value="Ruang 5 - (20)">Ruang 5 - (20)</option>
          <option value="Ruang 6 - Sidang 1 - (30)">Ruang 6 - Sidang 1 - (30)</option>
          <option value="Ruang 7 - Sidang 2 - (20)">Ruang 7 - Sidang 2 - (20)</option>
          <option value="Ruang 8 - Sidang 3 - (15)">Ruang 8 - Sidang 3 - (15)</option>
          <option value="Ruang 9 - Sidang 4 - (40)">Ruang 9 - Sidang 4 - (40)</option>
          <option value="Ruang P - (100)">Ruang P - (100)</option>
          <option value="Ruang Q - (100)">Ruang Q - (100)</option>
          <option value="Ruang R - (100)">Ruang R - (100)</option>
          <option value="Ruang S - (100)">Ruang S - (100)</option>

        `;
        break;
      case 'J Teatrikal':
        ruanganDropdown.innerHTML = `
          <option value="J.101 - (100)">J.101 - (100)</option>
        `;
        break;
        // Add cases for other buildings as needed
        // ...
      default:
        // Handle default case if needed
        break;
    }
  });
</script>

<script>
  $(document).ready(function() {
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

</body>

</html>