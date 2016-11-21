<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Photo - Contest</title>
		<meta name="viewport" content="width=980">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta property="og:title" content="Title">
		<meta property="og:description" content="Descr">
		<meta property="og:image" content="<?php echo base_url('styles/images/404-error.png'); ?>">
		<meta property="og:url" content="notyet">
		<meta property="og:type" content="notyet">
		<link href="<?php echo base_url('assets/styles/base.css'); ?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('assets/scripts/vendor/colorbox/colorbox.css'); ?>" />
		<!--[if lte IE 8]>
		<script src="<?php echo base_url("/assets/scripts/html5shiv-printshiv.js") ; ?> "></script>
		<![endif]-->
		<script src="<?php echo base_url('assets/scripts/jquery-1.11.1.min.js');?>"></script>
		<script src="<?php echo base_url('assets/scripts/vendor/colorbox/jquery.colorbox-min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/scripts/function.js');?>"></script>
		<link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon"/>
		<link rel="shortcut icon" href="" type="image/x-icon"/>
		<script src="<?php echo base_url('styles/js/vote-and-comment.js');?>"></script>
		
	</head>
	<body>
		<div class="wrapper-inner">
			<header id="ctn-header">
				<p id="box-logo">
					
					<?php echo '<a href="'.base_url().'"><img src="'.base_url('assets/images/fa_logo_white_text_16-9.png').'" /></a>'; ?>

				</p>
				<nav id="box-gnav">
					<ul>
						<li <?php echo (isset($active) && $active == 0) ? 'class="stay"' : '';?> ><a href="<?php echo base_url(); ?>">Gallery</a></li>
						<li <?php echo (isset($active) && $active == 1) ? 'class="stay"' : '';?> ><a href="<?php echo base_url('plans.html'); ?>">Plans</a></li>
						<li <?php echo (isset($active) && $active == 2) ? 'class="stay"' : '';?> ><a href="<?php echo base_url('howtouse.html'); ?>">How To Use</a></li>
					</ul>
				</nav>
				<?php if(isset($this->session->userdata[SESSION_USER_ID])){ ?>
				<p id="box-utility">
				<a href="<?php echo base_url('upload'); ?>" class="btn-user-info"><span class="user-avartar"><img src="<?php echo $this->session->userdata(SESSION_USER_AVATAR); ?>" alt=""></span> <?php echo $this->session->userdata(SESSION_USER_NAME); ?></a> 
				<a href="<?php echo base_url('user/logout'); ?>" class="">Sign Out</a>
				</p>
				<?php } else { ?>
				<p id="box-utility"><a href="<?php echo base_url('login.html'); ?>" class="btn-login iframe">Log in</a></p>
				<?php } ?>
			</header>