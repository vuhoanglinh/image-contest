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

    function getLengthPreview()
    {
        return $('.template-upload').length;
    }

    $('#ctn-photo-holder').hide();
    $('.fileupload-buttonbar .cancel').on('click',function(){
        $('#ctn-photo-holder').hide();
    });
	$("#fileupload").fileupload({
        url: 'upload/do_upload',
        dataType: 'json',
        dropZone: $('#drop'),
        downloadTemplateId: null,
        drop: function (e, data) {
            if(data.files.length + getLengthPreview() > 4) {
                $('#msg_max').show();
                $('#drop').addClass('max-img');
                $('input[type="file"]').remove();
                $('.btn-fileupload').remove();
                $('#ctn-photo-holder').remove();
            }
            if($('.error-item').length == 0) {
                $('#start').removeAttr('disabled');
                $('#msg_file').hide();
            }
        },
        change: function (e, data) {
            if(data.files.length + getLengthPreview() > 4) {
                $('#msg_max').show();
                $('#drop').addClass('max-img');
                $('input[type="file"]').remove();
                $('.btn-fileupload').remove();
                $('#ctn-photo-holder').remove();
            }
            if($('.error-item').length == 0) {
                $('#start').removeAttr('disabled');
                $('#msg_file').hide();
            }
        },
        done: function (e, data) {
            //console.log(data);
            if(data.result.success == 1)
            {
                window.location.href = "";
            }
        }

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
