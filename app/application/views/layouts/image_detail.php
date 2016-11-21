<?php
$css = array('template/js/owl.carousel/assets/owl.carousel.css');
$data[CSS] = $css;
$this->load->view('layouts/header', $data);
?>                      
            
            <!-- carousel photo begin -->
            <section class="owl-carousel photo-carousel">
            <?php
                foreach ($other as $img) { ?>
                <div><a href="<?php echo $img['link']; ?>"><img src="<?php echo $img[THUMB]; ?>" class="img-responsive"></a></div>
            <?php } ?>
            </section>
            <!-- carousel photo end -->
            
            <!-- content photo detail begin -->
            <section class="content">
                
                <!-- contestant begin -->
                <div class="voter">
                    <div class="avatar">
                        <img src="template/images/no_user_profile-pic.jpg" class="img-responsive" height="42" width="42" />
                    </div>
                    <div class="name">
                        <p>Lorem ipsum</p>
                        <a href="#" class="btn-blue">Follow</a>
                    </div>
                </div>
                <!-- contestant end -->
                <!-- main photo detail begin -->
                <div class="main col-lg-12">                    
                    <div class="row">
                        <!-- main photo begin -->
                        <div class="photo text-center">
                            <img src="<?php echo $image[DB_IMAGES_COL_NAME]; ?>" class="img-responsive">
                            
                            <div class="button">
                                <a href="#" class="left"><img src="template/images/left.png" /></a>
                                <a href="#" class="right"><img src="template/images/right.png" /></a>
                            </div>
                            
                            
                            
                        </div>
                        <!-- main photo end -->
                        
                        <!-- like and share begin -->
                        <div class="like-share">
                            
                           <div class="pull-left">
                            <div class="fb-like" data-href="http://vv-pos.net/imagecontest" data-width="55" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                                
                            </div>
                            
                            <div class="pull-right">
                                <ul class="list-inline">
                                    <li>Share This On:</li>
                                    <li><a href="#"><img src="template/images/fb-icon.png" /></a></li>
                                    <li><a href="#"><img src="template/images/twitter-icon.png" /></a></li>
                                    <li><a href="#"><img src="template/images/google-plus-icon.png" /></a></li>
                                    <li><a href="#"><img src="template/images/pinterest-icon.png" /></a></li>
                                    <li><a href="#"><img src="template/images/email-icon.png" /></a></li>
                                </ul>
                            </div>
                            
                        </div>
                        <!-- like and share end -->
                        
                        <!-- comment begin -->
                        <div class="comment">
                            <div class="fb-comments" data-href="http://vv-pos.net/imagecontest" data-width="620" data-numposts="20" data-colorscheme="light"></div>
                        </div>                    
                        <!-- comment end -->
                    </div>                    
                </div>
                <!-- main photo end begin -->
                
            </section>
            <!-- content photo detail end -->

<?php
$javascript = array('template/js/owl.carousel/owl.carousel.min.js');
$data[JAVASCRIPT] = $javascript;
$this->load->view('layouts/footer', $data);