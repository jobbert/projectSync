<?php
	session_start();
	include("DBconfig.php");
	include("header.php");
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	}else {
		$page = "inloggen";
	}
	if($page) {
		// if ($page === 'inloggen') {
			echo("<div class='spacert'></div>");
			echo("<div id='".$page."-page' class='page'>");
			echo("<div class='spacert'></div>");
			include("pages/".$page.".php");
			echo("</div>");
		// }
		// else {
			// echo("<div id='".$page."-page page'>");
			// include("pages/".$page.".php");
			// echo("</div>");
		// }
	}
	?>
	<!-- <div class="spacert" style="/* display: flex; flex-grow: 1; flex-shrink: 0; flex-basis: auto; min-height: 0; */"></div> -->
	<?php
	include("footer.php");
?>
