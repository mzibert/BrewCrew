<!-- begin main content page layout -->
<div class="container" id="thecompass">
	<div class="row" >
		<div class="span9">
			<h2 class="heading h-section text-center" data-barley="index_hiw_heading" data-barley-editor="simple">Search the Craft Beer Compass and Discover Your Flavor Profile</h2>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<button type="button" class="btn btn-generate" ng-model="singleModel" uib-btn-checkbox btn-checkbox-true="1" btn-checkbox-false="0">
				Generate Flavor Profile
			</button>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="ibox float-e-margins">
				<div class="ibox-content">

					<div class="row">
						<div id="compass-wrap" class="col-sm-4 col-sm-offset-6 col-xs-10 col-xs-offset-1">
							<div class="compass">
								<?php require_once(dirname(__DIR__, 2)) . "/image/compass.svg";?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>


