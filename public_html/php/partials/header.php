<header ng-controller="navController">

	<bootstrap-breakpoint></bootstrap-breakpoint>

	<div class="container-fluid">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" ng-click="navCollapsed = !navCollapsed">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index">New Mexico Brew Crew</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<form class="navbar-form navbar-right" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>

			<div class="collapse navbar-collapse" id="navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="compass">The Compass <span class="sr-only"></span></a></li>
					<li class="active"><a href="beer">Beers <span class="sr-only"></span></a></li>
					<li class="active"><a href="breweries">Breweries <span class="sr-only"></span></a></li>
					<li class="active"><a href="signup">Sign Up <span class="sr-only"></span></a></li>
					<li class="active"><a href="signin">Log In <span class="sr-only"></span></a></li>
				</ul>
			</div>
		</nav>
	</div><!-- /.container-fluid -->
</header>


