<!-- temporary user profile update form to be updated later -->


<div>
	<h2>Edit Your Profile</h2>

	<p class="text-danger">.</p>
	<form name="userUpdateProfile" ng-submit="updateUser(userData, userUpdateProfile.$valid);">
		<fieldset class="form-group" id="userEmail">
			<label for="userEmailInput">Email</label>
			<input type="text" class="form-control" name="userEmail" id="userEmail"
					 placeholder="email2@email.com" ng-model="userData.userEmail"
					 ng-minlength="5" ng-maxlength="128" ng-required="true"/>
			<div class="alert alert-danger" role="alert" ng-messages="userUpdateProfile.userEmail.$error"
				  ng-if="userUpdateProfile.userEmail.$touched" ng-hide="userUpdateProfile.userPhone.$valid">
				<p ng-message="minlength">Not a valid email.</p>
				<p ng-message="required">Please enter your new email</p>
			</div>

		</fieldset>

		<!-- Submit Form or Reset Form -->
		<!--		TODO: add Angular.js here to connect to User API, upon submit - redirect to this page again-->

		<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>

	</form>
	<br>
<!--	<a href="/">Return to Home Page</a>-->
</div>