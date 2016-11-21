/*
 * jQuery File Upload Validation Plugin 1.1.3
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2013, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global define, require, window */

(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        // Register as an anonymous AMD module:
        define([
            'jquery',
            './jquery.fileupload-process'
        ], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS:
        factory(require('jquery'));
    } else {
        // Browser globals:
        factory(
            window.jQuery
        );
    }
}(function ($) {
    'use strict';

    // Append to the default processQueue:
    $.blueimp.fileupload.prototype.options.processQueue.push(
        {
            action: 'validate',
            // Always trigger this action,
            // even if the previous action was rejected: 
            always: true,
            // Options taken from the global options map:
            acceptFileTypes: '@',
            maxFileSize: '@',
            minFileSize: '@',
            maxNumberOfFiles: '@',
            disabled: '@disableValidation'
        }
    );

    // The File Upload Validation plugin extends the fileupload widget
    // with file validation functionality:
    $.widget('blueimp.fileupload', $.blueimp.fileupload, {

        options: {
            
            // The regular expression for allowed file types, matches
            // against either file type or file name:
            //acceptFileTypes: /(\.|\/)(jpe?g|jpg)$/i,
            // The maximum allowed file size in bytes:
            maxFileSize: 10000000, // 10 MB
            // The minimum allowed file size in bytes:
            minFileSize: undefined, // No minimal file size
            // The limit of files to be uploaded:
            maxNumberOfFiles: 4,
            

            // Function returning the current number of files,
            // has to be overriden for maxNumberOfFiles validation:
            getNumberOfFiles: $.noop,

            // Error and info messages:
            messages: {
                maxNumberOfFiles: 'Maximum number of files exceeded',
                acceptFileTypes: 'File type not allowed',
                maxFileSize: 'File is too large',
                minFileSize: 'File is too small',
                imageResolution: 'Image too large or too small'
            }
        },

        processActions: {
            validate: function (data, options) {             
                if (options.disabled) {
                    return data;
                }
                var dfd = $.Deferred(),
                    settings = this.options,
                    file = data.files[data.index],
                    fileSize,
                    fileWidth,
                    fileHeight;
                var canvas = file.preview;
                var hasCanvas = false;
                var imgRealWidth = image_width;
                var imgRealHeight = image_height;
                if(typeof canvas != "undefined")
                {
                    if(imgRealWidth <= 0) imgRealWidth = canvas.width;
                    if(imgRealHeight <= 0) imgRealHeight = canvas.height;
                    if(imgRealWidth > 192 || imgRealHeight > 192)
                    {
                        if(imgRealWidth > imgRealHeight)
                        {
                            canvas.style.width = "192px";
                            canvas.style.height = (192 * imgRealHeight / imgRealWidth).toString() + "px";
                        }
                        else
                        {
                            canvas.style.width = (192 * imgRealWidth / imgRealHeight).toString() + "px";
                            canvas.style.height = "192px";
                        }
                    }
                    hasCanvas = true;
                }
                if (options.minFileSize || options.maxFileSize) {
                    fileSize = file.size;
                }
                if(hasCanvas
                    && data.checkMaxWidth > 0 
                    && imgRealWidth > data.checkMaxWidth)
                {
                    file.error = settings.i18n("imageResolution");
                }
                
                else if(hasCanvas
                    && data.checkMinWidth > 0 
                    && imgRealWidth < data.checkMinWidth)
                {
                    file.error = settings.i18n("imageResolution");
                }

                else if(hasCanvas 
                    && data.checkMaxHeight > 0 
                    && imgRealHeight > data.checkMaxHeight)
                {
                    file.error = settings.i18n("imageResolution");
                }
                
                else if(hasCanvas 
                    && data.checkMinHeight > 0
                    && imgRealHeight < data.checkMinHeight)
                {
                    file.error = settings.i18n("imageResolution");
                }

                else if ($.type(options.maxNumberOfFiles) === 'number' &&
                        (settings.getNumberOfFiles() || 0) + data.files.length >
                            options.maxNumberOfFiles)
                {
                    file.error = settings.i18n('maxNumberOfFiles');
                }
                else if (options.acceptFileTypes &&
                        !(options.acceptFileTypes.test(file.type) ||
                        options.acceptFileTypes.test(file.name)))
                {
                    file.error = settings.i18n('acceptFileTypes');
                }
                else if (fileSize > options.maxFileSize) {                    
                    file.error = settings.i18n('maxFileSize');
                }
                else if ($.type(fileSize) === 'number' &&
                        fileSize < options.minFileSize) {
                    file.error = settings.i18n('minFileSize');
                }
                else
                {
                    delete file.error;
                }

                if (file.error || data.files.error) {
                    data.files.error = true;
                    dfd.rejectWith(this, [data]);
                } else {
                    dfd.resolveWith(this, [data]);
                }
                return dfd.promise();
            }

        }

    });

}));
