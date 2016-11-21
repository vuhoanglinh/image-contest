<div id="ctn-body">
<div id="ctn-visual">
<h1 class="box-title">JOIN THE PHOTO CONTEST</h1>
<div class="box-list-btn">    
<?php if(isset($this->session->userdata[SESSION_USER_ID])){ ?>
<a href="<?php echo base_url('upload.html'); ?>" class="btn-upload" style="width:200px"><strong>UPLOAD</strong></a>
<?php } else { ?>
<a href="<?php echo base_url('login.html'); ?>" class="btn-upload iframe"><strong>LOG IN</strong> and <strong>UPLOAD</strong></a>
<?php } ?>
<span class="connect-char">or</span>
<a class="btn-post">Post on <strong>Instagram/Twitter</strong><br>with <strong>#PhotoCon</strong></a>
</div>
</div><!-- /ctn-visual -->
<div class="lyt-list-figure cf">
<?php foreach($gallery as $image){ ?>
<div class="lyt-item">
<p class="item-title"><span class="avartar-image"><img src="<?php echo $image[DB_IMAGES_COL_AUTHOR][DB_USERS_COL_AVATAR]; ?>" alt=""></span><?php echo $image[DB_IMAGES_COL_AUTHOR][DB_USERS_COL_NAME]; ?></p>
<figure class="post-image"><a href="<?php echo $image[LINK]; ?>" style="background: url(<?php echo $image[THUMB]; ?> );width: 100%;height: 100%;background-size: cover;background-repeat: no-repeat;"></a></figure>
<div class="item-utility">

<!--<p class="blk-vote"><a href="#" vote="true" data-url="<?php echo base_url($image[VOTE]); ?>" class="iframe-max-vote" data-id="<?php echo $image[DB_IMAGES_COL_ID]; ?>">VOTE</a><span id="<?php echo 'vote_' . $image[DB_IMAGES_COL_ID]; ?>"><?php echo $image[DB_IMAGES_COL_LIKES]; ?></span></p>!-->
<?php if(isset($image['isVoted']) AND $image['isVoted'] == true) {?>
<p class="blk-vote"><a href="<?php echo $isVotedLink; ?>" class="iframe-max-vote">VOTE</a><span><?php echo $image[DB_IMAGES_COL_LIKES]; ?></span></p>
<?php } else { ?>
<p class="blk-vote"><a href="<?php echo $isVotedLink;  ?>" vote="true" data-url="<?php echo $image[VOTE]; ?>"  data-id="<?php echo $image[DB_IMAGES_COL_ID]; ?>">VOTE</a><span id="<?php echo 'vote_' . $image[DB_IMAGES_COL_ID]; ?>"><?php echo $image[DB_IMAGES_COL_LIKES]; ?></span></p>
<?php } ?>
<a class="btn-list-share">share</a>
<ul class="list-social">
<li><a href="http://www.facebook.com/sharer.php?u=<?php echo base_url($image['link']); ?>" class="btn-social"><i class="share-fb">facebook</i></a></li>
<li><a href="http://twitter.com/intent/tweet?text=I%20have%20joined%20i%2dstudio%2fi%2ddac%2fi%2dfactory%2fIFV%20photo%20contest%2e&url=<?php echo base_url($image['link']); ?>" class="btn-social"><i class="share-tweet">tweet</i></a></li>
<li><a href="https://plus.google.com/share?url=<?php echo base_url($image['link']); ?>" class="btn-social"><i class="share-gplus">gplus</i></a></li>
<li><a href="https://www.pinterest.com/pin/create/button/?url=<?php echo base_url($image['link']); ?>&media=&description=I%20have%20joined%20i%2dstudio%2fi%2ddac%2fi%2dfactory%2fIFV%20photo%20contest%2e" class="btn-social"><i class="share-pinterest">pinterest</i></a></li>
<li><a href="mailto:?body=<?php echo $image['link']; ?>" target="_blank"><i class="share-mail">mail</i></a></li>
</ul><!-- /list-social -->
</div><!-- /item-utility -->
</div><!-- /lyt-item -->
<?php } ?>

</div><!-- /lyt-list-figure -->

<ul class="blk-pagging">
<?php if($currentPage > 1){ ?>
<li><a href="<?php echo base_url('gallery/page_' . ($currentPage - 1)); ?>">Prev</a></li>
<?php } ?>
<li <?php if($currentPage == 1) echo 'class="stay"'; ?>><a href="<?php echo base_url('gallery/page_1'); ?>">1</a></li>
<?php
if($dotPre) echo '<span style="color:white;font-size: 20px;"> ... </span>';

if(isset($startPage, $endPage))
{
for($i = $startPage; $i <= $endPage; $i++){ ?>
<li <?php if($i == $currentPage) echo 'class="stay"'; ?>><a href="<?php echo base_url('gallery/page_' . $i); ?>"><?php echo $i; ?></a></li>
<?php }
if($dotNext) echo '<span style="color:white;font-size: 20px;"> ... </span>';
} if($totalPage > 1){?>
<li <?php if($totalPage == $currentPage) echo 'class="stay"'; ?>><a href="<?php echo base_url('gallery/page_' . $totalPage); ?>"><?php echo $totalPage; ?></a></li>
<?php }
if($currentPage < $totalPage) { ?>
<li><a href="<?php echo base_url('gallery/page_' . ($currentPage + 1)); ?>">Next</a></li>
<?php } ?>
</ul><!-- end pagging -->

<script type="text/javascript">
var modalvoted   = "<?php echo $isVotedLink; ?>";
var checklogin 	 = <?php echo $checklogin; ?>;
	$(document).ready(function(){
		//vote
		$( document ).on( 'click','a[vote="true"]', function(){		
			var $this = $(this);			
			if(checklogin != 1) 
			{
				$('.btn-login').click();
			}
			else if ($this.hasClass('iframe-max-vote'))
			{				
				$('.iframe-max-vote').colorbox({
				iframe:true,
				innerWidth:700, 
				innerHeight:149,
				href: modalvoted 
				});
			}
			else
			{
				$this.addClass('iframe-max-vote cboxElement');
				vote($this.attr('data-url'), $this.attr('data-id'), $(this), 'iframe-max-vote');
			}
			return false;
		});
	});
</script>