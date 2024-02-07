<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Event</h3>
                        <div class="float-right">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- <a href="index.php?page=tambah-data" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a> -->
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Tanggal & Waktu Mulai</th>
                                    <th>Tanggal & Waktu Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                $query = mysqli_query($koneksi, "SELECT * FROM events");
                                while ($pjm = mysqli_fetch_array($query)) {
                                    $no++
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $pjm['title']; ?></td>
                                        <td><?php echo $pjm['description']; ?></td>
                                        <td>
                                            <?php
                                            $mulaiTimestamp = strtotime($pjm['start_date']);
                                            echo date('d-m-Y H:i', $mulaiTimestamp);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $selesaiTimestamp = strtotime($pjm['end_date']);
                                            echo date('d-m-Y H:i', $selesaiTimestamp);
                                            ?>
                                        </td>
                                        <!-- <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cog"></i> Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="index.php?page=edit-data-event&&id=<?php echo $pjm['id']; ?>" class="dropdown-item text-primary">
                                                        <i class="fas fa-edit" style="color: blue;"></i> Edit
                                                    </a>
                                                    <a href="action_event/hapus_data.php?id=<?php echo $pjm['id']; ?>" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash-alt" style="color: red;"></i> Hapus
                                                    </a>
                                                </div>
                                        </td> -->
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

<!-- <?php
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
        ?> -->

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