<?PHP
// traitement de la page d'administration par un user de profile ADMIN
//require ('list_users.php');
function list_users()
{

	require __DIR__ . '/../config/database.php';
	require __DIR__ . '/../model/User.class.php';
	require __DIR__ . '/../model/DBAccess.class.php';

	$data = array(
						'login' => $_SESSION['logged_on_user'],
					);
	$user = new User($data);
	$db = new DBAccess($DB_DSN, $DB_USER, $DB_PASSWORD);

	$result = $user->listAll($db->db);
	?>
	<table>
	  <tr>
	    <th>Login</th>
	    <th>Mail</th>
	    <th>Profile</th>
	    <th>Status</th>
	  </tr>
	<?PHP
	foreach ($result as $value) 
	{
		echo "<tr>";
		if ($value['profile'] == "NORMAL")
			echo "<td class = 'deluser' onclick ='delete_user(this)'>".$value['login']."</td>";
		else
			echo "<td>".$value['login']."</td>";
		echo "<td>".$value['mail']."</td>";
		echo "<td>".$value['profile']."</td>";
		echo "<td>".$value['status']."</td>";
		echo "</tr>";
	}
}
?>
	</table>
<script type="text/javascript">
function delete_user(elem) {
	if(elem) {
		if (confirm("Voulez vous supprimer cet utilisateur ?")){
			//console.log("Suppression d'un utilisateur");
			var xhr = new XMLHttpRequest();
			xhr.open('POST', '../control/delete_user.php', true);
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.onreadystatechange = function() {
	        	if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText);
					window.location.pathname = '/camagru/view/admin.php';
	 	       	}
	 	    };
			var params = 'user=' + elem.innerHTML;
			xhr.send(params);

			// elem.parentNode.removeChild(elem);
		}
	}
}
</script>