<!DOCTYPE>
<html lang="ja">
	<head>
		<meta charset="UTF-8" />
		<title><?php echo bloginfo("name"); ?> - <?php echo bloginfo("description"); ?></title>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" media="screen" />
	</head>
	<body>
		<div id="container">

			<!-- header strat -->
			<header>
				<div class="alignleft">
					<h1 id="logo">
						<a href="#"><span><?php echo bloginfo("name"); ?></span></a>
					</h1>
					<p id="description"><?php echo bloginfo("description"); ?></p>
				</div>

				<div class="alignright">
					<form method="get" id="searchform" action="#">
						<input type="text" placeholder="検索" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="検索" />
					</form>
				</div>

				<!-- navi start -->
				<!-- navi end -->

			</header>
			<!-- header end -->

			<!-- ログイン start -->
			<aside>
				<div class="linkArea">
					<a class="button" href="./login">ログイン</a>
				</div>
			</aside>
			<!-- ログイン end -->

			<!-- main start -->
			<section class="main">
				<?php
				if (have_posts()) : // WordPress ループ
					while (have_posts()) : the_post(); // 繰り返し処理開始 ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

							<?php the_content(); ?>

							<?php
							$args = array(
								'before' => '<div class="page-link">',
								'after' => '</div>',
								'link_before' => '<span>',
								'link_after' => '</span>',
							);
							wp_link_pages($args); ?>

						</div>
					<?php
					endwhile; // 繰り返し処理終了
				else : // ここから記事が見つからなかった場合の処理 ?>
						<div class="post">
							<h2>記事はありません</h2>
							<p>お探しの記事は見つかりませんでした。</p>
						</div>
				<?php
				endif;
				?>			</section>
			<!-- main end -->

			<!-- ログイン start -->
			<aside>
				<div class="linkArea">
					<a class="button" href="./login">ログイン</a>
				</div>
			</aside>
			<!-- ログイン end -->

		</div>

		<!-- footer start -->
		<footer>
			&copy;&nbsp;チームクレクレ
		</footer>
		<!-- footer end -->

	</body>
</html>
