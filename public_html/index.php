

<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "ABQBrew Crew";

/*load head-utils.php - edit path as needed*/
require_once("php/partials/head-utils.php");
?>


<body class="sfooter">
	<div class="sfooter-content">

		<!-- header partial gets inserted -->
		<?php require_once("php/partials/header.php"); ?>


			<!-- angular view directive -->
			<div ng-view></div>

	</div>


	<!-- footer gets inserted -->
	<?php require_once("php/partials/footer.php"); ?>

	<!-- /.container -->


</body>

