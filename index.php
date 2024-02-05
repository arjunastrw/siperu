<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIPERU</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Latest Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Latest Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="app/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>SIPERU</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg" style="font-weight: normal;">Silahkan Input Username dan Password</p>

        <form action="conf/autentikasi.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name='username'>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name='password'>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="col-4 mx-auto">
            <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="app/plugins/jquery/jquery.min.js"></script>
  <!-- Latest Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="app/dist/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="app/plugins/sweetalert2/sweetalert2.min.js"></script>

  <?php
  if (isset($_GET['error'])) {
    $x = (int)$_GET['error'];

    if ($x == 1) {
      echo "
        <script>
          var Toast = Swal.mixin({
            toast: true,
            position: 'center-top',
            showConfirmButton: false,
            timer: 3000
          });
          Toast.fire({
            icon: 'error',
            title: 'Login Gagal'
          });
        </script>";
    } elseif ($x == 2) {
      echo "
        <script>
          var Toast = Swal.mixin({
            toast: true,
            position: 'center-top',
            showConfirmButton: false,
            timer: 3000
          });
          Toast.fire({
            icon: 'warning',
            title: 'Silahkan Inputkan Username & Password'
          });
        </script>";
    }
  }
?>

</body>
</html>