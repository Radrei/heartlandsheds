<?php //popup for slider ?>
<div class="overlay"></div>
<?php if( have_rows('variation_data') ): ?>
	<?php while( have_rows('variation_data') ): the_row();

		// display a sub field value
		$id = get_sub_field('variation_name');
		$images = get_sub_field('gallery');		
		$video = get_sub_field('video');
		$thumb = get_sub_field('video_thumbnail');
	?>
	<div class="popup" id="pop<?php echo $id; ?>">
		<a href="#" class="close product-gallery-lightbox-close"><span class="hidden">Close</span></a>
		<ul class="popup-dots">
			<?php 
			$images = get_sub_field('gallery');
			if( $images ):
			$counter = 1; ?>
			<?php foreach( $images as $image ): 
			$counter++; ?>
			<li><a class="popup-dot" href="#popup-thumb-<?php echo $id; ?>-<?php echo $counter; ?>"></a></li>
			<?php endforeach; ?>
			<?php endif; ?>
		</ul>
		<?php 
		$images = get_sub_field('gallery');
		if( $images ):
		$counter = 1;
		?>
			<?php foreach( $images as $image ): 
			$counter++;
			$url = $image["filename"];
			$filetype = wp_check_filetype( $url );
			?>
			<?php if($filetype['ext'] == 'mp4') {?>
				<div class="popup-thumbnail" id="popup-thumb-<?php echo $id; ?>-<?php echo $counter; ?>">
					<video controls>
						<source src="<?php echo $image['url']; ?>">
						Your browser does not support this video type.
					</video>
				</div>
			<?php } else{ ?>
				<div class="popup-thumbnail" id="popup-thumb-<?php echo $id; ?>-<?php echo $counter; ?>">
					<img src="<?php echo $image['url']; ?>" />
				</div>
			<?php } ?>			
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<?php endwhile; 
endif; ?>

<?php //slider ?>
<?php if( have_rows('variation_data') ): ?>
	<?php while( have_rows('variation_data') ): the_row();

		// display a sub field value
		$id = get_sub_field('variation_name');
		$video = get_sub_field('video');
		$thumb = get_sub_field('video_thumbnail');
	?>
	
	<div class="product-gallery cf" id="gal<?php echo $id; ?>">
		<?php 
		$images = get_sub_field('gallery');
		if( $images ):
		$counter = 1;
		?>
		<div class="thumbnails">
			<?php if($video){ //360 video ?>				
				<div class="thumbnail product-video-thumbnail" data-thumbnail="thumbnail1">
					<span class="product-video-thumbnail-overlay"></span>
					<img src="<?php echo $thumb['url']; ?>" alt="<?php echo $thumb['alt']; ?>" />
				</div>
			<?php } ?>
			
			<?php foreach( $images as $image ): 
			$counter++;
			$url = $image["filename"];
			$filetype = wp_check_filetype( $url );
			?>
			<?php if($filetype['ext'] == 'mp4') {?>
				<div class="thumbnail" data-thumbnail="thumbnail<?php echo $counter; ?>">
					<video>
						<source src="<?php echo $image['url']; ?>">
						Your browser does not support this video type.
					</video>
				</div>
			<?php } else{ ?>
				<div class="thumbnail" data-thumbnail="thumbnail<?php echo $counter; ?>">
					<img src="<?php echo $image['url']; ?>" />
				</div>
			<?php } ?>			
			<?php endforeach; ?>
			<?php $numGallery = count( $images ); 
				if ($numGallery > 7){ 
					$moreImages = $numGallery - 6;
				?>
					<a class="more" href="#popup-thumb-<?php echo $id; ?>-7">+<?php echo $moreImages; ?></a>
				<?php }
			?>
		</div>
		<?php endif; 
		if( $images ):
		$counter = 1;
		?>
		<div class="main-img">
			<?php if($video){//360 video ?>	
				<a class="main-thumb" data-thumbnail="thumbnail1" href="#popup-thumb-<?php echo $id; ?>-1">
					<video playsinline autoplay muted loop>
						<source src="<?php echo $video; ?>">
						Your browser does not support this video type.
					</video>
				</a>
			<?php } ?>
			<?php foreach( $images as $image ):
			$counter++;
			$url = $image["filename"];
			$filetype = wp_check_filetype( $url );
			?>
			<?php if($filetype['ext'] == 'mp4') {?>
				<a class="main-thumb" data-thumbnail="thumbnail<?php echo $counter; ?>" href="#popup-thumb-<?php echo $id; ?>-<?php echo $counter; ?>">
					<video controls>
						<source src="<?php echo $image['url']; ?>">
						Your browser does not support this video type.
					</video>
				</a>
			<?php } else{ ?>
				<a class="main-thumb" data-thumbnail="thumbnail<?php echo $counter; ?>" href="#popup-thumb-<?php echo $id; ?>-<?php echo $counter; ?>">
					<img src="<?php echo $image['url']; ?>" />
				</a>
			<?php } ?>			
			<?php endforeach; ?>
		</div>
		<div class="gallery-disclaimer"><?php echo the_field('disclaimer'); ?></div>
		<?php endif; ?>
	</div>
	<?php //mobile gallery ?>
	<div class="product-gallery mobile-product-gallery cf" id="mobile-gal<?php echo $id; ?>">
		<?php 
		$images = get_sub_field('gallery');
		if( $images ): ?>
		<ul class="product-gallery-main-img" id="mobile-slider-for<?php echo $id; ?>">
			<?php foreach( $images as $image ):
			$counter++;
			$url = $image["filename"];
			$filetype = wp_check_filetype( $url );
			?>
			<?php //Don't show videos on mobile 
			if($filetype['ext'] !== 'mp4') {?>
				<li class="product-gallery-main-img">
					<a class="product-lightbox-trigger" data-trigger="<?php echo $id; ?>" href="javascript:void(0);"><img data-lazy="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a>
				</li>
			<?php } ?>					
			<?php endforeach; ?>
		</ul>
		<div class="gallery-disclaimer"><?php echo the_field('disclaimer'); ?></div>
		<?php endif; ?>
	</div>
	<?php endwhile; endif; ?>
  
  <?php //styles for slider/popups ?>
  <style>
		.main{
			box-sizing: border-box;
			padding: 2em;
		}
		.thumbnails {
			float: left;
			position: relative;
			width: 100px;
			z-index: 0;
		}
		.thumbnails .thumbnail:nth-child(n + 8){
			display: none !important;
		}
		.thumbnail{
			background: white;
			border: 2px solid white !important;
			cursor: pointer;
			display: -webkit-inline-box !important;
			display: flex !important;
			-webkit-box-align: center;
			align-items: center;
			-webkit-box-pack: center;
			justify-content: center;
			height: 75px !important;
			position: relative;
			width: 71px !important;
			z-index: 1;
		}
		.thumbnail:hover{
			border-color: black !important;
		}
		.main-img {
			float: left;
			height: auto;
			list-style: none;
			max-width: 600px;
			width: calc(100% - 100px);
		}
		.main-thumb {
			display: block;
			cursor: pointer;
			width: 100%;
		}
		.main-thumb:nth-child(n+2){
			display: none;
		}
		.popup{
			background: #fff;
			box-sizing: border-box;
			display: none;
			height: 100%;
			overflow-x: scroll;
			padding: 2em 0;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			z-index: 1000;
		}
		.popup .popup-thumbnail{
			border-bottom: 10px solid #b4b4b4;
			display: block;
			margin: 1em auto;
			padding: 1em;
			text-align: center;
		}
		.popup-thumbnail * {
			max-width: 80% !important;
		}
		a.more {
			background: rgba(255,255,255,0.7);
			color: black;
			display: block;
			height: 75px;
			margin-top: -78px;
			margin-left: 2px;
			text-align: center;
			width: 71px !important;
			z-index: 2;
			position: relative;
			font-size: 2em;
			text-decoration: none;
			font-weight: bold;
			padding-top: 15px;
			box-sizing: border-box;
		}
		.popup-dots{
			position: fixed;
			left: 20px;
		}
		.popup-dots li{
			list-style-type: none;
		}
		.popup-dot{
			background-color: #b4b4b4;
			border-radius: 100%;
			border-width: 0;
			display: block;
			height: 12px;
			margin: 1em 0;
			-webkit-transition: background-color .2s ease;
			transition: background-color .2s ease;
			width: 12px;
		}
		video {
			max-width: 100%;
		}
		@media screen and (max-width: 1024px){	
			.product-gallery:not(.mobile-product-gallery){
				display: none !important;
			}
		}
		@media screen and (max-width: 640px){
			.popup-dot{
				height: 20px;
				width: 20px;
			}
		}
	</style>
  
  <?php //scripts for gallery (depends on slick slider) ?>
  <script>
jQuery(document).ready(function( $ ) {	
	/*Sync the form with the woocommerce attributes*/
	$('.variable-item').click(function() {
		var liSelected = $(this).data("value");
		$('input[value=' + liSelected + ']').attr('checked','checked');
		/*Change content based on variation selected*/
		$('.product-gallery:not(#gal' + liSelected + ')').hide();
		$('.product-gallery:not(#mobile-gal' + liSelected + ')').hide();
		$('#var' + liSelected).show();
		$('#li' + liSelected).css('display', 'inline-block');
		$('.product-gallery#gal'  + liSelected).show();
		$('.product-gallery#gal'  + liSelected).css('opacity', '1');
		
		jQuery(window).on('resize',function(){
			 var viewportWidth = jQuery(window).width();

			 if (viewportWidth < 1025){  
				$('#slider-nav' + liSelected).slick('unslick');
			 }
		});
		
		if (viewportWidth < 1025){			
			$('#mobile-gal' + liSelected).show();
			$('.product-gallery#mobile-gal' + liSelected).css('opacity', '1');
			$('#mobile-slider-for' + liSelected).slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				prevArrow: '<i class="fa fa-angle-left left-arrow"></i>',
				nextArrow: '<i class="fa fa-angle-right right-arrow"></i>',
				fade: true,
				autoplay: false
			});
		}
		
		$('.main-thumb').click(function(){
			var href = $(this).attr('href');
			$('.popup#pop' + liSelected).show();
			$('.popup-dot[href=' + href + ']').trigger('click');
			console.log(href);
		});
		$('.more').click(function(){
			$('.popup#pop' + liSelected).show();
		});	
		});
	//On mobile
	var viewportWidth = jQuery(window).width();
	if (viewportWidth < 1025){
		$('.variable-items-wrapper').on('touchstart', '.variable-item', function(){
			var liSelected = $(this).data("value");
			$('input[value=' + liSelected + ']').attr('checked','checked');
			//Change content based on variation selected
			$('.product-gallery:not(#gal' + liSelected + ')').hide();
			$('.product-gallery:not(#mobile-gal' + liSelected + ')').hide();
			$('#var' + liSelected).show();
			$('#mobile-gal' + liSelected).show();
			$('.product-gallery#mobile-gal' + liSelected).css('opacity', '1');
			
			jQuery(window).on('resize',function(){
				 var viewportWidth = jQuery(window).width();

				 if (viewportWidth < 1025){  
					$('#slider-nav' + liSelected).slick('unslick');
					$('#slider-for' + liSelected).slick('unslick');
				 }
			});
			//Initialize the slider
			$('#mobile-slider-for' + liSelected).slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				prevArrow: '<i class="fa fa-angle-left left-arrow"></i>',
				nextArrow: '<i class="fa fa-angle-right right-arrow"></i>',
				fade: true,
				autoplay: false
			});
		});
	}
	//Initialize the current variation's gallery on page load
	setTimeout(function() {
		$('.variable-item.selected').trigger('click');
    },10);	
	
	//Open correct lightbox gallery
	$('.product-lightbox-trigger').click(function() {
		var lightboxTrigger = $(this).data('trigger');
		$('#pop' + lightboxTrigger).show();
	});
	//Close lightbox gallery
	$('.product-gallery-lightbox-close').click(function() {
		$('.product-gallery-lightbox').hide();
	});
	
	 $('.thumbnail').hover(function() {
		var dataAttr = $(this).data('thumbnail');
		console.log(dataAttr);
		$('.main-thumb').hide();
		$('.main-img > .main-thumb[data-thumbnail="'+ dataAttr +'"]').show();
	});		
	
	$('.close').click(function(){
		$('.popup').hide();
	});
});
</script>
