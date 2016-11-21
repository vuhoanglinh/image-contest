<!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

        <!--toggle button start-->
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <!--toggle button end-->
        
        <?php 
            echo isset($p_form_search) ? $p_form_search : "";
            echo isset($p_menu_right_account) ? $p_menu_right_account : "";
        ?>

        </div>
        <!-- header section end-->

        <!-- page heading start-->
        <div class="page-heading">
            <h3>Contestant</h3>
            
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo base_url("admin"); ?>">Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url("admin/contestants"); ?>">Contestant</a>
                </li>
                <li class="active"> <?php echo $p_users[DB_USERS_COL_NAME]; ?> </li>
            </ul>
        </div>

        <!-- body wrapper start -->
        <div class="wrapper">
            <div class="row">
                <!--Left -->
                <div class="col-md-4">
                    <div class="row">

                        <!-- Avatar -->
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body  text-center">
                                    <div class="profile-pic">
                                        <img alt="" src="<?php echo $p_users[DB_USERS_COL_AVATAR]; ?>" width="150">
                                    </div>
                                    <h2><?php echo $p_users[DB_USERS_COL_NAME]; ?></h2>
                                    <p><span class="label label-<?php echo ($p_users[DB_USERS_COL_IS_BAN] == USER_BANNED) ? "default" : "info"; ?>"><?php echo ($p_users[DB_USERS_COL_IS_BAN] == USER_BANNED) ? "Banned" : "Allowed"; ?></span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Avatar -->
                        
                        <!-- Infomation -->
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <ul class="p-info">
                                        <li>
                                            <div class="title">Account</div>
                                            <div class="desk"><?php echo $p_users[DB_USERS_COL_ACCOUNT_NAME]; ?></div>
                                        </li>
                                        <li>
                                            <div class="title">IDCard</div>
                                            <div class="desk"><?php echo $p_users[DB_USERS_COL_ID_CARD]; ?></div>
                                        </li>
                                        <li>
                                            <div class="title">Gender</div>
                                            <div class="desk"><?php echo $p_users[USER_GENDER_MALE] = USER_GENDER_MALE ? 'Male' : "Female"; ?></div>
                                        </li>
                                        <li>
                                            <div class="title">Email</div>
                                            <div class="desk"><?php echo $p_users[DB_USERS_COL_EMAIL]; ?></div>
                                        </li>
                                        <li>
                                            <div class="title">Phone</div>
                                            <div class="desk"><?php echo $p_users[DB_USERS_COL_PHONE]; ?></div>
                                        </li>
                                        <li>
                                            <div class="title">Birthday</div>
                                            <div class="desk"><?php echo $p_users[DB_USERS_COL_BIRTH_DATE]; ?></div>
                                        </li>
                                        <li>
                                            <div class="title">Address</div>
                                            <div class="desk"><?php echo $p_users[DB_USERS_COL_ADDRESS]; ?></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Infomation -->
                    </div>
                </div>
                <!--Left -->

                 <!--Right -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <!--statistics start-->
                            <div class="row state-overview">
                                
                                 <div class="col-md-4 col-xs-12 col-sm-6">                                    
                                    <div class="panel green">
                                        <div class="symbol">
                                            <i class="fa fa-picture-o"></i>
                                        </div>
                                        <div class="state-value">
                                            <div class="value"><?php echo $p_arr_images['p_total_image']; ?></div>
                                            <div class="title"><h4>Total images upload</h4></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-xs-12 col-sm-6">
                                    <div class="panel red">
                                        <div class="symbol">
                                            <i class="fa fa-comments"></i>
                                        </div>
                                        <div class="state-value">
                                            <div class="value"><?php echo $p_arr_images['p_total_comments']; ?></div>
                                            <div class="title"> <h4>Total comments</h4> </div>
                                        </div> 
                                    </div>
                                </div>                                
                               
                                <div class="col-md-4 col-xs-12 col-sm-12">
                                    <div class="panel purple">
                                        <div class="symbol">
                                            <i class="fa fa-facebook-square"></i>
                                        </div>
                                        <div class="state-value">
                                            <div class="value"><?php echo $p_arr_images['p_total_likes']; ?></div>
                                            <div class="title"><h4>Total <br /> likes</h4></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--statistics end-->
                        </div>
                    </div>
                    
                    <!-- Images -->
                    <div class="row">
                        <!--top 10 images most like begin-->
                            <div class="col-sm-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        List images
                                    </header>
                                    <div class="panel-body">

                                        <div class="media-gal col-lg-12">
                                            <div class="row">

                                                <?php 
                                                    foreach ($p_arr_images['p_images'] as $row) {
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="images item " style="width:100%">
                                                        <a href="#myModal" data-toggle="modal">
                                                            <img src="<?php echo base_url(UPLOAD_FOLDER.$row[DB_IMAGES_COL_NAME]); ?>" source="<?php echo base_url(UPLOAD_FOLDER.$row[DB_IMAGES_COL_NAME]); ?>" alt="" class="img-responsive" />                                                            
                                                        </a>
                                                        <p>Like: <?php echo $row[DB_IMAGES_COL_LIKES]; ?> <br />Comment : <?php echo $row[DB_IMAGES_COL_COMMENTS]; ?></p>
                                                        <p><span id="spline_<?php echo $row[DB_IMAGES_COL_ID]; ?>" class="label label-<?php echo ($row[DB_IMAGES_COL_IS_HIDDEN] == 1) ? "default" : "info"; ?>"><?php echo ($row[DB_IMAGES_COL_IS_HIDDEN] == 1) ? "Hidden" : "Show"; ?></span></p>
                                                    </div>
                                                </div>                                                
                                                <?php 
                                                    }//Endforeach image
                                                ?>

                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title">Gallery</h4>
                                                            </div>

                                                            <div class="modal-body row">

                                                                <div class="col-md-12 img-modal">
                                                                    <img src="" alt="" class="img-responsive">
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal -->

                                            </div>                                            
                                        </div>

                                    </div>
                                </section>
                            </div>
                            <!-- List images end-->
                    </div>
                    <!-- Images -->

                </div>
                <!--Right -->

            </div>
        </div>
        <!-- body wrapper end -->

    </div>

    