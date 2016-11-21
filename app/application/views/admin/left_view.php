<!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="<?php echo base_url("admin"); ?>"><img src="<?php echo base_url(FOLDER_ADMIN_IMG."/logo.png"); ?>" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="<?php echo base_url("admin"); ?>"><img src="<?php echo base_url(FOLDER_ADMIN_IMG."/logo_icon.png"); ?>" alt=""></a>
        </div>
        <!--logo and iconic logo end-->


        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="<?php echo base_url(FOLDER_ADMIN_IMG."/photos/user-avatar.png") ?>" class="media-object">
                    <div class="media-body">
                        <h4><a href="#">
                        <?php 
                            echo isset($p_account_name) ? $p_account_name : "Admistator";
                        ?></a></h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> <span>Go to homepage</span></a></li>
                <li <?php echo (isset($active) && $active == 0) ? 'class="active"' : ''; ?>><a href="<?php echo base_url("admin"); ?>"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
                <li <?php echo (isset($active) && $active == 1) ? 'class="active"' : ''; ?>><a href="<?php echo base_url("admin/setting"); ?>"><i class="fa fa-cogs"></i> <span>Setting</span></a></li>
                <li <?php echo (isset($active) && $active == 2) ? 'class="active"' : ''; ?>><a href="<?php echo base_url("admin/images"); ?>"><i class="fa fa-picture-o"></i> <span>Images list</span></a></li>
                <li <?php echo (isset($active) && $active == 3) ? 'class="active"' : ''; ?>><a href="<?php echo base_url("admin/contestants"); ?>"><i class="fa fa-user"></i> <span>Contestants</span></a></li>    
                <li><a href="<?php echo base_url("admin/logout"); ?>"><i class="fa fa-sign-in"></i> <span>Logout</span></a></li>

            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->