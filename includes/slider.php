<?php include("includes/info-page.php");?>

<div class="slider-wrapper">
        <div id="slideshow" class="nivoSlider">

         <a href="#"><img src="img/banner/<?php echo $row_info["Banner_1"]?>" alt="slideshow1" /></a>
          <a href="#"><img src="img/banner/<?php echo $row_info["Banner_2"]?>" alt="slideshow2" /></a>
          <a href="#"><img src="img/banner/<?php echo $row_info["Banner_3"]?>" alt="slideshow3" /></a>
          </div>
      </div>
         <script type="text/javascript">
$(document).ready(function() {
	$('#slideshow').nivoSlider();
});
</script>
