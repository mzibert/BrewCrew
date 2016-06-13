<header ng-controller="NavController">

	<bootstrap-breakpoint></bootstrap-breakpoint>

	<nav class="navbar navbar-inverse navbar-right navbar-fixed-top">
		<div class="container" id="navbar">
			<div class="navbar-header navbar-right">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" ng-click="navCollapsed = !navCollapsed">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="nav navbar-brand navbar-left" href="home" >
					<img src="image/logo.png" role="button" alt="Placeholder Logo"></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="thecompass">The Compass <span class="sr-only"></span></a></li>
					<li class="active"><a href="beer">Beers <span class="sr-only"></span></a></li>
					<li class="active"><a href="brewery">Breweries <span class="sr-only"></span></a></li>
					<li class="active"><a href="review">Reviews <span class="sr-only"></span></a></li>
					<li class="active"><a href="signup">Sign Up <span class="sr-only"></span></a></li>
					<li class="active"><a href="signin">Log In <span class="sr-only"></span></a></li>
				<form class="navbar-form navbar-right" role="search">
					<div class="form-group">
						<input type="text" class="form-control">
					</div>
					<button type="submit" class="btn btn-default">Search</button>
				</form>
				</ul>
			</div>
		</div>
	</nav><!-- /.container-fluid -->
</header>


