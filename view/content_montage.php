
<h2>Montage</h2>
<div class = "montage">
	<div class="main">
		<div class="images">
				<div class="background_image" style="z-index:0;"/>
					<img id="background" src="" width="500" height="375" alt="image de fond">
				</div>
				<div class="video" width="500" height="375" alt="webcam" style="z-index:1;">
				    <video autoplay id="videoElement">
				    </video>
			    </div>
			    <div class="selected_image" style="z-index:1;">
		    		<img id="imgtag" src="" width="500" height="375" alt="capture d'image"/>
		    	</div>
		    	<div class="resulting_image">
			       	<canvas id="canvas" width="500" height="375"></canvas>
		    	</div>
		</div>
		<div class="boutons_montage">
		        <input type="button" value="Prendre une photo" id="save" />
			    <input id="fileselect" type="file" accept="image/*" capture="camera">
		       	<input type="submit" value="Enregistrer votre montage">
		</div>
		<div class="miniatures">
		<?php
		require "affiche_miniatures.php";
		?>
		</div>
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
    alert("Erreur ! Impossible d'utiliser la caméra...");
}

var v,canvas,context,w,h;
var imgtag = document.getElementById('imgtag');
var sel = document.getElementById('fileselect');
var background = document.getElementById('background');

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

    // je recupere en dur une image a superposer
    var vignettes = document.getElementsByClassName('vignette');
    context.drawImage(vignettes[0], 10, 10)
}

var save=document.getElementById('save');
save.addEventListener('click',function(e){
        draw(v,context,w,h);
        // cacher la video
        video.style.display='none';
        imgtag.style.display='initial';
});

var fr;

sel.addEventListener('change',function(e){
    var f = sel.files[0];

    fr = new FileReader();
    fr.onload = receivedData;

    fr.readAsDataURL(f);
    // cacher la video
    video.style.display='none';
    imgtag.style.display='initial';
})

function receivedData() {
      imgtag.src = fr.result;
}


</script>