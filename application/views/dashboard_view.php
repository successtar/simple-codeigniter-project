<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/sarah.css" rel="stylesheet">
	
		
		<link href="<?php echo base_url(); ?>assets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets/css/layout.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body sarah-navigation-type="vertical" sarah-nav-placement="left" theme-layout="wide-layout" theme-bg="bg1" >
    <div id="sarahapp-wrapper" class="sarah-hide-lpanel" sarah-device-type="desktop">
        <header id="sarah-header" sarah-lpanel-effect="shrink">
            <div class="sarah-left-header">
                <a href="<?php echo base_url(); ?>"><i class="fa fa-commenting"></i> <span>DASHBOARD</span></a>
                <span class="sarah-sidebar-toggle"><a href="#"></a></span>
            </div>

            <div class="sarah-right-header" sarah-position-type="relative" >
             
				<span class="sarah-sidebar-toggle"><a href="#"></a></span>
                <ul class="right-navbar">
					<li class="dropdown sarah-rheader-submenu sarah-header-profile">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							
                            <span><strong> <i class="fa fa-user"> </i> <?php echo $_SESSION['username']; ?></strong> <i class=" fa fa-angle-down"></i></span>
						</a> 
						<ul class="dropdown-menu ">

						<?php
						// Check if User is superAdmin
						if ($_SESSION['role']=="superadmin"):?>	
							<li><a href="<?php echo base_url(); ?>adduser"><i class="fa fa-user"></i>Add New User</a></li>
						<?php endif; ?>

							<li><a href="<?php echo base_url(); ?>password"><i class="fa fa-cog"></i>Edit Password</a></li>
							<li><a href="<?php echo base_url(); ?>signout"><i class="fa fa-power-off"></i>Logout</a></li>
						</ul>
					</li>
					
				</ul>
				
            </div>

        </header>
        <div id="sarahapp-container" sarah-color-type="lpanel-bg2" sarah-lpanel-effect="shrink">
            
			
			<!-- Section  -->
            <section id="main-content">
				
				<!-- page title -->
				

				<!-- /page title -->

				<div id="content" class="padding-20">

					<div class="row">

						<div class="col-md-10">

				<?php
				//Send Error Message or Success Message to the user 
					if (isset($error_message)){
						if ($error_message!=""){
						echo '<div class="alert alert-danger">'.$error_message.'</div>';	
					}	}
					elseif (isset($success_message)){
						echo '<div class="alert alert-success">'.$success_message.'</div>';
					}
				?>
							
							<!-- ------ -->
							<div class="panel panel-default">
								<div class="panel-heading panel-heading-transparent">
									<strong> <i class="fa fa-comment"> </i> Send Text Message</strong>
								</div>

								<div class="panel-body">

										<form  action="<?php echo base_url(); ?>dashboard/sms" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
											<fieldset>
												<!-- required [php action request] -->
												<input type="hidden" name="action" value="contact_send" />

												
												<div class="row">
													<div class="form-group">
														<div class="col-md-12 col-sm-12">
															<label>	Sender *</label>
															<input type="text" name="sender" placeholder="e.g Successtar" class="form-control" value="<?php if (isset($sender)){echo $sender;	} ?>" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="form-group">
														<div class="col-md-12 col-sm-12">
															<label>	Receiver Number *</label>
															<input type="text" name="receiver" placeholder="234xxxxxxxxxx" class="form-control" value="<?php if (isset($receiver)){echo $receiver;	} ?>" required>
														</div>
													</div>
												</div>
												
												
												<div class="row">
													<div class="form-group">
														<div class="col-md-12 col-sm-12">
															<label>Text Message *</label>
															<textarea name="message" rows="4" class="form-control" required><?php if (isset($message)){echo $message;	} ?></textarea>
														</div>
													</div>
												</div>

											
											</fieldset>

											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">	SEND MESSAGE
														
													</button>
												</div>
											</div>

										</form>

								</div>

							</div>
							<!-- /----- -->








<div id="panel-1" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong><i class="fa fa-envelope"> </i> SENT TEXT MESSAGES</strong> <!-- panel title -->
							</span>

							
							<!-- /right options -->

						</div>

						<!-- panel content -->
						<div class="panel-body">

							<table class="table table-striped table-bordered table-hover" id="datatable_sample">
								<thead>
									<tr >
										<th >S/N</th>
										<th>Vendor</th>
										<th>Sender</th>
										<th>Reciever</th>
										<th>Text Message</th>
										<th>Status</th>
										<th>Time Sent</th>
									</tr>
								</thead>

								<tbody>
								
				<?php
					//List all previous Message sent by users and Sent Messages for Super Admin		
					echo $sent_sms;
					
				?>
								</tbody>
							</table>

						</div>










						</div>

						
					</div>

				</div>


			</section>
			<!-- /MIDDLE -->

		
               
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-2.1.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	
		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = '<?php echo base_url(); ?>assets/plugins/';</script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sarah.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app.js"></script>

</body>
</html>