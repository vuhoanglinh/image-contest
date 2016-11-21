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
            <h3>Images list</h3>
            
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo base_url("admin"); ?>">Dashboard</a>
                </li>
                <li class="active"> Images list </li>
            </ul>
        </div>

        <!-- body wrapper start -->
        <div class="wrapper">
            <div class="row">
                    
                    <!--top 10 images most like begin-->
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading text-right">

                                    Sort by: &nbsp;&nbsp;                            
                                    <a href="<?php echo base_url("admin/images")."?sort=".DB_IMAGES_COL_LIKES; ?>">Vote</a> &nbsp;&nbsp;
                                    <a href="<?php echo base_url("admin/images")."?sort=".DB_IMAGES_COL_COMMENTS; ?>">Comment</a>                          
                            
                            </header>
                            <div class="panel-body">
                                <table class="table  table-hover general-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="hidden-phone">Name</th>
                                        <th>Original</th>
                                        <th>Vote</th>
                                        <th>Comment</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        //PHP Tag
                                        if(count($p_images) > 0) {
                                            foreach ($p_images as $row) {    
                                    ?>

                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url('gallery/detail/image_'.$row[DB_IMAGES_COL_ID]) ?>">
                                                <?php echo $row[DB_IMAGES_COL_ID]; ?>
                                            </a>
                                        </td>
                                        <td class="hidden-phone">
                                            <a href="<?php echo base_url('admin/contestants/profile/'.$row[DB_IMAGES_COL_AUTHOR]); ?>">
                                                <?php echo $row[DB_USERS_COL_NAME]; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $row[DB_IMAGES_COL_ORIGIN]; ?></td> 
                                        <td><?php echo $row[DB_IMAGES_COL_LIKES]; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/comments/'.$row[DB_IMAGES_COL_ID]); ?>">
                                            <?php echo $row[DB_IMAGES_COL_COMMENTS]; ?>
                                            </a>
                                        </td>
                                        <td><a href="#myModal" data-toggle="modal">
                                            <img src="<?php echo base_url(UPLOAD_FOLDER.$row[DB_IMAGES_COL_NAME]); ?>" source="<?php echo base_url(UPLOAD_FOLDER.$row[DB_IMAGES_COL_NAME]); ?>" alt="" width="80px" />
                                        </a></td>
                                        <td>
                                            <span id="spline_<?php echo $row[NO]; ?>" class="label label-<?php echo ($row[DB_IMAGES_COL_IS_HIDDEN] == 1) ? "default" : "info"; ?>"><?php echo ($row[DB_IMAGES_COL_IS_HIDDEN] == 1) ? "Hidden" : "Show"; ?></span>
                                        </td>
                                        <td> 
                                            <?php 
                                                if($row[DB_IMAGES_COL_IS_HIDDEN] == IMAGE_NOT_HIDDEN) {
                                            ?>
                                            <a data-change="spline_<?php echo $row[NO]; ?>" style="width: 125px;" href="javascript:void(0)"  class="btn btn-default btn-sm action" data-id="<?php echo $row[DB_IMAGES_COL_ID]; ?>" data-hidden="<?php echo IMAGE_HIDDEN; ?>">Hide</a> 
                                            
                                            <?php } else {
                                            ?>
                                            <a data-change="spline_<?php echo $row[NO]; ?>" style="width: 125px;" href="javascript:void(0)"  class="btn btn-info btn-sm action" data-id="<?php echo $row[DB_IMAGES_COL_ID]; ?>" data-hidden="<?php echo IMAGE_NOT_HIDDEN; ?>">Show</a> 
                                            <?php 
                                            }
                                            ?>
                                            <br />
                                            <a style="width: 125px; margin-top: 5px; color: #fff" href="<?php echo base_url('admin/comments/'.$row[DB_IMAGES_COL_ID]); ?>" class="btn btn-primary btn-sm">Show comments</a>
                                        </td>
                                    </tr>    

                                    <?php 
                                            } //End foreadch
                                        } //End if
                                    ?>

                                    </tbody>
                                </table>
                                
                                <?php 
                                    if(count($p_images) > 0) {
                                ?>

                                <!-- pagging start -->
                                <div class="col-md-12 text-center clearfix">
                                    <ul class="pagination">

                                        <li><a href="<?php echo base_url("admin/images")."?page=".$p_arr_param['p_prev_page']."&sort=".$p_arr_param['p_sort']; ?>">«</a></li>
                                        <?php 
                                            for ($item = 1; $item <= $p_arr_param['p_list_page']; $item++) {                                        
                                        ?>
                                        <li class="<?php echo $p_arr_param['p_current_page'] == $item ? 'active' : ''; ?>"><a href="<?php echo base_url("admin/images")."?page=".$item."&sort=".$p_arr_param['p_sort']; ?>"><?php echo $item; ?></a></li>
                                        <?php 
                                            }
                                        ?>

                                        <li><a href="<?php echo base_url("admin/images")."?page=".$p_arr_param['p_next_page']."&sort=".$p_arr_param['p_sort']; ?>">»</a></li>
                                    </ul>
                                </div>
                                <?php 
                                    }
                                ?>

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
        </div>
        <!-- body wrapper end -->

    </div>

    