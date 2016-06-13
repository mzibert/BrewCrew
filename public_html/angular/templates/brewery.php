
<!-- main content-->
<div class="container" ng-controller="BreweryController">

	<div class="row" id="brewery">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="well text-center">
				<form name="brewerySearch" id="brewerySearch" class="form-horizontal well"  ng-submit="getBreweryByName(breweryName);" novalidate>

						<label for="breweryNameSearch">Search Breweries</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-search"></i>
							</div>
							<input type="text" id="breweryNameSearch" name="breweryNameSearch" class="form-control" placeholder="search by brewery name" ng-model="breweryName"  ng-required="true" />
						</div>
						<div class="alert alert-danger" role="alert" ng-messages="brewerySearch.search.$error" ng-if="brewerySearch.search.$touched" ng-hide="brewerySearch.search.$valid">

							<p ng-message="required">Please enter your search.</p>
						</div>
						<h1></h1>
						<button class="btn btn-lg btn-info" type="submit"><i class="fa fa-search"></i>&nbsp;Find</button>
						<hr />
				</form>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<h2>Name: {{ breweryData[0].breweryName }}</h2>
		</div>
	</div>


</div><!--container-->