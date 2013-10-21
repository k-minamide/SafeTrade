<?php get_header(); ?>

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
					?>
						<!-- loop start -->
						<li>
							<div class="inner descHover">
								<h2><a href="<?php echo home_url(); ?>/author?uid=<?php echo $user_id; ?>"><span><?php echo cimy_uef_sanitize_content($nickname); ?></span>さん</a></h2>
								<p class="avater">
									<img alt="<?php echo cimy_uef_sanitize_content($nickname); ?>さん" src="<?php echo cimy_uef_sanitize_content($avater_image); ?>" height="60" width="60" />
								</p>
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

			<?php include( TEMPLATEPATH . '/login-area.php'); ?>
		</div>

<?php get_footer(); ?>