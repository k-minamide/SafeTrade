<!DOCTYPE>
<html lang="ja">
	<head>
		<meta charset="UTF-8" />
		<title><?php echo bloginfo("name"); ?> - <?php echo bloginfo("description"); ?> - </title>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" media="screen" />
	</head>
	<body>
		<div id="al">

			<!-- header strat -->
			<div class="header_backend">
				<div class="header">
					<h1 id="logo">
						<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" width="545" height="102" alt="<?php echo bloginfo("title"); ?> - <?php echo bloginfo("description"); ?> -" title="<?php echo bloginfo("title"); ?> - <?php echo bloginfo("description"); ?> -" /></a>
					</h1>
				</div>
			<?php include( TEMPLATEPATH . '/login-area.php'); ?>
			</div>
			<!-- header end -->