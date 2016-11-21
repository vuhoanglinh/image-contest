<script type="text/javascript">
/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */
var max_image = <?php echo $p_setting['st_max_image'] ?>;
var image_width = 0;
var image_height = 0;

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    //$('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        //url: 'server/php/'
    //});
    $(document).bind('drop dragover', function (e) {
        // Prevent the default browser drop action:
        e.preventDefault();
    });
	$('#drop').click(function(){
            $('#file').click();
            return false;
        });

    maximum_image(max_image);
    function maximum_image(maximage)
    {
        if(maximage == 0) 
        {
            $('#msg_max').show();
            $('#drop').addClass('max-img');
            $('input[type="file"]').hide();
            $('.btn-fileupload').hide();
            $('#ctn-photo-holder').hide();
        } 
        else
        {
            $('#msg_max').hide();
            $('#drop').removeClass('max-img');
            $('#start').removeAttr('disabled');
            $('input[type="file"]').show();
            $('.btn-fileupload').show();
        }
    }    

    function getLengthPreview()
    {
        return $('.template-upload').length;
    }

    $('#ctn-photo-holder').hide();
    $('.fileupload-buttonbar .cancel').on('click',function(){
        $('#ctn-photo-holder').hide();
        maximum_image(max_image);
    });


    var $acceptFileTypes = "(\\.|\\/)(<?php echo $p_setting['st_extention']; ?>)$";
    var $maxwidth        = <?php echo is_numeric($p_setting['st_max_width']) ? $p_setting['st_max_width'] : 0; ?>;
    var $maxheight       = <?php echo is_numeric($p_setting['st_max_height']) ? $p_setting['st_max_height'] : 0; ?>;
    var $minwidth        = <?php echo is_numeric($p_setting['st_min_width']) ? $p_setting['st_min_width'] : 0; ?>;
    var $minheight       = <?php echo is_numeric($p_setting['st_min_height']) ? $p_setting['st_min_height'] : 0; ?>;
    var $maxFileSize     = <?php echo is_numeric($p_setting['st_max_size']) ? $p_setting['st_max_size'] : 0; ?>;
	$("#fileupload").fileupload({
        url: 'upload/do_upload',
        dataType: 'json',
        checkMaxWidth:$maxwidth ,
        checkMinWidth:$minwidth,
        checkMaxHeight: $maxheight,
        checkMinHeight: $minheight ,
        maxNumberOfFiles: 10,
        maxFileSize: $maxFileSize * 1000000,
        dropZone: $('#drop'),
        acceptFileTypes: new RegExp($acceptFileTypes, "i"),
        //loadImageFileTypes:, /(.)+/i,
        downloadTemplateId: null,
        // The add callback is invoked as soon as files are added to the fileupload
            // widget (via file input selection, drag & drop or add API call).
            // See the basic file upload widget for more information:
            add: function (e, data) {
                if (e.isDefaultPrevented()) {
                    return false;
                }
                var $this = $(this),
                    that = $this.data('blueimp-fileupload') ||
                        $this.data('fileupload'),
                    options = that.options;
                data.context = that._renderUpload(data.files)
                    .data('data', data)
                    .addClass('processing');
                //console.log(data);

                options.filesContainer[
                    options.prependFiles ? 'prepend' : 'append'
                ](data.context);                
                that._forceReflow(data.context);
                that._transition(data.context);
                data.process(function () {
                    return $this.fileupload('process', data);
                }).always(function () {
                    data.context.each(function (index) {
                        $(this).find('.size').text(
                            that._formatFileSize(data.files[index].size)
                        );
                    }).removeClass('processing');
                    that._renderPreviews(data);
                }).done(function () {
                    data.context.find('.start').prop('disabled', false);
                    if ((that._trigger('added', e, data) !== false) &&
                            (options.autoUpload || data.autoUpload) &&
                            data.autoUpload !== false) {
                        data.submit();
                    }
                }).fail(function () {
                    if (data.files.error) {                       
                        data.context.each(function (index) {
                            var error = "Please check your photo and upload regulation.";                          
                            if (data.files[index].error != 'Maximum number of files exceeded') {
                                if(!$('#msg_file_max').is(':visible'))
                                {
                                    $('#start').attr('disabled','disabled');
                                    $('#msg_file').show();
                                }
                                $(this).find('.error').parent().addClass('error-item');
                                $(this).find('.error').html('<b>Error:</b>'+error);
                            }
                        });
                    }
                });     
            },
        drop: function (e, data) {
            if(data.files.length + getLengthPreview() > max_image) {               
                $('#start').attr('disabled','disabled');
                $('#msg_max').show();
                $('#msg_file_max').show();
                $('#msg_file').hide();
                $('#drop').addClass('max-img');
                $('input[type="file"]').hide();
                $('.btn-fileupload').hide();
                //$('#ctn-photo-holder').remove();
            }            
            if($('.error-item').length == 0) {
                $('#start').removeAttr('disabled');
                $('#msg_file').hide();
                //$('#msg_file_max').hide();
            }
        },
        change: function (e, data) {
            if(data.files.length + getLengthPreview() > max_image) {                
                $('#start').attr('disabled','disabled');
                $('#msg_max').show();
                $('#msg_file_max').show();
                $('#msg_file').hide();
                $('#drop').addClass('max-img');
                $('input[type="file"]').hide();
                $('.btn-fileupload').hide();
                //$('#ctn-photo-holder').remove();
            }
            if($('.error-item').length == 0) {
                $('#start').removeAttr('disabled');
                $('#msg_file').hide();
                $('#msg_file_max').hide();
            }
        },       
        done: function (e, data) {
            //console.log(data);
            if(data.result.success == getLengthPreview())
            {
               window.location.href = "";
               console.log(data.result.success);
            }
            $('.template-upload:nth-child('+ data.result.success +')').hide();
        }

    });
    
    $('#fileupload').bind('fileuploadsubmit', function (e, data) {
        // The example input, doesn't have to be part of the upload form:
        var input = $('#input');
        data.formData = {imgs: getLengthPreview()};        
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

});


$(document).ready(function(){

    $('[action="del"]').on('click', function(){
        var countimg = $('[action="del"]').length;
        var $button =   $(this);
        var $id     =   $button.attr('data-id');

        var request = $.ajax({
          url: "<?php echo base_url('delete'); ?>",
          type: "POST",
          data: { id : $id },
          dataType: "html"
        });
         
        request.done(function( msg ) {

            if(msg === "1") {
                $button.parents('li').remove();
                max_image++;
            }

            
            if($('[action="del"]').length < countimg)
            {
                //$('#ctn-photo-holder').hide();
                $('#msg_max').hide();
                $('#drop').removeClass('max-img');
                $('#start').removeAttr('disabled');
                $('input[type="file"]').show();
                $('.btn-fileupload').show();
            }

            console.log(msg);
        });
         
        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });

        return false;
   });

});

</script>


