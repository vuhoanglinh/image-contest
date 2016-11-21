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
                <li class="active"> Contestant </li>
            </ul>
        </div>

        <!-- body wrapper start -->
        <div class="wrapper">
            <div class="row">
                <!-- contestant start -->
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            List users
                        </header>
                        <div class="panel-body">
                            <table class="table  table-hover">
                                <thead>
                                <tr>                                    
                                    <th>Avatar</th>
                                    <th>Account</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th style="width:100px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($p_users) > 0) {
                                           foreach ($p_users as $row) {
                                    ?>
                                <tr>
                                    <td><a href="<?php echo base_url('admin/contestants/profile/'.$row[DB_USERS_COL_ID]); ?>"><img src="<?php echo $row[DB_USERS_COL_AVATAR]; ?>" alt="" class="img-responsive" width="100" /></a></td>
                                    <td><?php echo $row[DB_USERS_COL_ACCOUNT_NAME]; ?></td>
                                    <td class="username"><?php echo $row[DB_USERS_COL_NAME]; ?></td>
                                    <td><?php echo $row[USER_GENDER_MALE] = USER_GENDER_MALE ? 'Male' : "Female"; ?></td>
                                    <td><?php echo $row[DB_USERS_COL_EMAIL]; ?></td>
                                    <td><?php echo $row[DB_USERS_COL_PHONE]; ?></td>  
                                    <td>
                                            <span id="spline_<?php echo $row[DB_USERS_COL_ID]; ?>" class="label label-<?php echo ($row[DB_USERS_COL_IS_BAN] == USER_BANNED) ? "default" : "info"; ?>"><?php echo ($row[DB_USERS_COL_IS_BAN] == USER_BANNED) ? "Banned" : "Allowed"; ?></span>
                                    </td>
                                    <td class="text-center">
                                        <a style="width: 105px;" href="<?php echo base_url('admin/contestants/profile/'.$row[DB_USERS_COL_ID]); ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Profile</a>                                        
                                        <?php
                                                if($row[DB_USERS_COL_IS_BAN] == USER_BANNED) {
                                            ?>
                                            <a style="width: 105px; margin-top: 5px;" data-change="spline_<?php echo $row[DB_USERS_COL_ID]; ?>" style="width: 85px;" href="javascript:void(0)"  class="btn btn-info btn-sm action" data-id="<?php echo $row[DB_USERS_COL_ID]; ?>" data-hidden="<?php echo USER_NOT_BANNED; ?>">Allow</a>
                                            
                                            <?php } else {
                                            ?>
                                             <a style="width: 105px; margin-top: 5px;" data-change="spline_<?php echo $row[DB_USERS_COL_ID]; ?>" style="width: 85px;" href="javascript:void(0)"  class="btn btn-default btn-sm action" data-id="<?php echo $row[DB_USERS_COL_ID]; ?>" data-hidden="<?php echo USER_BANNED; ?>">Ban</a> 
                                            <?php 
                                            }
                                            ?>
                                    </td>
                                </tr> 
                                <?php 
                                    }//Endforeach
                                }//endif
                                ?>    
                                </tbody>
                            </table>
                            
                            <?php 

                                if(count($p_users) > 0) {

                            ?>
                            <!-- pagging start -->
                                <div class="col-md-12 text-center clearfix">
                                    <ul class="pagination">

                                        <li><a href="<?php echo base_url("admin/contestants")."?page=".$p_arr_param['p_prev_page']; ?>">«</a></li>
                                        <?php 
                                            for ($item = 1; $item <= $p_arr_param['p_list_page']; $item++) {                                        
                                        ?>
                                        <li class="<?php echo $p_arr_param['p_current_page'] == $item ? 'active' : ''; ?>"><a href="<?php echo base_url("admin/contestants")."?page=".$item; ?>"><?php echo $item; ?></a></li>
                                        <?php 
                                            }
                                        ?>

                                        <li><a href="<?php echo base_url("admin/contestants")."?page=".$p_arr_param['p_next_page']; ?>">»</a></li>
                                    </ul>
                                </div>
                            <?php 
                                }//endif
                            ?>
                        </div>                        
                    </section>
                </div>
                <!-- contestant end -->
            </div>
        </div>
        <!-- body wrapper end -->

    </div>

    