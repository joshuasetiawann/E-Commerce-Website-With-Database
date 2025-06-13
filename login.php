<?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']); // For compatibility with your SQL
    $admin_name = $username; // You can add a field for name if you want
    $admin_telp = '';
    $admin_address = '';

    // Check if username or email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR admin_email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Username or Email already exists!'); window.location='login.php';</script>";
        exit;
    }

    $insert = mysqli_query($conn, "INSERT INTO users (admin_name, username, password, admin_telp, admin_email, admin_address) VALUES ('$admin_name', '$username', '$password', '$admin_telp', '$email', '$admin_address')");
    if ($insert) {
        echo "<script>alert('Sign up successful! Please sign in.'); window.location='dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('Sign up failed!'); window.location='login.php';</script>";
        exit;
    }
}

// SIGN IN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        echo "<script>alert('Login successful!'); window.location='dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('Login failed! Username or password incorrect.'); window.location='login.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Joe Shop</title>
	<link rel="stylesheet" href="css/login.css"/>
   <script src="js/login.js" defer></script>	
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
</head>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']); // For compatibility with your SQL
    $admin_name = $username; // You can add a field for name if you want
    $admin_telp = '';
    $admin_address = '';

    // Check if username or email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR admin_email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Username or Email already exists!'); window.location='login.php';</script>";
        exit;
    }

    $insert = mysqli_query($conn, "INSERT INTO users (admin_name, username, password, admin_telp, admin_email, admin_address) VALUES ('$admin_name', '$username', '$password', '$admin_telp', '$email', '$admin_address')");
    if ($insert) {
        echo "<script>alert('Sign up successful! Please sign in.'); window.location='login.php';</script>";
        exit;
    } else {
        echo "<script>alert('Sign up failed!'); window.location='login.php';</script>";
        exit;
    }
}

// SIGN IN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        echo "<script>alert('Login successful!'); window.location='login.php';</script>";
        exit;
    } else {
        echo "<script>alert('Login failed! Username or password incorrect.'); window.location='login.php';</script>";
        exit;
    }
}
?>
<body>
<div id="container" class="container">
		<!-- FORM SECTION -->
		<div class="row">
			<!-- SIGN UP -->
			<div class="col align-items-center flex-col sign-up">
				<div class="form-wrapper align-items-center">
					<form class="form sign-up" method="POST" action="login.php" onsubmit="return validateRegisterForm()">
						<input type="hidden" name="action" value="register" />
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" name="username" placeholder="Username" required>
						</div>
						<div class="input-group">
							<i class='bx bx-mail-send'></i>
							<input type="email" name="email" placeholder="Email" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="password" placeholder="Password" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="confirm_password" placeholder="Confirm password" required>
						</div>
						<button type="submit">
							Sign up
						</button>
						<p>
							<span>
								Already have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign in here
							</b>
						</p>
					</form>
				</div>
			
			</div>
			<!-- END SIGN UP -->
			<!-- SIGN IN -->
			<div class="col align-items-center flex-col sign-in">
				<div class="form-wrapper align-items-center">
					<form class="form sign-in" method="POST" action="login.php">
						<input type="hidden" name="action" value="login" />
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" name="username" placeholder="Username" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="password" placeholder="Password" required>
						</div>
						<button type="submit">
							Sign in
						</button>
						<p>
							<b>
								Forgot password?
							</b>
						</p>
						<p>
							<span>
								Don't have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign up here
							</b>
						</p>
					</form>
				</div>
				<div class="form-wrapper">
		
				</div>
			</div>
			<!-- END SIGN IN -->
		</div>
		<!-- END FORM SECTION -->
		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome
					</h2>
	
				</div>
				<div class="img sign-in">
		
				</div>
			</div>
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="img sign-up">
				
				</div>
				<div class="text sign-up">
					<h2>
						Join with us
					</h2>
	
				</div>
			</div>
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
	</div>
	<script>
		function validateRegisterForm() {
			var password = document.querySelector('input[name="password"]').value;
			var confirmPassword = document.querySelector('input[name="confirm_password"]').value;
			if (password !== confirmPassword) {
				alert("Passwords do not match!");
				return false;
			}
			return true;
		}
	</script>
</body>

</html>