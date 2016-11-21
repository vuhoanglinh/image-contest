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


        //ajax action
        $('a.action').on('click', function(){

            console.log($(this).attr('data-id'));
            console.log($(this).attr('data-hidden'));

            var status  = $(this).attr('data-hidden');
            var selector = "#" + $(this).attr('data-change');
            var button   =   $(this);
            var request = $.ajax({
              url: "<?php echo base_url('admin/images/status'); ?>",
              type: 'post',
              data: {'p_id' : $(this).attr('data-id'), 'p_status' : $(this).attr('data-hidden')},
              dataType: "html"
            });

            //Request successs
            request.done(function( msg ) {
              if(msg == 1){                   

                if(status == <?php echo IMAGE_HIDDEN; ?>) { 

                    //change status view                   
                    $(selector).html('Hidden');
                    $(selector).removeClass('label-info');
                    $(selector).addClass('label-default');

                    //change button
                    button.html('Show');
                    button.addClass('btn-info');
                    button.removeClass('btn-default');
                    button.attr('data-hidden', <?php echo IMAGE_NOT_HIDDEN; ?>);                    
                }
                else
                {
                    //change status view
                    $(selector).html('Show');
                    $(selector).addClass('label-info');
                    $(selector).removeClass('label-default');

                    //change button
                    button.html('Hide');
                    button.addClass('btn-default');
                    button.removeClass('btn-info');
                    button.attr('data-hidden', <?php echo IMAGE_HIDDEN; ?>);

                    
                }

                $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Message',
                    // (string | mandatory) the text inside the notification
                    text: 'Status image is changed'
                });

              }
              else
              {
                $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Message',
                    // (string | mandatory) the text inside the notification
                    text: 'Status image is not changed'
                });
              }
              console.log(msg);
            });
             


            //Request fails
            request.fail(function( jqXHR, textStatus ) {
                console.log(textStatus);
                alert( "Request failed: " + textStatus );
            });


        });

    });
</script>