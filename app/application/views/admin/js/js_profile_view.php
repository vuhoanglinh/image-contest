<!--jquery.gritter plugins-->
<script type="text/javascript" src="<?php echo base_url(FOLDER_ADMIN_JS."/jquery.gritter.js"); ?>"></script>

<script type="text/javascript">

    $(document).ready(function(){
        
        if($('a[data-toggle="modal"]').length > 0) {

            $('a[data-toggle="modal"]').on("click", function(){
                console.log(1);
                var img =  $(this).children('img').attr('source');
                $('.img-modal > img').attr('src', img);
            });
        }

    });
</script>