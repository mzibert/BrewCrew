<?php


/*load the HTML head tag: head-utils.php*/
require_once(dirname(dirname(__DIR__)) . "/php/partials/head-utils.php");
?>


		<!-- insert header and navbar -->
		<?php require_once(dirname(dirname(__DIR__)) . "/php/partials/header.php");?>

		<!-- begin main content page layout -->
		<main class="container p-t-nav">


			<!-- begin main content area -->
			<div class="row row-flex content-wrap">

				<!-- page content -->
				<div class="col-sm-9 col-sm-push-3 content-panel">
					<div>
						<h2>#</h2>

					</div>
				</div>


			</div><!--/.row-flex-->
		</main>



	<!-- insert footer -->
	<?php require_once(dirname(dirname(__DIR__)) . "/php/partials/footer.php");?>

</body>
