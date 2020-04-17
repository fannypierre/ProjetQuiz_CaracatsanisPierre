<?php
    require_once "connexionBD.php";
    if(isset($_GET['quiz_id'])) {
		$sql = "SELECT IMAGE FROM QUESTIONNAIRE WHERE NUMQUESTIONNAIRE=:id";
		$query = $bdd->prepare($sql);
		$result = $query->execute(array(':id' => $_GET['quiz_id'])) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>");
		$query->bindColumn(1, $image, PDO::PARAM_LOB);
		$query->fetch(PDO::FETCH_BOUND);
		header("Content-Type: image");
		echo $image;
	}
?>