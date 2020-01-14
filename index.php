<?php get_header(); ?>
		<!--	main-->
	<main>

		<ul class=" list">
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : ?>
			<?php the_post(); ?>
			<!--start 投稿-->
			<li class="list__item">
					<div class="item">
						<a href="<?php the_permalink(); ?>" class="item__link"></a>
						<div class="item__card element-column">
							<div class="element-column__item">
								<div class="item__thumbnail">
									<?php if (has_post_thumbnail()) : ?>
										<?php the_post_thumbnail(); ?>
									<?php else : ?>
										
									<?php endif; ?>
								</div>
								<h2 class="item__title">
									<?php the_title(); ?>
								</h2>
								<div class="item__body">
									<?php the_excerpt(); ?>
								</div>
							</div>
							<div class="element-column__item">
								<div class="category-name">
									<?php the_category('&nbsp'); ?>
								</div>
								<div class="item__date">
									<div class="time">
										<p class="time__item">
											<i class="far fa-clock"></i>
											<span class="accent-font-family">
												<?php the_time('Y-n-j'); ?>
											</span>
										</p>
										<p class="time__item">/</p>
										<p class="time__item">
											<i class="fas fa-history"></i>
											<span class="accent-font-family">
												<?php the_modified_date('Y-n-j'); ?>
											</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
			</li>
			<!--end 投稿-->
			<?php endwhile; ?>
				<?php else: ?>
			<p>記事はありません。</p>
		<?php endif; ?>
		</ul>

		<article class="container">
			
			<?php
				if ( function_exists( 'pagination' ) ) :
					pagination( $wp_query->max_num_pages, get_query_var( 'paged' ) );
				endif;
			?>
		</article>
	</main>
	<!--/main-->

<?php get_footer(); ?>
