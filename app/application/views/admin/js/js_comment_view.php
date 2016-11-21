<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('click', 'a.action', function(){
            var $this = $(this);
            var request = $.ajax({
              url: "<?php echo base_url('actions/delete_comment'); ?>",
              type: "POST",
              data: { id : $(this).attr('data-id')},
              dataType: "html"
            });

            request.done(function( msg ) {
              console.log(msg);
              $this.parent().parent().remove();
            });

            request.fail(function( jqXHR, textStatus ) {
              console.log( "Request failed: " + textStatus );
            });

        });
        
    });
    </script>