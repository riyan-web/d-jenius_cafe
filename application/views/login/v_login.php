<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login admin</title>
    <!-- Core CSS - Include with every page -->
    <link href="<?= base_url('public/css/login/bootstrap.css')?>" rel="stylesheet" />
    <link href="<?= base_url('public/css/login/font-awesome.css')?>" rel="stylesheet" />
    <link href="<?= base_url('public/css/login//pace-theme-big-counter.css')?>" rel="stylesheet" />
   <link href="<?= base_url('public/css/login/style.css')?>" rel="stylesheet" />
      <link href="<?= base_url('public/css/login/main-style.css')?>" rel="stylesheet" />

</head>
<body background="<?= base_url('public/img/logo_cafe_3.jpeg')?>" >
    <div class="container-left">
        <div class="row">
            <div class="col-md-3">
                <div class="login-panel panel panel-success">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                        <?php if( isset($error)): ?>
            <p style="color:red; font-style: italic;">username / password salah</p>
            <?php endif; ?>
                    </div>
                    <div class="panel-body">
                    <form action="" method="post">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="nama_admin" type="text" autocomplete="off"autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" >
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-success btn-block" type="submit " name="login">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="<?= base_url('public/css/login//jquery-1.10.2.js')?>"></script>
    <script src="<?= base_url('public/css/login/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('public/css/login/jquery.metisMenu.js')?>"></script>

</body>

</html>
