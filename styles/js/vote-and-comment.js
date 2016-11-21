function vote(voteUrl, imgId, element, $class)
{
	voteSuccess(imgId, true);
	element.addClass($class);

	$.ajax({
		url: voteUrl,
		type: 'GET',
		success: function(result){
			//console.log(result);
			if(result != 'success')
				voteSuccess(imgId, false);
				
		}
	});
}

function voteSuccess(imgId, add)
{
	var voted = +($("#vote_" + imgId).html());
	if(add) voted = voted + 1;
	else voted = voted - 1;
	$("#vote_" + imgId).html(voted);
}

function isEmpty(obj) {
    return Object.keys(obj).length === 0;
}


function getcomments($url, $currentid, $comment, $lastid, showComment)
{
    var request = $.ajax({
      url: $url,
      type: "POST",
      data: {currentId: $currentid, lastId : $lastid, comment: $comment},
      dataType: "json"
    });

    request.done(function( msg ) {
      console.log(msg);
      showComment.setInit(msg);
    });

    request.fail(function( jqXHR, textStatus ) {
      console.log( "Request failed: " + textStatus );
    });
    
}

function getmore($url, $currentid, $firstId, showComment)
{
    var request = $.ajax({
      url: $url,
      type: "POST",
      data: {currentId: $currentid, firstId : $firstId},
      dataType: "json"
    });

    request.done(function( msg ) {
      console.log(msg);
      showComment.setInit(msg);
    });

    request.fail(function( jqXHR, textStatus ) {
      console.log( "Request failed: " + textStatus );
    });
}

function delete_comments($url, $id, $element)
{
    var request = $.ajax({
      url: $url,
      type: "POST",
      data: { id : $id},
      dataType: "html"
    });

    request.done(function( msg ) {
      console.log(msg);
      $element.remove();
    });

    request.fail(function( jqXHR, textStatus ) {
      console.log( "Request failed: " + textStatus );
    });
    
}