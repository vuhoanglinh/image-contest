    <style>
        canvas{max-width: 100%; position: absolute;top:0;bottom:0;left:0;right:0;margin:auto;}
        img{max-width: 100%;}
    </style>
    <link rel="stylesheet" href="<?php echo base_url('assets/scripts/vendor/colorbox/colorbox_image.css'); ?>" />

    <script>
    $(document).ready(function(){
        $(".group2").colorbox({
            rel:'group2', 
            transition:"none"
        });
    });
    </script>

<form id="fileupload" action="upload/do_upload" method="POST" enctype="multipart/form-data">
<div id="ctn-photo-holder">
<div class="lyt-list-photo">
<ul class="list-uploaded files">

</ul><!-- /list-uploaded -->
</div><!-- /lyt-list-photo -->
<div class="blk-btn-holder fileupload-buttonbar">
<p id="msg_file" style="display:none" class="error-message-holder"><span class="max-attention">Error: Please delete photos which cannot be uploaded.
<p id="msg_file_max" style="display:none" class="error-message-holder"><span class="max-attention">Error: You can upload <?php echo $maxFileUpload; ?> of photo(s). Please delete unwanted photos first to upload other photos.</span></p>
<input type="submit" value="Upload" id="start" class="btn-submit-02 start">
<input type="reset" value="Cancel" id="cancel" class="btn-submit-03 cancel">
</div><!-- /blk-btn-holder -->
</div><!-- /ctn-photo-holde -->
<script id="template-upload" type="text/x-tmpl">

 {% for (var i=0, file; file=o.files[i]; i++) { %}
    <li class="template-upload fade">
        {%=file.error%}
    <figure class="preview">
        <span class="box-error-message error"></span>
    </figure>
    <button class="btn-submit-01 start" style="display:none"><b>Start</b></button>
    <button class="btn-submit-01 cancel"><b>Delete</b></button>
    </li>
 {% } %}

</script>


<div id="ctn-body">
<section class="lyt-upload-photo">
<h1 class="box-title-large-01">Upload Photos</h1>
<div class="lyt-inner cf">
<div id="drop" class="drag-frame">
    <input type="file" name="userfile" multiple>
</div><!-- /drag-frame -->
<div class="upload-content">
<ul class="list-notice-infor">
<li>1. Photos must be in <strong>.jpg format.</strong></li>
<li>2. Photos resolution must be larger than <strong>600px by 400px.</strong></li>
<li>3. Photo size must be smaller than <strong>2MB.</strong></li>
<li>4. Upload max <strong><?php echo $maxFileUpload; ?> photos.</strong></li>
</ul>
<p class="btn-fileupload">
<span class="btn-submit-01">Upload from PC</span>
<input type="file" name="userfile" multiple>
</p>
<p id="msg_max" class="max-attention" style="display:none">Maximim 4 photos you can select. Please check again.</p>
</div><!-- /upload-content -->
</div><!-- /lyt-inner -->
<dl class="sp-users">
<dt>SMARTPHONE USERS</dt>
<dd>Upload a photo on your Instagram/Twitter with <strong>#PhotoCon</strong></dd>
</dl><!-- /sp-users -->
</section><!-- /lyt-upload-photo -->


<section class="lyt-list-photo">
<h2 class="box-title-lv2-01"><span>Your Upload Photos</span></h2>

<ul class="list-uploaded">
    <?php 
        if(count($p_arr_img) > 0) {
            foreach ($p_arr_img as $img) {
    ?>
    <li>
        <figure>
            <a href="<?php echo $img[DB_IMAGES_COL_NAME]; ?>" class="group2" style="background: url(<?php echo $img[THUMB]; ?>);width: 100%;height: 100%;background-size: cover;background-repeat: no-repeat;">
            </a>
        </figure>
        <p class="btn-controls"><a href="<?php echo $img[LINK] ?>" class="btn-submit-01"><b>See gallery</b></a></p>        
        <p class="btn-controls"><a class="btn-submit-01 confirm"><b>Delete</b></a></p>
        <div class="dialog-confirm">
            <dl class="dialog-confirm-inner">
            <dt>Do you want to delete the photo?</dt>
            <dd>
            <input type="button" action="del" data-id="<?php echo $img[DB_IMAGES_COL_ID]; ?>" value="Delete" class="btn-submit-02">
            <input type="button" value="Cancel" class="btn-submit-04 btn-cancel">
            </dd>
        </dl>
        </div>
    </li>

    <?php 
            } //end foreach
        }//endif
    ?>
</ul><!-- /list-uploaded -->


</section><!-- /lyt-list-photo -->

</div>
</form>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/canvas-to-blob.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/jquery.fileupload-image.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <!--<script src="<?php echo base_url(FOLDER_ADMIN_VENDOR); ?>/upload/main.js"></script>-->
    <?php echo isset($p_js_function) ? $p_js_function : ''; ?>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="assets/js/fileupload/cors/jquery.xdr-transport.js"></script>
    <![endif]-->