        <!--notification menu start -->
        <div class="menu-right">
            <ul class="notification-menu">             
                <li>
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">                        
                        <?php 
                            echo isset($p_account_name) ? $p_account_name : "Admistator";
                        ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <li><a href="<?php echo base_url("admin/profile"); ?>"><i class="fa fa-user"></i>  Profile</a></li>
                        <li><a href="<?php echo base_url("admin/setting"); ?>"><i class="fa fa-cog"></i>  Settings</a></li>
                        <li><a href="<?php echo base_url("admin/logout"); ?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!--notification menu end -->