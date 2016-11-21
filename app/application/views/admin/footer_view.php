</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/jquery-1.10.2.min.js"); ?>"></script>
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/jquery-ui-1.9.2.custom.min.js"); ?>"></script>
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/jquery-migrate-1.2.1.min.js"); ?>"></script>
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/modernizr.min.js"); ?>"></script>
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/jquery.nicescroll.js"); ?>"></script>

<!-- Jquery Cookie -->
<script type="text/javascript" src="<?php echo base_url(FOLDER_ADMIN_JS."/jquery.cookie.js") ?>"></script>

<!--common scripts for all pages-->
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/scripts.js"); ?>"></script>


<!-- Custom JS -->
<?php 
    echo (isset($p_js_view)) ? $p_js_view : "";
?>
</body>
</html>