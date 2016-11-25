<?php	
extract($_POST);	
if(isset($login)){
	$dat=mysql_fetch_assoc(mysql_query("SELECT * FROM USER WHERE USN='$usn' AND PWD='$pwd' AND STATUS=1"));
	if(!empty($dat['ID'])){
		$_SESSION['LOGGED']=$dat['ID'];
		echo "<script>document.location='./'</script>";
	}else{
		echo "<font color==red>Login Gagal !</font>";
	}
}
?>
<link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
	<h2>INTEGRATED DATA SERVICE</h2>
	<img src="../data/logos2.png" height="20%" width="30%">
	<h3>SMA NEGERI 2 MALANG</h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="usn" name="usn" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="submit" value="Sign in" class="btn btn-success btn-block btn-flat" name="login">
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
