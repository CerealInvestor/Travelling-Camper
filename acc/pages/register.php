<div class="blogTitle"><h2>Register</h2></div>
<div class="linkButton"></div>
<div class="content">
	<form method="post" action="php/fRegister.php" name="signup-form">
		<div class="form-element">
		<label>Username</label>
		<input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
		</div>
		<div class="form-element">
		<label>Email</label>
		<input type="email" name="userEmail" required />
		</div>
		<div class="form-element">
		<label>Password</label>
		<input type="password" name="password" required />
		</div>
		<button type="submit" name="register" value="register">Register</button>
	</form>
	</div>