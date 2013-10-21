				<div class="login_area">
				<?php if (!is_user_logged_in()) : ?>
					<?php if (function_exists('gianism_login')) {
						gianism_login();
					}
					?>
				<?php else: ?>
					<a href="<?php echo home_url(); ?>/wp-admin/profile.php">プロフィール編集</a> | <a href="<?php echo home_url(); ?>/leave">退会</a> | <a href="<?php echo wp_logout_url() ?>&amp;redirect_to=<?php echo esc_attr($_SERVER['REQUEST_URI']) ?>">ログアウト</a>
				<?php endif; ?>
				</div>
