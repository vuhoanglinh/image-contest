<!--ios7-->
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/ios-switch/switchery.js"); ?>" ></script>
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/ios-switch/ios-init.js"); ?>" ></script>
    
<!--icheck -->
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/iCheck/jquery.icheck.js"); ?>"></script>
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/icheck-init.js"); ?>"></script>

<!--spinner-->
<script type="text/javascript" src="<?php echo base_url(FOLDER_ADMIN_JS."/fuelux/js/spinner.min.js"); ?>"></script>
<script src="<?php echo base_url(FOLDER_ADMIN_JS."/spinner-init.js"); ?>"></script>

<!--pickers plugins-->
<script type="text/javascript" src="<?php echo base_url(FOLDER_ADMIN_JS."/bootstrap-datepicker/js/bootstrap-datepicker.js"); ?>"></script>
    
<!--pickers initialization-->
<script>
    $(function(){
    window.prettyPrint && prettyPrint();
        $('.default-date-picker').datepicker({
            format: 'mm/dd/yyyy'
        });
    });
</script>

<!--jquery.gritter plugins-->
<script type="text/javascript" src="<?php echo base_url(FOLDER_ADMIN_JS."/jquery.gritter.js"); ?>"></script>

<!-- ckfinder plugins -->
<script type="text/javascript" src="<?php echo base_url(FOLDER_ADMIN_JS."/ckfinder/ckfinder.js") ?>"></script>


<!-- Ajax save option -->
<script type="text/javascript">
$(document).ready(function(){

	//Setup ckfinder for logo and favicon
	//logo
	function setFileFieldLogo(fileUrl){
		$('#txt_logo').val(fileUrl);
	}
	//favicon
	function setFileFieldFavicon(fileUrl){
		$('#txt_favicon').val(fileUrl);
	}

	//btn_logo click
	$('#btn_logo').on("click", function(){
		var finder = new CKFinder();
	    finder.defaultLanguage = 'en';
	    finder.language = 'en';

		finder.selectActionFunction = setFileFieldLogo;
		finder.popup();
	});

	//btn_favicon click
	$('#btn_favicon').on("click", function(){
		var finder = new CKFinder();
	    finder.defaultLanguage = 'en';
	    finder.language = 'en';
		finder.selectActionFunction = setFileFieldFavicon;
		finder.popup();
	});


	//Get form
	var form = $("#form");
	//form submit
	form.on("submit", function(){

		//ajax save option
		var request = $.ajax({
			  url: form.attr("action"),
			  type: form.attr("method"),
			  data: form.serialize(),
			  dataType: "html"
			});

			//Request successs
			request.done(function( msg ) {
			  if(msg == '1'){	
			  	
			  	$.gritter.add({
		            // (string | mandatory) the heading of the notification
		            title: 'Message',
		            // (string | mandatory) the text inside the notification
		            text: 'Infomation is saved'
		        });

			  }
			  else
			  {
			  	$.gritter.add({
		            // (string | mandatory) the heading of the notification
		            title: 'Message',
		            // (string | mandatory) the text inside the notification
		            text: 'Infomation is not save'
		        });
			  }
			  console.log(msg);
			});
			 


			//Request fails
			request.fail(function( jqXHR, textStatus ) {
	  			console.log(textStatus);
			  	alert( "Request failed: " + textStatus );
			});
			return false;

		return false;
	});

	$('#btn_submit').on("click",function(){
		form.submit();
	});
});
</script>