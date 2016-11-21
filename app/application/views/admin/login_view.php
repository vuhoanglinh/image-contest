<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo base_url(FOLDER_ADMIN."/images/favicon.ico"); ?>" type="image/png">

  <title><?php echo (isset($title)) ? $title : "Admin"; ?></title>
      
  <link href="<?php echo base_url(FOLDER_ADMIN_CSS."/style.css"); ?>" rel="stylesheet">
  <link href="<?php echo base_url(FOLDER_ADMIN_CSS."/style-responsive.css"); ?>" rel="stylesheet">

  <!-- Custom CSS -->
  <?php 
    echo (isset($p_css_view)) ? $p_css_view : "";
  ?>
    
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="login-body">
  <div class="container">
    <?php 
      echo form_open(base_url("admin/logined"), array("class" => "form-signin", "id" => (isset($id_form) ? $id_form : "")));
    ?>
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Log In</h1>
            <img src="<?php echo base_url(FOLDER_ADMIN."/images/login-logo.png") ?>" alt=""/>
        </div>
        <div class="login-wrap">
            <input type="text" class="form-control" id="txt_account" name="txt_account" placeholder="Account / Email" autofocus required>
            <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Password" required>

            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>
            </button>
            <label id="msg" style="display:none;color:#FF6C60;text-align:center"><?php echo ($p_error == 1) ? $msg_error : ''; ?></label>
            <label class="checkbox">
                <!-- <input type="checkbox" name="rd_remember" value="remember-me"> Remember me -->
                <span class="pull-right">
                    <!--<a data-toggle="modal" href="#myModal"> Forgot Password?</a>-->
                </span>
            </label>

        </div>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter your e-mail address below to reset your password.</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                        <button class="btn btn-primary" type="button">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

    <?php 
      echo form_close();
    ?>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/jquery-1.10.2.min.js"); ?>"></script>
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/modernizr.min.js"); ?>"></script>

<!-- Custom JS -->
<?php 
    echo (isset($p_js_view)) ? $p_js_view : "";
?>
</body>
</html>