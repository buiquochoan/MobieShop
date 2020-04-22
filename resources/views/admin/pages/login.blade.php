<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta charset="utf-8">
  <base href="{{ asset('') }}">
  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="assets/client/css/fontawesome-all.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" required="email" required="required" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Nhập địa chỉ email">
                    </div>
                    @if($errors->has('email'))
                    <div class="alert alert-danger">
                      {{ $errors->first('email') }}
                    </div>
                    @endif
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" required="required" id="exampleInputPassword" placeholder="Password">
                    </div>
                    @if($errors->has('password'))
                    <div class="alert alert-danger">
                      {{ $errors->first('password') }}
                    </div>
                    @endif
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Ghi nhớ </label>
                      </div>
                    </div>
                    <button name="btnLoginAdmin" class="btn btn-primary btn-user btn-block">
                      Đăng nhập
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Quên mật khẩu?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Tạo tài khoản mới!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/admin/js/sb-admin-2.min.js"></script>
  <script src="assets/client/js/sweetalert2.all.min.js"></script>
  @if(session()->has('ctSuccess'))
  <script type="text/javascript">
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: "{{session('ctMessage')}}",
      showConfirmButton: false,
      timer: 1500
    });
  </script>
  @endif
  @if(session()->has('ctErrorrs'))
  <script type="text/javascript">
    Swal.fire({
      position: 'top-end',
      icon: 'error',
      title: "{{session('ctMessage')}}",
      showConfirmButton: false,
      timer: 1500
    });
  </script>
  @endif
</body>

</html>
