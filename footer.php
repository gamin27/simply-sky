	<!--	footer-->
	<footer class="footer">
		<div class="footer-header">
			<div class="">
				<div class="container">
					<div class="top-link">
						<a href="#">
							<p class="top-link__item top-link__item--icon">
								<i class="fas fa-caret-up"></i>
							</p>
							<p class="top-link__item top-link__item--message">
								page top
							</p>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-main">
			<div class="">
				<div class="container">
					<div class="footer-main__item">
						<?php get_search_form(); ?>
					</div>
					<div class="footer-main__item">
						<ul class="footer-nav">
							<li class="footer-nav__item">
								<a href="<?php echo esc_url(home_url('/about/')); ?>">
									<span class="is-hover-link">
										<i class="far fa-user"></i> about
									</span>
								</a>
							</li>
							<li class="footer-nav__item">
								<a href="<?php esc_url(gamin_get('twitter-link')); ?>" target="_blank">
									<span class="is-hover-link">
										<i class="fab fa-twitter"></i> contact
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-footer">
			<div class="copyright ">
				<div class="container">
					<small>copyright &copy; <?php echo get_bloginfo('name'); ?> all rights reserved.</small>
				</div>
			</div>

		</div>
	</footer>
	<!--	/footer-->

	<?php wp_footer(); ?>
</body>

</html>