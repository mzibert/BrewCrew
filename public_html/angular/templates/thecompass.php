<!-- begin main content page layout -->
<div class="container" id="thecompass">
	<div class="row" >
		<div class="span9">
			<h2 class="heading h-section text-center" data-barley="index_hiw_heading" data-barley-editor="simple">Search the Craft Beer Compass and Discover Your Flavor Profile</h2>
		</div>
	</div>
</div>
<br>
<div class="container">
	<div class="row">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div class="row">
						<div id="compass-wrap" class="col-sm-4 col-sm-offset-2 col-xs-10 col-xs-offset-1">
							<div class="compass">
								<?php require_once(dirname(__DIR__, 2)) . "/image/compass.svg";?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<button type="button" class="btn btn-generate" ng-required="true" ng-click="getBeerRecommendation()">
					Generate Flavor Profile
				</button>
			</div>
	</div>
</div>
<br>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<div class="row" id="compassTable">
				<table class="table table-bordered table-hover table-responsive table-striped table-word-wrap">
					<tr><th>Beer Name</th><th>Style</th><th>ABV</th><th>IBU</th><th>Availability</th></tr>
					<tr ng-click="getBeerProfile(beerData[$index].beerId);" ng-repeat="beer in beerData">
						<td>{{ beer.beerName }}</td>
						<td>{{ beer.beerStyle }}</td>
						<td>{{ beer.beerAbv }}</td>
						<td>{{ beer.beerIbu }}</td>
						<td>{{ beer.beerAvailability }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>