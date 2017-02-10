
<h2>Montage</h2>
<div class = "montage">
	<div class="main">
		<form>
			<div>
				<p>Webcam</p>
			    <video autoplay id="videoElement">
			    </video>
		        <input type="button" value="Photo !" id="save" />
			    <input id="fileselect" type="file" accept="image/*" capture="camera">
		       	<canvas id="canvas" width="500" height="375"></canvas>
		    </div>
		    <div>
	    		<img id="imgtag" src="" width="500" height="375" alt="capture d'image" style="position:absolute;z-index:1;"/>
<!--	    		<img id="imgtag2" src="" width="500" height="375" style="position:absolute;z-index:2;"/> -->
	    	</div>
		</form>
	</div>
	<div class="miniatures">
	<?php
	require "affiche_miniatures.php";
	?>
	</div>
	<div class="side">
		<p>mettre ici la liste des images deja crees</p>
	</div>
</div>
<script type="text/javascript">
var video = document.querySelector("#videoElement");

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

if (navigator.getUserMedia) {
    navigator.getUserMedia({video: true}, handleVideo, videoError);
}

function handleVideo(stream) {
    video.src = window.URL.createObjectURL(stream);
}

function videoError(e) {
    // no webcam found - do something
    alert("Erreur ! Impossible d'utiliser la camera...");
}
var v,canvas,context,w,h;
var imgtag = document.getElementById('imgtag');
var sel = document.getElementById('fileselect');

document.addEventListener('DOMContentLoaded', function(){
        v = document.getElementById('videoElement');
    canvas = document.getElementById('canvas');
    context = canvas.getContext('2d');
    w = canvas.width;
    h = canvas.height;

},false);

function draw(v,c,w,h) {

	if(v.paused || v.ended) return false;

    context.drawImage(v,0,0,w,h);
    var uri = canvas.toDataURL("image/png");
    imgtag.src = uri;
}

document.getElementById('save').addEventListener('click',function(e){
        draw(v,context,w,h);
});

var fr;

sel.addEventListener('change',function(e){
    var f = sel.files[0];

    fr = new FileReader();
    fr.onload = receivedData;

    fr.readAsDataURL(f);
})

function receivedData() {
      imgtag.src = fr.result;
}

</script>