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
            <h3>Dashboard</h3>
            
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo base_url("admin"); ?>">Dashboard</a>
                </li>
                <li class="active"> My Dashboard </li>
            </ul>
            
            <div class="state-info">
                <section class="panel">
                    <a href="<?php echo base_url('admin/load_hashtag') ?>">
                    <div class="panel-body">
                        <div class="summary">
                            <span><?php echo $p_arr_file[FILE_HASHTAG_INSTAGRAM].' '; ?> <?php echo $p_arr_file[FILE_HASHTAG_TWITTER]; ?></span>
                            <h3><i class="fa fa-cloud-download"></i> Get images</h3>
                        </div>
                    </div>
                    </a>
                </section>
                <section class="panel">
                    <div class="panel-body">
                        <div class="summary">
                            <span>Finish Date</span>
                            <h3 class="red-txt"><?php echo $p_arr_file[FILE_FINISH_DATE] ?></h3>
                        </div>
                    </div>
                </section>
                <section class="panel">
                    <div class="panel-body">
                        <div class="summary">
                            <span>Begin Date</span>
                            <h3 class="green-txt"><?php echo $p_arr_file[FILE_BEGIN_DATE] ?></h3>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page heading end-->
        
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <!--statistics start-->
                    <div class="row state-overview">
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel green">
                                <div class="symbol">
                                    <i class="fa fa-picture-o"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $p_count_images; ?></div>
                                    <div class="title"> Images Upload</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel red">
                                <div class="symbol">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $p_count_users; ?></div>
                                    <div class="title">Users</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel purple">
                                <div class="symbol">
                                    <i class="fa fa-facebook-square"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $p_count_likes; ?></div>
                                    <div class="title"> Votes</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel blue">
                                <div class="symbol">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $p_count_comments; ?></div>
                                    <div class="title"> Comments</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--statistics end-->
                </div>       
            </div>
            
            <div class="row">
                
                <!--top 10 images most like begin-->
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Top 10 images have the most votes
                        </header>
                        <div class="panel-body">
                            <table class="table  table-hover general-table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="hidden-phone">Name</th>
                                    <th>Original</th>
                                    <th>Votes</th>
                                    <th>Comments</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php 
                                    if(count($p_top_contestant) > 0)
                                    {
                                        //PHP Tag
                                        foreach ($p_top_contestant as $row) {    
                                ?>

                                <tr>
                                    <td>
                                        <a href="<?php echo base_url('gallery/detail/image_'.$row[DB_IMAGES_COL_ID]) ?>">
                                            <?php echo $row[NO]; ?>
                                        </a>
                                    </td>
                                    <td class="hidden-phone">
                                        <a href="<?php echo base_url('admin/contestants/profile/'.$row[DB_IMAGES_COL_AUTHOR]); ?>">
                                            <?php echo $row[DB_USERS_COL_NAME]; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $row[DB_IMAGES_COL_ORIGIN]; ?></td> 
                                    <td><?php echo $row[DB_IMAGES_COL_LIKES]; ?> </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/comments/'.$row[DB_IMAGES_COL_ID]); ?>">
                                            <?php echo $row[DB_IMAGES_COL_COMMENTS]; ?>
                                        </a>
                                    </td>
                                    <td><a href="#myModal" data-toggle="modal">
                                        <img src="<?php echo base_url(UPLOAD_FOLDER.$row[DB_IMAGES_COL_NAME]); ?>" source="<?php echo base_url(UPLOAD_FOLDER.$row[DB_IMAGES_COL_NAME]); ?>" alt="" width="80px" />
                                    </a></td>
                                    <td>
                                        <span id="spline_<?php echo $row[NO]; ?>" class="label label-<?php echo ($row[DB_IMAGES_COL_IS_HIDDEN] == IMAGE_HIDDEN) ? "default" : "info"; ?>"><?php echo ($row[DB_IMAGES_COL_IS_HIDDEN] == IMAGE_HIDDEN) ? "Hidden" : "Show"; ?></span>
                                    </td>
                                    <td> 
                                        <?php 
                                            if($row[DB_IMAGES_COL_IS_HIDDEN] == IMAGE_NOT_HIDDEN) {
                                        ?>
                                        <a data-change="spline_<?php echo $row[NO]; ?>" style="width: 85px;" href="javascript:void(0)"  class="btn btn-default btn-sm action" data-id="<?php echo $row[DB_IMAGES_COL_ID]; ?>" data-hidden="<?php echo IMAGE_HIDDEN; ?>">Hide</a> 
                                        
                                        <?php } else {
                                        ?>
                                        <a data-change="spline_<?php echo $row[NO]; ?>" style="width: 85px;" href="javascript:void(0)"  class="btn btn-info btn-sm action" data-id="<?php echo $row[DB_IMAGES_COL_ID]; ?>" data-hidden="<?php echo IMAGE_NOT_HIDDEN; ?>">Show</a> 
                                        <?php 
                                        }
                                        ?>

                                    </td>
                                </tr>    

                                <?php 

                                        } //End foreadch
                                    } //end if
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </section>
                    
                    
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
                <!--top 10 images most like end-->
            </div>
            
            <div class="row">
                <!-- Top 10 largest gallery begin-->
                <div class="col-md-6">
                    <section class="panel">
                        <header class="panel-heading">
                            TOP 10 CONTESTANTS HAVE MOST TOTAL VOTES ON HIS UPLOADED IMAGE(S).
                        </header>
                        <div class="panel-body">
                            <table class="table  table-hover general-table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Total Likes</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                <?php 
                                    if(count($p_arr_users_total_likes) > 0){
                                        //Top most upload images
                                        foreach ($p_arr_users_total_likes as $row) {
                                    
                                ?>
                                <tr>
                                    <td><?php echo ++$p_count; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/contestants/profile/'.$row[DB_IMAGES_COL_AUTHOR]); ?>">
                                            <?php echo $row[DB_USERS_COL_NAME]; ?>
                                        </a>
                                    </td>                                   
                                    <td><?php echo $row[DB_USERS_COL_PHONE]; ?> </td>
                                    <td><?php echo $row[DB_IMAGES_COL_LIKES]; ?></td>                                    
                                </tr>  
                                <?php 
                                    }//Endforeach
                                }//end if
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                <!--top 10 largest gallery end-->
                
                <!--top 10 users have most like begin-->
                <div class="col-md-6">
                    <section class="panel">
                        <header class="panel-heading">
                            TOP 10 CONTESTANTS HAVE MOST TOTAL COMMENTS ON HIS UPLOADED IMAGE(S).
                        </header>
                        <div class="panel-body">
                            <table class="table  table-hover general-table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Total Comments</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                    if(count($p_arr_users_total_comments) > 0){ 
                                        //Top most upload images
                                        $p_count    =   0;
                                        foreach ($p_arr_users_total_comments as $row) {
                                    
                                ?>
                                <tr>
                                    <td><?php echo ++$p_count; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/contestants/profile/'.$row[DB_IMAGES_COL_AUTHOR]); ?>">
                                            <?php echo $row[DB_USERS_COL_NAME]; ?>
                                        </a>
                                    </td>
                                    
                                    <td><?php echo $row[DB_USERS_COL_PHONE]; ?> </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/comments/'.$row[DB_IMAGES_COL_ID]); ?>">
                                            <?php echo $row[DB_IMAGES_COL_COMMENTS]; ?>
                                            </a>
                                        </td>                                   
                                </tr>  
                                <?php 
                                    }//Endforeach
                                }//endif
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                <!--top 10 uses have most like end-->
            </div>            
            
        </div>
        <!--body wrapper end-->
        
    </div>
    <!-- main content end-->