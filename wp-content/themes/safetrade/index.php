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
				<div class="login_area">
					<?php
					if (function_exists(gianism_login)) {
						gianism_login();
					}
					?>
				</div>
			</div>
			<!-- header end -->

			<!-- main start -->
			<div class="container">
				<?php
				// 投稿者のリストの取得
				$users = get_cimyFieldValue(false, 'SHOW_WEB_FLAG', 'YES');
				?>
				<div class="content_header">
					<div class="count">
						現在の登録者 ： <span><?php echo count($users); ?></span> 人
					</div>
				</div>

				<div class="content">
					<ul class="clr">
					<?php
					foreach ( $users as $user ) {
						$user_id = $user['user_id'];
						$nickname     = get_cimyFieldValue($user_id, 'NICKNAME');
						$avater_image = get_cimyFieldValue($user_id, 'AVATER_IMG');
						$introduction = get_cimyFieldValue($user_id, 'INTRODUCTION');
					?>
						<!-- loop start -->
						<li>
							<div class="inner descHover">
								<h2><a href="<?php echo home_url(); ?>/author/<?php echo $user_id; ?>"><span><?php echo cimy_uef_sanitize_content($nickname); ?></span>さん</a></h2>
								<p class="avater">
									<img alt="<?php echo cimy_uef_sanitize_content($nickname); ?>さん" src="<?php echo cimy_uef_sanitize_content($avater_image); ?>" height="60" width="60" />
								</p>
							</div>
							<div class="desInner">
								<p><?php echo cimy_uef_sanitize_content($introduction); ?></p>
							</div>
						</li>
					<?php
					}
					?>
						<!-- loop end -->
					</ul>
				</div>
			</div>
			<!-- main end -->

			<div class="login_area">
				<?php
				if (function_exists(gianism_login)) {
					gianism_login();
				}
				?>
			</div>
		</div>

		<!-- footer start -->
		<div class="footer_background">
			<div class="footer">
				<p>&copy;&nbsp;2013&nbsp;Safe Trade&nbsp;&amp;&nbsp;チームクレクレ</p>
			</div>
		</div>
		<!-- footer end -->

	</body>
</html>
