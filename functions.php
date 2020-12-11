<?php 
/* 各種設定 ------------------------------------------------------------------- */
function gamin_get($key) {
	/** twittter アカウント名 @xxxx  */
	$twitter_at = '';
	/** ホーム画面のdescription、いわゆる紹介文(SEO対策) */
$home_description= '';

	try {
		switch($key) {
			case 'twitter-link' :
				echo '//twitter.com/'.$twitter_at;
			break;
			
			case 'home-description':
				echo $home_description;
			break;

			case 'twitter-name' :
				echo '@'.$twitter_at;
			break;

			default :
				throw new Exception('Error:gamin_get()');
		}
	} catch(Exception $e) {
		echo $e->getMessage();
	}

}

function gamin_get_home_description() {
	echo "$my_home_description";
}

//Making jQuery to load from Google Library
function replace_jquery() {
  if (!is_admin()) {
    // comment out the next two lines to load the local copy of jQuery
    wp_deregister_script('jquery');
  }
}



/* wp setting ---------------------------------------------------------------- */
add_action('init', 'replace_jquery');
//コンテンツ幅をセット
if (! isset($content_width)) {
	$content_width = 723;
}

//アイキャッチ画像を有効にする。
add_theme_support('post-thumbnails');

function custom_theme_setup() {
	//head内にフィードリンクを出力(RSS)
	add_theme_support('automatic-feed-links');
	
	//タイトルタグを動的に出力(静的なtitleタグが不要になる。と思ったらトップページには反映されないからトップだけ静的に記述する必要ありかも)
	add_theme_support('title-tag');
	
	//ブロックエディター用のcssを有効化
	add_theme_support('wp-block-style');
	
	//埋め込みコンテンツをレスポンシブ対応に
	add_theme_support('responsive-embeds');
	
	//カスタムメニュー有効化、メニューの位置を設定
	register_nav_menus(
		array(
			'globalnav' => 'グローバルナビゲーション'
		)
	);
}
add_action('after_setup_theme', 'custom_theme_setup');

//style sheet,scriptの読み込み
function myportfolio_scripts() {
	//reset.cssの読み込み
	wp_enqueue_style(
		'reset-style'
		, get_template_directory_uri().'/css/reset.css'
		, array()
		, '1.0'
		, 'all'
	);
	
	//style.cssの読み込み
	wp_enqueue_style(
		'base-style'
		, get_stylesheet_uri()
		, array('reset-style')
		, '1.6.0'
		, 'all'
	);
	
	//FontAwesomeの読み込み
	wp_enqueue_style(
		'font-awesome'
		, '//use.fontawesome.com/releases/v5.6.3/css/all.css'
		, array('base-style')
		, '1.0'
		, 'all'
	);

		//google DCNのjQueryの読み込み
		wp_enqueue_script(
			'DCN-jQuery'
			, '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'
			, array()
			, '1.0'
			, true
		);

	//script.jsの読み込み
	wp_enqueue_script(
		'main-script'
		, get_theme_file_uri('js/script.js')
		, array('DCN-jQuery')
		, '1.4.4'
		, true
	);
	
	
	//adobe.js
//	wp_enqueue_script(
//		'adobe-script'
//		, get_template_directory_uri().'/js/adobe.js'
//		, array()
//		, '1.0'
//		, false
//	);
}
add_action('wp_enqueue_scripts', 'myportfolio_scripts');



/* gamin function ------------------------------------------------------------ */
/**
 * ページネーション出力関数
 * $pages : 全ページ数
 * $paged : 現在のページ
 */
function pagination( $pages, $paged) {

	/** float型なのでint型 へ */
	$pages = (int) $pages;
	/** get_query_var('paged')をそのまま投げても大丈夫なように */
	$paged = (int) $paged ?: 1;
	/** 生成文字列 */
	$str_html ='';
	/** 「前へ」に当たる表示文字列 */
	$text_before  = '<i class="fas fa-angle-left"></i> newer page';
	/** 「次へ」に当たる表示文字列 */
	$text_next    = 'older page <i class="fas fa-angle-right"></i>';

	//全ページ数が1ページのみの場合は非表示
	if ( $pages === 1 ) {
		//スルー
	//全ページ数が2ページ以上の場合
	} else {
		$str_html .= '<ul class="pagination">';
		//「前へ」のhtml表示
		$str_html .= '<li class="pagination__item">';
		if ($paged > 1) {//1ページ目でなければ「前へ」を表示
			$str_html .= '<a href="'.get_pagenum_link( $paged - 1 ).'">'.$text_before.'</a>';
		}
		$str_html .= '</li>';

		//「次へ」のhtml表示
		$str_html .= '<li class="pagination__item">';
		if ($paged < $pages) { //最終ページでなければ「次へ」を表示
			$str_html .= '<a href="'.get_pagenum_link( $paged + 1 ).'">'.$text_next.'</a>';
		}
		$str_html .= '</li>';
		$str_html .= '</ul>';

		//htmlの表示
		echo $str_html;
	}
}
