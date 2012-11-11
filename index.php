<?
include 'header.php';
?>
	<form action="login_submit.php" method="post">
		<div id="LoginForm">
			<?if($notification != "")print "<div class='error'>".$notification."</div>";?>
			<form method="post" action="loginSubmit.php" accept-charset="utf-8">
				<div class="row">
					<label class="LoginLabel">Username: </label><input type="text" name="username" value="" id="username" class="LoginInput" />
				</div>
			
				<div class="row">
					<label class="LoginLabel">Password: </label><input type="password" name="password" value="" id="password" class="LoginInput" />
				</div>
			
				<div class="row LoginButton">
					<input type="submit" name="login" value="Log In" id="loginBtn" />
				</div>
			</form>
		</div><!-- LoginForm -->
	</form>
<?
include 'footer.php';
?>