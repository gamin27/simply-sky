<?php get_header(); ?>
<!--	main-->
<main>
	<article class="container container--page">
		<article class="container__main">
			<?php if ( have_posts() ) :  ?>
				<?php while (have_posts()) : ?>
					<?php the_post(); ?>
					<article <?php post_class(); ?>>
						<div <?php  post_class(); ?>>
							<div class="note">
								<div class="note__header">
									<div class="note-header">
										<h2>
											<?php the_title(); ?>
										</h2>
										<div class="note-header__item">
											<div class="category-name"><?php the_category('&nbsp'); ?></div>
										</div>
									</div>
								</div>
								<div class="post-thumbnail">
									<?php if (has_post_thumbnail()) : ?>
										<?php the_post_thumbnail(); ?>
									<?php else : ?>
									<?php endif; ?>
								</div>
								<div class="note__body">
									<div class="note-body js_note">
										<?php the_content(); ?>
									</div>
								</div>
								<div class="note__footer">
									<article class="share"> </article>
								</div>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			<?php endif; ?>
		</article>
	</article>
</main>
<!--	/main-->

<?php get_footer(); ?>
