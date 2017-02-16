
<h2>Montage</h2>
<div class = "montage">
	<div class="main">
		<div class="images">
				<div class="background_image" style="z-index:2;"/>
					<img id="background" src="" width="500" height="auto" alt="image de fond">
				</div>
				<div class="video"  alt="webcam" style="z-index:1;">
				    <video autoplay id="videoElement" width="500" height="auto">
				    </video>
			    </div>
			    <div class="selected_image" style="z-index:1;">
		    		<img id="imgtag" src="" width="500" height="auto" alt="capture d'image"/>
		    	</div>
		    	<div class="resulting_image">
			       	<canvas id="canvas" width="500" height="375"></canvas>
		    	</div>
		</div>
		<div class="boutons_montage">
		        <input type="button" value="Prendre une photo" id="save" />
			    <input id="fileselect" type="file" accept=".png" capture="camera">
		       	<input id="save_to_server" type="submit" value="Enregistrer votre montage">
		</div>
		<div class="miniatures">
		<?php
		require "affiche_miniatures.php";
		?>
		</div>
	</div>
	<div class="side">
			<p>Liste des images deja crees</p>
			<?PHP
			listPhotos();
			?>
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
	// au chargement du DOM, afficher la video dans le canvas
    v = document.getElementById('videoElement');
    canvas = document.getElementById('canvas');
    context = canvas.getContext('2d');
    w = canvas.width;
    h = canvas.height;

},false);

function draw(v,c,w,h) {

	if(v.paused || v.ended) return false;

	// affiche le cliche de la video dans le canvas
    context.drawImage(v,0,0,w,h);
    var uri = canvas.toDataURL("image/png");
	// et met l'image obtenue dans imtag
    imgtag.src = uri;
}

var save=document.getElementById('save');
save.addEventListener('click',function(e){
		// affiche le cliche de la video dans le canvas
        draw(v,context,w,h);
		
		// afficher l'image
        imgtag.style.display='initial';
});

var save_to_server=document.getElementById('save_to_server');
save_to_server.addEventListener('click',function(e){
	// ici, on a une image de background et une image dans le imgtag
	// => les envoyer au serveur
	// a finir !!! Envoyer le tout au serveur pour faire le montage
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '../control/generate_image.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function () {
		// cas d'erreur
		console.log(this.responseText);
	};
	var params = 'image='+imgtag.src+'&image_incrustee='+background.src;
	console.log(params);
	xhr.send(params);
	window.location.pathname = '/camagru/view/montage.php';
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

function select_image(elem){
	console.log("selection d une image");
	background.style.display='initial';
    background.src=elem.src;
}

function delete_image(elem) {
	if (elem)
		elem.parentNode.removeChild(elem);
	console.log("A FAIRE : supprimer l'image en base");
}
</script>