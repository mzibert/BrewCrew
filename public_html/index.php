<?php
/*load head-utils.php - edit path as needed*/
require_once("php/partials/head-utils.php");
?>


<body class="sfooter">
	<div class="sfooter-content">

		<!-- header partial gets inserted -->
		<?php require_once("php/partials/header.php"); ?>


		<main>
			<div>

				<!-- Angular directive -->
				<div ng-view></div>



			</div>
		</main>


		<!-- footer gets inserted -->


	<!-- /.container -->

	</div>
	<?php require_once("php/partials/footer.php"); ?>
</body>

