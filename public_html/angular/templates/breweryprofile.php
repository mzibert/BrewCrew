<div class="container">
	<div class="brewery-profile">
		<img align="left" class="image-logo thumbnail" src="image/profileplaceholder.jpg" alt="brewery logo placeholder"/>
		<div class="profile-text">
			<h1>{{ breweryProfile.breweryName }}</h1>
			<p>Phone Number: {{ breweryProfile.breweryPhone }}</p>
			<p>Hour of Operation: {{ breweryProfile.breweryHours }}</p>
			<p>Address: {{ breweryProfile.breweryLocation }}</p>
			<p>Website: <a href="{{ breweryProfile.breweryUrl }} " target="_self"> {{ breweryProfile.breweryUrl }}</a></p>
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
									<li ng-repeat="beer in beerData"><a href="{{ beer.beerName }}"></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div> 