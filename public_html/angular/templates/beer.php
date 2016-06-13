
<!-- main content-->
<div class="row" id="beer">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="well text-center">
			<form name="sampleForm" id="sampleForm" class="form-horizontal well" ng-controller="BeerController" ng-submit="submit(formData, sampleForm.$valid);" novalidate>
				<div class="form-group" ng-class="{ 'has-error': sampleForm.beerName.$touched && sampleForm.fullName.$invalid }">
					<label for="beerName">Search Beer</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-search"></i>
						</div>
						<input type="text" id="search" name="search" class="form-control" placeholder="search" ng-model="formData.search" ng-minlength="4" ng-maxlength="32" ng-required="true" />
					</div>
					<div class="alert alert-danger" role="alert" ng-messages="sampleForm.search.$error" ng-if="sampleForm.search.$touched" ng-hide="sampleForm.search.$valid">
						<p ng-message="minlength">Search is too short.</p>
						<p ng-message="maxlength">Search is too long.</p>
						<p ng-message="required">Please enter your search.</p>
					</div>
					<h1></h1>
					<button class="btn btn-lg btn-info" type="submit"><i class="fa fa-search"></i>&nbsp;Find</button>
					<hr />
			</form>
		</div>
	</div>
</div>
