<!-- begin main content page layout -->
<div class="container" id="beer">
<div class="row" >
	<div class="span9">
		<h2 class="heading h-section text-center" data-barley="index_hiw_heading" data-barley-editor="simple">Search for Craft Beers</h2>
	</div>
</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="ibox float-e-margins">
				<div class="ibox-content">


					<div class="search-form">
						<form name="beerSearchForm" ng-submit="getBeerByName(beerName);">
							<div class="input-group">
								<input type="text" placeholder="Search by beer name" name="search" class="form-control input-lg">
								<div class="input-group-btn">
									<button class="btn btn-lg btn-primary" type="submit">Search</button>
								</div>
							</div>
						</form>
					</div>
					<h2>Results found for: <span class="search results">"(     )"</span></h2>
					<div class="hr-line-dashed"></div>
					<div class="search-result">
						<h3><a href="#">Beer One</a></h3>
						<p>Brewery it's at</p>
					</div>

					<div class="hr-line-dashed"></div>
					<div class="search-result">
						<h3><a href="#">Beer Two</a></h3>
						<p>Brewery it's at</p>
					</div>
					<div class="hr-line-dashed"></div>

					<div class="search-result">
						<h3><a href="#">Beer Three</a></h3>
						<p>Brewery it's at</p>
					</div>
					<div class="hr-line-dashed"></div>
				</div>
			</div>
		</div>
	</div>
</div>