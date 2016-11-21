
<script type="text/javascript">

	$(document).ready(function(){
		
		var form = $("#<?php echo isset($id_form) ? $id_form : ""; ?>");
		form.on("submit", function(){

			var request = $.ajax({
			  url: form.attr("action"),
			  type: form.attr("method"),
			  data: form.serialize(),
			  dataType: "html"
			});
			 
			//Request successs
			request.done(function( msg ) {
			  if(msg == '1'){	
			  	window.location.href = "<?php echo isset($url) ? $url : 'admin'; ?>";
			  }
			  else
			  {
			  	$("#msg").html("<?php echo $msg_error; ?>").fadeIn("fast");
			  }
			  console.log(msg);
			  setTimeout(function(){ $("#msg").fadeOut("fast") }, 3000);
			});
			 


			//Request fails
			request.fail(function( jqXHR, textStatus ) {
	  			console.log(textStatus);
			  	alert( "Request failed: " + textStatus );
			});
			return false;
		});
		
	});
</script>