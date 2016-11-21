<!--jquery.gritter plugins-->
<script type="text/javascript" src="<?php echo base_url(FOLDER_ADMIN_JS."/jquery.gritter.js"); ?>"></script>

<!-- Ajax save option -->
<script type="text/javascript">
$(document).ready(function(){


	//Process save information
	//Get form
	var form = $("#form1");
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



	//Process change password
	//Get form
	var form2 = $("#form2");
	//form submit
	form2.on("submit", function(){

		//ajax save option
		var request = $.ajax({
			  url: form2.attr("action"),
			  type: form2.attr("method"),
			  data: form2.serialize(),
			  dataType: "html"
			});

			//Request successs
			request.done(function( msg ) {
			  if(msg == '2'){	
			  	
			  	$.gritter.add({
		            // (string | mandatory) the heading of the notification
		            title: 'Message',
		            // (string | mandatory) the text inside the notification
		            text: 'Password is changed'
		        });

			  }
			  else
			  {
			  	$.gritter.add({
		            // (string | mandatory) the heading of the notification
		            title: 'Message',
		            // (string | mandatory) the text inside the notification
		            text: 'Password is not changed'
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

});
</script>