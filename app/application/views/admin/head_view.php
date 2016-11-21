<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Viet Vang JSC">
  <link rel="shortcut icon" href="<?php echo base_url(FOLDER_ADMIN."/images/favicon.ico"); ?>" type="image/png">

  <title><?php echo (isset($title)) ? $title : "Admin"; ?></title>
  <!-- Custom CSS -->
  <?php 
    echo (isset($p_css_view)) ? $p_css_view : "";
  ?>

  <link href="<?php echo base_url(FOLDER_ADMIN_CSS."/style.css"); ?>" rel="stylesheet">
  <link href="<?php echo base_url(FOLDER_ADMIN_CSS."/style-responsive.css"); ?>" rel="stylesheet">  
    
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>