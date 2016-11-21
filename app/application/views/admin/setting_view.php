    <?php echo form_open(base_url("admin/setting/save"), array('role' => "form", "id" => "form")) ?>
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
            <h3>Setting</h3>
            
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo base_url("admin"); ?>">Dashboard</a>
                </li>
                <li class="active"> Setting </li>
            </ul>
            <div class="state-info text-right">
                <button type="submit" class="btn btn-primary">Save option</button>
            </div>
        </div>
        <!-- page heading end-->
        
        <!--body wrapper start-->
        <div class="wrapper">            
            
            <div class="row">
                <!-- Left-->               
                
                <div class="col-lg-6">
                    <div class="row">
                        
                        <!-- Time -->
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Set times                
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Begin date</label>
                                            <input class="form-control form-control-inline input-medium default-date-picker" id="txt_begin_date" name="txt_begin_date" size="16" type="text" value="<?php echo $p_arr_file[FILE_BEGIN_DATE]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                             <label>Finish date</label>
                                            <input class="form-control form-control-inline input-medium default-date-picker" id="txt_finish_date" name="txt_finish_date" size="16" type="text" value="<?php echo $p_arr_file[FILE_FINISH_DATE]; ?>" />
                                        </div>
                                     </div>
                                </div>
                            </section>
                        </div>
                        <!-- Time -->

                        <!-- Domain -->
                        <div class="col-lg-12" style="display:none">
                            <section class="panel">
                                <header class="panel-heading">
                                    Page setting
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <div class="row">                                       
                                                                                
                                        <div class="col-lg-12"> 
                                            <label>Logo</label>
                                            <div class="input-group" style="width:100%;">
                                                
                                                <input type="text" id="txt_logo" name="txt_logo" class="spinner-input form-control" placeholder="Logo" value="<?php echo $p_arr_file[FILE_LOGO]; ?>">
                                                
                                                <div class="spinner-buttons input-group-btn">                                                    
                                                    <button type="button" id="btn_logo" class="btn spinner-down btn-primary">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12"> 
                                            <label>Favicon</label>
                                            <div class="input-group" style="width:100%;">
                                                
                                                <input type="text" id="txt_favicon" name="txt_favicon" class="spinner-input form-control" placeholder="Favicon" value="<?php echo $p_arr_file[FILE_FAVICON]; ?>">
                                                
                                                <div class="spinner-buttons input-group-btn">
                                                    <button type="button" id="btn_favicon" class="btn spinner-down btn-primary">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- Domain -->
                        
                        <!-- Image upload size -->
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Image size
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">                            
                                            <div class="form-group">
                                                    <label>Max-width</label>
                                                    <input type="text" id="txt_img_maxwidth" name="txt_img_maxwidth" class="form-control" placeholder="Max-width" value="<?php echo $p_arr_file[FILE_IMAGE_MAX_WIDTH]; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Max-height</label>
                                                <input type="text" id="txt_img_maxheight" name="txt_img_maxheight" class="form-control" placeholder="Max-height" value="<?php echo $p_arr_file[FILE_IMAGE_MAX_HEIGHT]; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">                            
                                            <div class="form-group">
                                                    <label>Min-width</label>
                                                    <input type="text" id="txt_img_minwidth" name="txt_img_minwidth" class="form-control" placeholder="Min-width" value="<?php echo $p_arr_file[FILE_IMAGE_MIN_WIDTH]; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Min-height</label>
                                                <input type="text" id="txt_img_minheight" name="txt_img_minheight" class="form-control" placeholder="Min-height" value="<?php echo $p_arr_file[FILE_IMAGE_MIN_HEIGHT]; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">                            
                                            <div class="form-group">
                                                <label>Size (MB)</label>
                                                <input type="text" id="txt_img_size" name="txt_img_size" class="form-control" placeholder="Size" value="<?php echo $p_arr_file[FILE_IMAGE_SIZE]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- Image upload size -->
                    
                        <!-- Image extention -->
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Images extention                    
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Image extention convert</label>
                                        <select class="form-control" name="sl_img_extention" id="sl_img_extention">
                                            <option value="gif|jpe?g|png|bmp">any</option>
                                            <option value="gif" <?php echo ($p_arr_file[FILE_IMAGE_EXTENTION] == "gif") ? "selected" : ""; ?>>gif</option>
                                            <option value="jpe?g" <?php echo ($p_arr_file[FILE_IMAGE_EXTENTION] == "jpeg") ? "selected" : "" ; ?>>jpg/jpeg</option>
                                            <option value="png" <?php echo ($p_arr_file[FILE_IMAGE_EXTENTION] == "png") ? "selected" : ""; ?>>png</option>
                                            <option value="bmp" <?php echo ($p_arr_file[FILE_IMAGE_EXTENTION] == "bmp") ? "selected" : ""; ?>>bmp</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- Image extention -->                        
                        
                        <!--Show images after upload -->
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Display images after upload                     
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                            
                                    </span>
                                </header>
                                <div class="panel-body">   
                                    <div class="form-group" style="min-height: 30px">                              
                                        <label class="control-label col-xs-3">Check</label>
                                        <div class="col-xs-9">
                                            <div class="slide-toggle">
                                                <div>
                                                    <input type="checkbox" id="chk_check_img" name="chk_check_img" value="1" class="js-switch" <?php echo ($p_arr_file[FILE_IMAGE_CHECK_UPLOAD] == TRUE) ? "checked" : ""; ?>/>
                                                </div>

                                            </div>
                                        </div>
                                    </div>                                 
                                </div>
                            </section>
                        </div> 
                        <!-- Show images after upload -->
                    </div>
                </div>
                <!--Left -->
                
                <!-- Right -->
                <div class="col-lg-6">
                    <div class="row">
                        <!-- Setting app -->
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Facebook
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">                            
                                            <div class="form-group">
                                                    <label>AppID</label>
                                                    <input type="text" id="txt_fb_appid" name="txt_fb_appid" class="form-control" placeholder="AppID" value="<?php echo $p_arr_file[FILE_FACEBOOK_APP_ID]; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>App Secret</label>
                                                <input type="text" id="txt_fb_appsecret" name="txt_fb_appsecret" class="form-control" placeholder="App Secret" value="<?php echo $p_arr_file[FILE_FACEBOOK_APP_SECRET]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Instagram
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Hashtag</label>
                                                <input type="text" id="txt_hashtag_itg" name="txt_hashtag_itg" class="form-control" placeholder="#Hashtag" value="<?php echo $p_arr_file[FILE_HASHTAG_INSTAGRAM]; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">                            
                                            <div class="form-group">
                                                    <label>Api Key</label>
                                                    <input type="text" id="txt_itg_apiid" name="txt_itg_apiid" class="form-control" placeholder="Api Key" value="<?php echo $p_arr_file[FILE_INSTAGRAM_API_ID]; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Api Secret</label>
                                                <input type="text" id="txt_itg_apisecret" name="txt_itg_apisecret" class="form-control" placeholder="Api Secret" value="<?php echo $p_arr_file[FILE_INSTAGRAM_API_SECRET]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Twitter
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Hashtag</label>
                                                <input type="text" id="txt_hashtag_tw" name="txt_hashtag_tw" class="form-control" placeholder="#Hashtag" value="<?php echo $p_arr_file[FILE_HASHTAG_TWITTER]; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">                            
                                            <div class="form-group">
                                                    <label>Consumer Key</label>
                                                    <input type="text" id="txt_tw_consumerkey" name="txt_tw_consumerkey" class="form-control" placeholder="Consumer Key" value="<?php echo $p_arr_file[FILE_TWITTER_CONSUMER_KEY]; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Consumer Secret</label>
                                                <input type="text" id="txt_tw_consumersecret" name="txt_tw_consumersecret" class="form-control" placeholder="Consumer Secret" value="<?php echo $p_arr_file[FILE_TWITTER_COMSUMER_SECRET]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- Setting app -->
                        
                        <!-- Max number upload -->
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Max number of upload                        
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                            
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <div class="form-group ">
                                        <label class="control-label col-md-3">Number</label>
                                            <div class="col-md-9">
                                                <div id="spinner1">
                                                    <div class="input-group" style="width:150px;">
                                                        <div class="spinner-buttons input-group-btn">
                                                            <button type="button" class="btn spinner-up btn-primary">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" id="txt_max_upload" name="txt_max_upload" class="spinner-input form-control" maxlength="3" value="<?php echo $p_arr_file[FILE_IMAGE_UPLOAD]; ?>">
                                                        <div class="spinner-buttons input-group-btn">
                                                        <button type="button" class="btn spinner-down btn-warning">
                                                                <i class="fa fa-minus"></i>
                                                        </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </section>
                        </div>   
                        <!-- Max number upload -->
                        
                        <!-- View number item -->
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Item Show Page                      
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                            
                                    </span>
                                </header>
                                <div class="panel-body">
                                    <div class="form-group ">
                                        <label class="control-label col-md-3">Number</label>
                                            <div class="col-md-9">
                                                <div id="spinner2">
                                                    <div class="input-group" style="width:150px;">
                                                        <div class="spinner-buttons input-group-btn">
                                                            <button type="button" class="btn spinner-up btn-primary">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" id="txt_item_page" name="txt_item_page" class="spinner-input form-control" maxlength="3" value="<?php echo $p_arr_file[FILE_IMAGE_SHOW_NUMBER]; ?>">
                                                        <div class="spinner-buttons input-group-btn">
                                                        <button type="button" class="btn spinner-down btn-warning">
                                                                <i class="fa fa-minus"></i>
                                                        </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </section>
                        </div> 
                        <!-- View number item -->  
                        
                        <!--minimum age authorized user -->
                        <div class="col-lg-12" style="display:none">
                            <section class="panel">
                                <header class="panel-heading">
                                    Minimum age authorized user                     
                                    <span class="tools pull-right">
                                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                                            
                                    </span>
                                </header>
                                <div class="panel-body">   
                                    <div class="form-group" style="min-height: 30px">                              
                                        <label class="control-label col-xs-3">Check age</label>
                                        <div class="col-xs-9">
                                            <div class="slide-toggle">
                                                <div>
                                                    <input type="checkbox" class="js-switch" checked/>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Number</label>
                                            <div class="col-md-9">
                                                <div id="spinner3">
                                                    <div class="input-group" style="width:150px;">
                                                        <div class="spinner-buttons input-group-btn">
                                                            <button type="button" class="btn spinner-up btn-primary">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" class="spinner-input form-control" maxlength="3">
                                                        <div class="spinner-buttons input-group-btn">
                                                        <button type="button" class="btn spinner-down btn-warning">
                                                                <i class="fa fa-minus"></i>
                                                        </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </section>
                        </div> 
                        <!-- minimum age authorized user -->                         
                        
                    </div>
                </div>
                <!-- Right -->
                
            </div>
            
            <div class="row">
                <div class="col-lg-12 text-right">
                    <button type="submit" class="btn btn-primary">Save option</button>
                </div>    
            </div>
            
        </div>
        <!--body wrapper end-->

    </div>
    <!-- main content end-->
    <?php echo form_close(); ?>