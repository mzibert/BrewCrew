<div class="container">
	<div class="brewery-profile">
		<img align="left" class="image-logo thumbnail" src="image/profileplaceholder.jpg" alt="brewery logo placeholder"/>
		<div class="profile-text">
			<h1>{{ breweryProfile.breweryName }}</h1>
			<p>Phone Number: {{ breweryProfile.breweryPhone }}</p>
			<p>Hour of Operation: {{ breweryProfile.breweryHours }}</p>
			<p>Address: {{ breweryProfile.breweryLocation }}</p>
			<p>Website: {{ breweryProfile.breweryUrl }}</p>
			<p>Description: {{ breweryProfile.breweryDescription }}</p>
		</div>
		<div>
			<div>
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">What's On Tap</h3>
								</div>
								<ul class="list-group beers">
									<a href="#" ng-repeat="beer in beerData">
<!--										{{ beer.beerName }}-->
									</a>
									<a href="#" class="list-group-item"> {{ beerData[1].beerName }}</a>
									<a href="#" class="list-group-item"> {{ beerData[2].beerName }}</a>
									<a href="#" class="list-group-item"> {{ beerData[3].beerName }}</a>
									<a href="#" class="list-group-item"> {{ beerData[4].beerName }}</a>
									<a href="#" class="list-group-item"> {{ beerData[5].beerName }}</a>
									<a href="#" class="list-group-item"> {{ beerData[6].beerName }}</a>
									<a href="#" class="list-group-item"> {{ beerData[7].beerName }}</a>
									<a href="#" class="list-group-item"> {{ beerData[8].beerName }}</a>
									<a href="#" class="list-group-item"> {{ beerData[9].beerName }}</a>
									<a href="#" class="list-group-item"> {{ beerData[10].beerName }}</a>
								</ul>
							</div>
						</div>
					</div>
				</div>
<!--				<div class="container">-->
<!--					<div class="row">-->
<!--						<div class="col-md-6">-->
<!--							<div class="panel panel-default">-->
<!--								<div class="panel-heading">-->
<!--									<h3 class="panel-title">Top Rated Beers</h3>-->
<!--								</div>-->
<!--								<ul class="list-group beers">-->
<!--									<a href="#" class="list-group-item">Cras justo odio</a>-->
<!--									<a href="#" class="list-group-item">Dapibus ac facilisis in</a>-->
<!--									<a href="#" class="list-group-item">Morbi leo risus</a>-->
<!--									<a href="#" class="list-group-item">Porta ac consectetur ac</a>-->
<!--									<a href="#" class="list-group-item">Vestibulum at eros</a>-->
<!--								</ul>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
			</div>
		</div>
	</div>
</div> 

{}