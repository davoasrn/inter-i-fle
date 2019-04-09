<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html lang="en">

<?php
/*foreach($images as $key => $value){
	$imagedata = getimagesize(IMAGE_URL.'/image_gallery/'.$value['Gallery']['image']);
	$image->resize($value['Gallery']['image'], 100, 100, true,array('border'=>'0', 'alt'=>'My Image'));
}
*/?>
    <div id="wrapper">
       <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
				<?php foreach($images as $key => $value){
				?>
				<img src="<?php echo IMAGE_URL.'/image_gallery/'.$value['Gallery']['image']; ?>" data-thumb="images/toystory.jpg" alt="" title="#htmlcaption"/ width="423" height="423" >
					<?php 
					} 
					
					?>
                <!--<img src="images/toystory.jpg" data-thumb="images/toystory.jpg" alt="" />
                <a href="http://dev7studios.com"><img src="images/up.jpg" data-thumb="images/up.jpg" alt="" title="This is an example of a caption" /></a>
                <img src="images/walle.jpg" data-thumb="images/walle.jpg" alt="" data-transition="slideInLeft" />
                <img src="images/nemo.jpg" data-thumb="images/nemo.jpg" alt="" title="#htmlcaption" />-->
            </div>
            
            
            <?php foreach($images as $key => $value) { ?>
				<div id="#htmlcaption" class="nivo-html-caption">
               <!-- <strong><?php echo $value['Gallery']['image_title']; ?></strong><br/>
                <strong><?php echo $value['Gallery']['image_description']; ?></strong> -->
                
               <!-- <div id="htmlcaption" class="nivo-html-caption">
                <strong>Hiiiiiiiiii <?php echo $key; ?></strong>. 
            </div>
            
            </div>
            <?php } ?>
            -->
        </div>

    </div>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>

<?php


