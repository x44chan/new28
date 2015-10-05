<?php include("header.php");?>

<div class="camcontent" align = "center">
	<video align = "center"style = "height: 300px; width: 400px;" id="video" autoplay></video>
	<canvas align = "center"id="canvas" width="400" height="300">
</div>
<div align = "center" class="cambuttons">
	<button align = "center"id="snap" style="display:none;">  Capture </button> 
	<button align = "center"id="reset" style="display:none;">  Reset  </button>     
	<button align = "center"id="upload" style="display:none;" > Done ? </button><br> 			
</div>
<script type="text/javascript" src="js/photo.js"></script>
<script type="text/javascript">
	$(document).ready(function(){	
    	$("#upload").on("click", function(){
    		$(location).attr('href', 'index.php')
	    });
	});
</script>
<?php include("footer.php");?>