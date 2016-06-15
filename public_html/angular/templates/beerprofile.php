<div class="container">
	<div class="beer-profile">
		<img align="left" class="image-logo thumbnail" src="image/profileplaceholder.jpg" alt="beer logo placeholder"/>
		<div class="profile-text">
			<h1>{{ beerProfile[0].beerName }}</h1>
			<p>Description: {{ beerProfile[0].beerDescription }}</p>
			<p>Availability: {{ beerProfile[0].beerAvailability }}</p>
			<p>Style: {{ beerProfile[0].beerStyle }}</p>
			<p>ABV: {{ beerProfile[0].beerAbv }}</p>
			<p>IBU: {{ beerProfile[0].beerIbu }}</p>
			<p>Awards: {{ beerProfile[0].beerAwards }}</p>
		</div>
		<div>
			<div>
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Recent Reviews</h3>
								</div>
								<ul class="list-group reviews">
									<li ng-repeat="review in reviewData">
<!--										Date:  {{ review.reviewDate }}-->
										Pint Rating: {{ review.reviewPintRating }}<br><br>
										Review: {{ review.reviewText }}<br><br>
									</li>
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
							</div>
						</div>
					</div>
				</div>
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->