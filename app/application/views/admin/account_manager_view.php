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
            <h3>Profile</h3>
            
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo base_url("admin"); ?>">Dashboard</a>
                </li>
                <li>Profile</li>
            </ul>
        </div>

        <!-- body wrapper start -->
        <div class="wrapper">            
            <div class="row">                
                <!-- Left-->
                <?php echo form_open(base_url("admin/profile/save"), array('role' => "form", "id" => "form1")) ?>
                <div class="col-lg-6">
                    <div class="row">
                        <!-- Profile -->
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Profile
                                </header>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Name" value="<?php echo $p_profile[0][DB_MANAGER_COL_NAME]; ?>">
                                            </div>
                                        </div>  
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Account name</label>
                                                <input type="text" class="form-control" id="txt_account" name="txt_account" placeholder="Account name" value="<?php echo $p_profile[0][DB_MANAGER_COL_ACCOUNT_NAME]; ?>" readonly>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" id="txt_email" name="txt_email" placeholder="Email" value="<?php echo $p_profile[0][DB_MANAGER_COL_EMAIL]; ?>" readonly>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" id="txt_phone" name="txt_phone" placeholder="Phone" value="<?php echo $p_profile[0][DB_MANAGER_COL_PHONE]; ?>">
                                            </div>
                                        </div> 

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" id="txt_address" name="txt_address" placeholder="Address" rows="3"><?php echo $p_profile[0][DB_MANAGER_COL_ADDRESS]; ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 text-right">
                                            <button type="submit" class="btn btn-primary">Save option</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- Profile -->                        
                       
                    </div>
                </div>
                
                <input type="hidden" name="rd_id" value="<?php echo $p_profile[0][DB_MANAGER_COL_ID]; ?>" />
                <input type="hidden" name="type"  value="0" />
                <?php echo form_close(); ?> 
                <!--Left -->
                
                <?php echo form_open(base_url("admin/profile/save"), array('role' => "form", "id" => "form2")) ?>
                <!-- Right -->
                <div class="col-lg-6">
                    <div class="row">
                        <!-- Setting app -->
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Change password
                                </header>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <input type="password" id="txt_old_password" name="txt_old_password" class="form-control" placeholder="Current Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" id="txt_new_password" name="txt_new_password" class="form-control" placeholder="New Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" id="txt_confirm_password" name="txt_confirm_password" class="form-control" placeholder="Confirm Password" required>
                                            </div>
                                        </div> 

                                        <div class="col-lg-12 text-right">
                                            <button type="submit" class="btn btn-primary">Change password</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>                        
                        
                    </div>
                </div>
                <!-- Right -->
                <input type="hidden" name="rd_id" value="<?php echo $p_profile[0][DB_MANAGER_COL_ID]; ?>" />
                <input type="hidden" name="type" value="1" />
                <?php echo form_close(); ?>
                
            </div>                           
        </div>
        <!-- body wrapper end -->

    </div>

    