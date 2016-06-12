<!-- header partial gets inserted -->
<header ng-controller="navController">

	<bootstrap-breakpoint></bootstrap-breakpoint>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid" id="navbar">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" ng-click="navCollapsed = !navCollapsed">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="home">
					<img src="image/logo.png" role="button" alt="Placeholder Logo">
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse-1">
				<form class="navbar-form navbar-right" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">Search</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="thecompass">The Compass <span class="sr-only"></span></a></li>
					<li class="active"><a href="beer">Beers <span class="sr-only"></span></a></li>
					<li class="active"><a href="breweries">Breweries <span class="sr-only"></span></a></li>
					<li class="active"><a href="signup">Sign Up <span class="sr-only"></span></a></li>
					<li class="active"><a href="signin">Log In <span class="sr-only"></span></a></li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
</header>