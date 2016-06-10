<?php
/*load head-utils.php - edit path as needed*/
require_once("php/partials/head-utils.php");
?>


<body class="sfooter">
	<div class="sfooter-content">

		<!-- header partial gets inserted -->
		<?php require_once("php/partials/header.php"); ?>


		<main class="p-y-4">
			<div class="container">

				<!-- Angular directive -->
				<div ng-view></div>

			</div>
		</main>


		<!-- footer gets inserted -->

	<?php require_once("php/partials/footer.php"); ?>

	<!-- /.container -->

</div>
</body>

