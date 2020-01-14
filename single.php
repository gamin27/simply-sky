<?php
	$category = get_the_category();
	$cat_slug = $category[0]->category_nicename;
	$share_url   = get_permalink();
  $share_title = get_the_title();
?>

<?php get_header(); ?>
<!--	main-->
<main>
	<article class="container">
		<!-- <div class="page-path">
			<a href="" class="page-path__item page-path__item--link"></a>
			<i class="fas fa-angle-right page-path__item"></i>
			<a href="" class="page-path__item page-path__item--link">
			</a>
		</div> -->
	</article>
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
											<div class="time">
												<p class="time__item">
													<i class="far fa-clock"></i>
													<span class="accent-font-family"><?php the_time('Y-n-j'); ?></span>
												</p>
												<p class="time__item">/</p>
												<p class="time__item">
													<i class="fas fa-history"></i>
													<span class="accent-font-family"><?php the_modified_date('Y-n-j'); ?></span>
												</p>
											</div>
										</div>
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
					<!-- start 共有ボタン -->
					<article class="share-area">
					<ul class="share-btn">
						<!-- twitter -->
						<li class="share-btn__item">
							<a href="//twitter.com/share?text=<?=$share_title?>&url=<?=$share_url?>" title="Twitterでシェア" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');return false;" class="slide-up">
								<i class="fab fa-twitter"></i>
							</a>
						</li>
						<!-- facebook -->
						<li class="share-btn__item">
						<a href="//www.facebook.com/sharer.php?src=bm&u=<?=$share_url?>&t=<?=$share_title?>" title="Facebookでシェア" onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=600');return false;" class="slide-up">
								<i class="fab fa-facebook-f"></i>
							</a>
						</li>
						<!-- line -->
						<li class="share-btn__item">	
						<a href="//line.me/R/msg/text/?<?=$share_title.'%0A'.$share_url?>" target="_blank" title="LINEに送る" class="slide-up">
							<i class="fab fa-line"></i>
							</a>
						</li>
						<!-- pocket -->
						<li class="share-btn__item">
						<a href="//getpocket.com/edit?url=<?=$share_url?>&title=<?=$share_title?>" target="_blank" title="Pocketに保存する" class="slide-up">
								<i class="fab fa-get-pocket"></i>
							</a>
						</li>
					</ul>
				</article>
				<!-- end 共有ボタン -->
				<?php endwhile; ?>
				<article class="newold-area">
					<ul class="newold">
						<li class="newold__item">
							<?php previous_post_link( '%link', 'older page - %title' ); ?>
						</li>
						<li class="newold__item">
							<?php next_post_link( '%link', 'newer page - %title' ); ?></li>
					</ul>
				</article>
				
			<?php endif; ?>
		</article>
		<?php get_sidebar(); ?>
	</article>
</main>
<!--	/main-->

<?php get_footer(); ?>
