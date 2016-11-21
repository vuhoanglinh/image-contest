<div id="ctn-body">
<div class="section-content-01">
<div class="lyt-list-thumbnails">
<ul class="control-bar">
<?php foreach($others as $img){ ?>
<li <?php if($img[DB_IMAGES_COL_ID] == $image[DB_IMAGES_COL_ID]) echo 'class="current"><a>'; else echo '><a href="' . $img[LINK] . '">'; ?><img src="<?php echo base_url($img[THUMB]); ?>" alt=""></a></li>
<?php } ?>
</ul>
<p class="prev-area">prev</p>
<p class="next-area">next</p>
</div><!-- /lyt-list-thumbnails -->



<section class="lyt-comment-image">
<div class="blk-user-infor">
<span class="box-avartar"><img src="<?php echo $image[DB_IMAGES_COL_AUTHOR][DB_USERS_COL_AVATAR]; ?>" alt=""></span>
<p class="box-user-name"><strong><?php echo $image[DB_IMAGES_COL_AUTHOR][DB_USERS_COL_NAME]; ?></strong></p>
</div><!-- /box-user-infor -->


<div class="lyt-comment-inner">
<figure class="box-main-image">
<p class="image-topic"><img src="<?php echo base_url($image[DB_IMAGES_COL_NAME]); ?>" alt=""></p>
<?php if(isset($around['pre'])) { ?>
<a href="<?php echo base_url($around['pre']); ?>" class="btn-prev">prev</a>
<?php }
if(isset($around['next'])) { ?>
<a href="<?php echo base_url($around['next']); ?>" class="btn-next">next</a>
<?php } ?>
</figure>

<div class="blk-social-infor cf">
<?php if(isset($image['isVoted']) AND $image['isVoted'] == true) {?>
<p class="box-vote"><a href="<?php echo $isVotedLink; ?>" class="iframe-max-vote">VOTE</a><span><?php echo $image[DB_IMAGES_COL_LIKES]; ?></span></p>
<?php } else { ?>
<p class="box-vote"><a href="<?php echo $isVotedLink; ?>" vote="true" data-url="<?php echo $image[VOTE]; ?>"  data-id="<?php echo $image[DB_IMAGES_COL_ID]; ?>">VOTE</a><span id="<?php echo 'vote_' . $image[DB_IMAGES_COL_ID]; ?>"><?php echo $image[DB_IMAGES_COL_LIKES]; ?></span></p>
<?php } ?>
<span class="share-title">Share This On:</span>
<ul class="list-social">
<li><a href="http://www.facebook.com/sharer.php?u=<?php echo $image[LINK]; ?>" class="btn-social"><i class="share-fb">facebook</i></a></li>
<li><a href="http://twitter.com/intent/tweet?text=I%20have%20joined%20i%2dstudio%2fi%2ddac%2fi%2dfactory%2fIFV%20photo%20contest%2e&url=<?php echo $image[LINK]; ?>" class="btn-social"><i class="share-tweet">tweet</i></a></li>
<li><a href="https://plus.google.com/share?url=<?php echo $image[LINK]; ?>" class="btn-social"><i class="share-gplus">gplus</i></a></li>
<li><a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $image[LINK]; ?>&media=&description=I%20have%20joined%20i%2dstudio%2fi%2ddac%2fi%2dfactory%2fIFV%20photo%20contest%2e" class="btn-social"><i class="share-pinterest">pinterest</i></a></li>
<li><a href="mailto:?body=<?php echo $image[LINK]; ?>" target="_blank"><i class="share-mail">mail</i></a></li>
</ul><!-- /list-social -->
</div><!-- /blk-social-infor -->


<div class="blk-list-comment">
<div class="box-comment-form cf">
<form>
<textarea rows="10" cols="10" id="comment"></textarea>
<input type="button" id="submit" value="Post Comment" class="btn-submit-01">
</form>
</div><!-- /box-comment-form -->


<div class="list-users-comment">

<?php foreach($image[COMMENT] as $comment) { ?>
<div class="items-comment">
<span class="users-avartar"><img src="<?php echo $comment[AVATAR]; ?>" alt=""></span>
<div class="comment-content">
<p class="comment-title"><?php echo $comment[AUTHOR]; ?></p>
<p><?php echo $comment[DB_COMMENTS_COL_CONTENT]; ?></p>
</div><!-- /comment-content -->
<?php if ($comment[IS_AUTHOR]) { ?>
<p class="comment-delete"><a data-action="delete" data-id="<?php echo $comment[DB_COMMENTS_COL_ID]; ?>" class="btn-submit-01">Delete</a></p>
<?php } ?>
</div><!-- /items-comment -->
<?php } ?>

</div><!-- /list-users-comment -->
<?php if(isset($isMore) AND $isMore) { ?>
<p class="txt-center"><a href="javascript:void(0)" id="more" class="btn-submit-01">More</a></p>
<?php }?>


</div><!-- /blk-list-comment -->
</div><!-- /lyt-comment-inner -->
</section><!-- /lyt-comment-image -->
</div><!-- /section-content-01 -->


<script type="text/javascript">
var malvoted 	 = "<?php echo $isVotedLink; ?>";
var checklogin 	 = <?php echo $checklogin; ?>;
var json_comment = {};
var url_post_comment 	= "<?php echo base_url('actions/comment'); ?>";
var url_delete_comment 	= "<?php echo base_url('actions/delete_comment'); ?>";
var url_more_comment 	= "<?php echo base_url('actions/more_comment'); ?>";
var current_id 			= <?php echo $image[DB_IMAGES_COL_ID] ?>;
var last_id 			= <?php echo $last_id; ?>;
var first_id 			= <?php echo $first_id; ?>;
$(document).ready(function(){

	function templateComment(msg)
	{
		var comment = '';
		if(msg.comments.length > 0)
		{
			$.each(msg.comments, function(i, item) {
				comment += '<div class="items-comment">';
				comment += '<span class="users-avartar"><img src="'+ item.avatar +'" alt=""></span>';
				comment += '<div class="comment-content">';
				comment += '<p class="comment-title">'+ item.author + '</p>';
				comment += '<p>'+ item.CommentContent +'</p>';
				comment += '</div>';

				if(item.is_author == true)
				{
					comment += '<p class="comment-delete"><a data-action="delete" data-id="'+ item.id +'" class="btn-submit-01">Delete</a></p>';
				}

				comment += '</div>';			
			});
		}
		return comment;
	}
	//show comment after post comment
	var postComment 	= {
		setInit : function(msg){
			last_id 	= msg.last_id;
			var comment = templateComment(msg);
			$('.list-users-comment').prepend(comment);
			$('#comment').val('');
		}
	}

	var moreComment 	= {
		setInit : function(msg){
			first_id 	= msg.first_id;
			var comment = templateComment(msg);
			$('.list-users-comment').append(comment);
			if(msg.more == false)
			{
				$('#more').remove();
			}
		}
	}

	//vote
	$( document ).on( 'click','a[vote="true"]', function(){
		var $this = $(this);
	//debugger;
		if(checklogin != 1) 
		{
			$('.btn-login').click();
		}
		else if ($this.hasClass('iframe-max-vote'))
		{
			$.colorbox({
				iframe:true,
				innerWidth:700, 
				innerHeight:149,
				href: malvoted
				});
		}
		else
		{
			$this.addClass('iframe-max-vote cboxElement');
			vote($this.attr('data-url'), $this.attr('data-id'), $(this), 'iframe-max-vote cboxElement');
		}
		return false;
	});

	$( document ).on( 'focus', '#comment', function(){
		if(checklogin != 1) 
		{
			$('.btn-login').click();
		}
	});

	//post comments
	$( document ).on( 'click','#submit', function(){

		if(checklogin != 1) 
		{
			$('.btn-login').click();
		}
		else
		{
			if($('#comment').val() != '') {
				getcomments(url_post_comment, current_id, $('#comment').val(), last_id, postComment);				
			}
		}
	});
	//get more comment
	$( document ).on( 'click','#more', function(){
		getmore(url_more_comment,current_id, first_id, moreComment);
		
	});

	//delete comment
	$( document ).on( 'click', '[data-action="delete"]', function(){
		delete_comments(url_delete_comment, $(this).attr('data-id'), $(this).parents('.items-comment'));
	});
});
</script>