
<h2>Gallerie</h2>
<div class = "gallerie">
	<div class="main">
		<?php
		affiche_gallerie();
		?>
	</div>
	
</div>
<script type="text/javascript">
function like(elem, image_id) {
	if (elem) {
		console.log('like');
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '../control/like.php', true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
				console.log(this.responseText);
				window.location.pathname = '/camagru/view/gallerie.php';
 	       	}
 	    };
		var params = 'image_id='+image_id;
		xhr.send(params);
	}
}

function unlike(elem, image_id) {
	if (elem) {
		console.log('unlike');
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '../control/unlike.php', true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
				console.log(this.responseText);
				window.location.pathname = '/camagru/view/gallerie.php';
 	       	}
 	    };
		var params = 'image_id='+image_id;
		xhr.send(params);
	}
}

function add_comment(elem, image_id) {
	// il faut que je puisse paser le nom de l'image et l'identifiant de l'utilisateur via des parametres de POST
	// a add_comment.php
	if (elem) {
		console.log('add_comment');
		var comment = prompt("Veuillez saisir un commentaire");
		if (comment != null)
		{
			console.log("Vous avez saisi : " + comment);
			var xhr = new XMLHttpRequest();
			xhr.open('POST', '../control/add_comment.php', true);
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.onreadystatechange = function() {
	        	if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText);
					window.location.pathname = '/camagru/view/gallerie.php';
 	 	       	}
	 	    };
			var params = 'image_id='+image_id+'&comment='+comment;
			xhr.send(params);
		}
	}
}
</script>