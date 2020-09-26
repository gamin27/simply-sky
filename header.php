<!doctype html>
<!-- 
こんにちは、裏のがみんです。
( ´ v ` )

本サイトは自作テーマなのです。処女作です。
「ここ、変ちゃう？」
「この方がCSS設計カッコよろしいで。」
みたいな指摘があればこっそりtwitterでDM下さい。
コーヒーおごります。
-->
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="<?php echo get_bloginfo('name'); ?>">
<meta property="og:locale" content="ja_JP">
<meta property="og:site_name"  content="<?php bloginfo(); ?>">
<?php if (is_home()): ?>
<title><?php echo get_bloginfo('name'); ?></title>
<link rel="canonical" href="<?php echo home_url('/'); ?>">
<meta name="description" content="<?php gamin_get('home-description'); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo home_url('/'); ?>">
<meta property="og:title" content="<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php gamin_get('home-description'); ?>">
<meta property="og:image" content="<?php echo esc_url(get_theme_file_uri('image/home-image.jpg')); ?>" />
<?php else:?>
<link rel="canonical" href="<?php the_permalink(); ?>">
<meta name="description" content="<?php echo get_the_excerpt(); ?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php the_permalink(); ?>">
<meta property="og:title" content="<?php wp_title(); ?> | <?php bloginfo('name') ?>">
<meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
<meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" />
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="<?php gamin_get('twitter-name'); ?>">
<meta name="format-detection" content="telephone=no">
<!-- <meta property="og:image" content="サイトicon"> -->
<link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_file_uri('image/apple-touch-icon.png')); ?>">
<link rel="icon" href="<?php echo esc_url(get_theme_file_uri('image/favicon.ico')); ?>">
<?php wp_head(); ?>
<?php include_once('analytics.php'); ?>
</head>
<?php 
	$blogTitle = get_bloginfo('name');
	$blogDesc = get_bloginfo('description');
?>
<body <?php body_class(); ?>>
	<!--	header-->
	<header id="header">
		<div class="container header justify-content-space-between">
			<div class="site-name">
				<h1 class="logo">
					<a href="<?php echo esc_url(home_url('/')); ?>" class="logo__link"></a>
					<span class="logo__font"><?php echo $blogTitle; ?></span>
				</h1>
				<span class="site-name__by-me"><?php echo $blogDesc; ?></span>
			</div>
			<nav class="nav">
				<a href="https://feedly.com/i/discover/sources/search/feed/https%3A%2F%2Fyurubo.org">
					<i class="fas fa-rss my-nav-icon fa-wf"></i>
				</a>
				<a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav__item">
					<img src="<?php echo esc_url(get_theme_file_uri('image/face.svg')); ?>" class="my-nav-icon my-nav-icon--svg" alt="">
				</a>
			</nav>
		</div>
		<!--ナビゲーション生成-->
		<?php wp_nav_menu(
			array(
				'theme_location' => 'globalnav'
				, 'container' => 'nav'
				, 'container_class' => 'container'
				, 'menu_class' => 'nav-category'
			)
		); ?>
	</header>
	<!--	/header-->
