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
            <h3>Comments</h3>
            
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo base_url("admin"); ?>">Dashboard</a>
                </li>
                <li class="active"> List Comments </li>
            </ul>
        </div>

        <!-- body wrapper start -->
        <div class="wrapper">
            <div class="row">
                    
                    <!--table begin-->
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading">
                                List Comments
                            </header>
                            <div class="panel-body">
                                <table class="table  table-hover general-table">
                                    <thead>
                                    <tr>
                                        <th>Avatar</th>
                                        <th class="hidden-phone">Name</th>
                                        <th>Commemt</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        if(count($p_comments) > 0) {
                                            //PHP Tag
                                            foreach ($p_comments as $row) {    
                                    ?>

                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url('admin/contestants/profile/'.$row['author_id']) ?>">
                                                <img src="<?php echo $row['avatar']; ?>" class="img-responsive" width="32" />
                                            </a>
                                        </td>
                                        <td class="hidden-phone">
                                            <?php echo $row['author']; ?>                                            
                                        </td>
                                        <td><?php echo $row[DB_COMMENTS_COL_CONTENT]; ?></td>
                                        <td><a style="width: 105px; margin-top: 5px; color:#fff" href="javascript:void(0)" class="btn btn-primary btn-sm action" data-id="<?php echo $row[DB_COMMENTS_COL_ID]; ?>">Delete</a> </td>
                                    </tr>    

                                    <?php 

                                        } //End foreadch
                                    }//end if
                                    ?>

                                    </tbody>
                                </table>

                            </div>
                        </section>
                    </div>
                    <!--table end-->
                </div>
        </div>
        <!-- body wrapper end -->

    </div>

    

    