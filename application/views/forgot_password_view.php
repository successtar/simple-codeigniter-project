<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Password Recovery</title>
		<meta name="description" content="" />
		<meta name="Author" content="" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

		<link rel="shortcut icon" href="favicon.ico">
		<!-- CORE CSS -->
		<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- TEMPLATE CSS -->
		<link href="<?php echo base_url(); ?>assets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets/css/color_scheme/custom.css" rel="stylesheet" type="text/css" id="color_scheme" />

	</head>
	<!--
		.boxed = boxed version
	-->
	<body>


		<div class="padding-15">

			<div class="login-box">

				<!-- login form -->
				
				<!-- <?php //echo form_open('user_authentication/user_login_process'); ?> -->

				
				<form action="<?php echo base_url(); ?>recover_password" method="post" class="sky-form boxed" accept-charset="utf-8">		

				<!-- <form action="index.html" method="post" class="sky-form boxed">  -->
					


					<header><i class="fa fa-lock"></i> Password Recovery</header>

					<?php
					if (isset($error_message)){
						if ($error_message!=""){
						echo '<div class="alert alert-danger noborder text-center weight-400 nomargin noradius">'.$error_message.' </div>';		
						}
					}
					elseif (isset($success_message)){
						echo '<div class="alert alert-success">'.$success_message.'</div>';
					}
					?>

					<!--
					<div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
						Invalid Email or Password!
					</div>
				<!--

					<div class="alert alert-warning noborder text-center weight-400 nomargin noradius">
						Account Inactive!
					</div>

					<div class="alert alert-default noborder text-center weight-400 nomargin noradius">
						<strong>Too many failures!</strong> <br />
						Please wait: <span class="inlineCountdown" data-seconds="180"></span>
					</div>
					-->

					<fieldset>	
					
						<section>
							<label class="label">Enter Account E-mail</label>
							<label class="input">
								<i class="icon-append fa fa-envelope"></i>
								<input type="email" name="email" required>
								<span class="tooltip tooltip-top-right">Email Address</span>
							</label>
						</section>
						
						

					</fieldset>

					<footer>
						<button type="submit" class="btn btn-primary pull-right">Retrieve Password</button>
						<div class="forgot-password pull-left">
							<a href="<?php echo base_url(); ?>login">Back to login Page</a> <br />
							
						</div>
					</footer>
				</form>
				<!-- /login form -->

				<hr />


			</div>

		</div>

		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
		<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
	</body>
</html>