<div class="container">
	<div class="beer-profile">
		<img align="left" class="beer-image" src="image/cerveza-buena.jpg" alt="Profile placeholder"/>
		<img align="left" class="image-profile thumbnail" src="image/profile-placeholder.jpg" alt="beer profile placeholder"/>
		<div class="profile-text">
			<h1>Some Beer</h1>
<!--			rating script-->
			<div ng-controller="RatingDemoCtrl">
				<h4>Default</h4>
				<uib-rating ng-model="rate" max="max" read-only="isReadonly" on-hover="hoveringOver(value)" on-leave="overStar = null" titles="['one','two','three']" aria-labelledby="default-rating"></uib-rating>
				<span class="label" ng-class="{'label-warning': percent<30, 'label-info': percent>=30 && percent<70, 'label-success': percent>=70}" ng-show="overStar && !isReadonly">{{percent}}%</span>

				<pre style="margin:15px 0;">Rate: <b>{{rate}}</b> - Readonly is: <i>{{isReadonly}}</i> - Hovering over: <b>{{overStar || "none"}}</b></pre>

				<hr />
			</div>
			<h3>Beer Awards</h3>
			<h3>Beer Abv</h3>
			<h3>Beer Ibu</h3>
			<p>Beer Description</p>
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
								<ul class="list-group beers">
									<a href="#" class="list-group-item">Cras justo odio</a>
									<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
									<a href="#" class="list-group-item">Morbi leo risus</a>
									<a href="#" class="list-group-item">Porta ac consectetur ac</a>
									<a href="#" class="list-group-item">Vestibulum at eros</a>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 