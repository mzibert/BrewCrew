<!-- main content-->
<div class="container">
	<div class="row" id="beer">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="well text-center">
				<form name="beerSearch" id="beerSearch" class="form-horizontal well" ng-submit="search(beerName);"novalidate>

					<label for="beerNameSearch">Search Beers</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-search"></i>
						</div>
						<input type="text" id="beerNameSearch" name="beerNameSearch" class="form-control"
								 placeholder="search by beer name" ng-model="beerName" ng-required="true"/>
					</div>
					<div class="alert alert-danger" role="alert" ng-messages="beerSearch.search.$error"
						  ng-if="beerSearch.search.$touched" ng-hide="beerSearch.search.$valid">

						<p ng-message="required">Please enter your search.</p>
					</div>
					<h1></h1>
					<button class="btn btn-lg btn-info" type="submit"><i class="fa fa-search"></i>&nbsp;Find</button>
					<hr/>
				</form>
			</div>
		</div>
	</div>



<div class="row" id="beerSearchTable">
	<table class="table table-bordered table-hover table-responsive table-striped table-word-wrap">
		<tr><th>Beer Name</th><th>Style</th><th>ABV</th><th>Availability</th></tr>
		<tr ng-click="getBeerProfile(beerData[$index].beerId);" ng-repeat="beer in beerData">
			<td>{{ beer.beerName }}</td>
			<td>{{ beer.beerStyle }}</td>
			<td>{{ beer.beerAbv }}</td>
			<td>{{ beer.beerAvailability }}</td>
		</tr>
	</table>
</div>