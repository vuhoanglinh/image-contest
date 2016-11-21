<!--jquery.gritter plugins-->
<script type="text/javascript" src="<?php echo base_url(FOLDER_ADMIN_JS."/jquery.gritter.js"); ?>"></script>

<script type="text/javascript">

    $(document).ready(function(){

        //ajax action
        $('a.action').on('click', function(){

            console.log($(this).attr('data-id'));
            console.log($(this).attr('data-hidden'));
            var username = $(this).parent().parent().find('.username').html();

            if(confirm("Do you want to change " + username + " status?"))
            {
                var status      = $(this).attr('data-hidden');
                var selector    = "#" + $(this).attr('data-change');
                var button      = $(this);
                var request     = $.ajax({
                  url: "<?php echo base_url('admin/contestants/status'); ?>",
                  type: 'post',
                  data: {'p_id' : $(this).attr('data-id'), 'p_status' : $(this).attr('data-hidden')},
                  dataType: "html"
                });

                //Request successs
                request.done(function( msg ) {
                  if(msg == 1){                   

                    if(status == <?php echo USER_BANNED; ?>) { 

                        //change status view                   
                        $(selector).html('Banned');
                        $(selector).removeClass('label-info');
                        $(selector).addClass('label-default');

                        //change button
                        button.html('Allow');
                        button.addClass('btn-info');
                        button.removeClass('btn-default');
                        button.attr('data-hidden', <?php echo USER_NOT_BANNED; ?>);                    
                    }
                    else
                    {
                        //change status view
                        $(selector).html('Allowed');
                        $(selector).addClass('label-info');
                        $(selector).removeClass('label-default');

                        //change button
                        button.html('Ban');
                        button.addClass('btn-default');
                        button.removeClass('btn-info');
                        button.attr('data-hidden', <?php echo USER_BANNED; ?>);

                        
                    }

                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Message',
                        // (string | mandatory) the text inside the notification
                        text: 'Status contestant is changed'
                    });

                  }
                  else
                  {
                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'Message',
                        // (string | mandatory) the text inside the notification
                        text: 'Status contestant is not changed'
                    });
                  }
                  console.log(msg);
                });
                 


                //Request fails
                request.fail(function( jqXHR, textStatus ) {
                    console.log(textStatus);
                    alert( "Request failed: " + textStatus );
                });
            }
        });

    });
</script>