document.addEventListener('DOMContentLoaded', function() {
  //追加機能一覧

  //目次追加
  makeTableOfContents('js_toc', 'js_note', 'link-hover');

  //href^=#のa要素にスクロールアニメーションを追加
  sectionScroll();

});




/** 記事から目次を作成する。
 *  @tocClassName 目次生成元のclass名
 *  @entryClassName 目次追加先のクラス名
 *  @addClass 見出しに追加したいclass名
 */
function makeTableOfContents(tocClassName, entryClassName, addClass='') {
  /** 対象classを全て格納 */
  let contentsList = document.getElementsByClassName(tocClassName);
  //配列に変換
  contentsList = Array.from(contentsList);
  /** 記事内のh3要素を全て格納 */
  let sectionList = document.querySelectorAll('.' + entryClassName + ' h3');

  //ulを生成
  let ol = document.createElement('ol');

  //取得した見出しタグ要素の数だけ繰り返す
  sectionList.forEach(function (value, i) {
    //idが空の場合はsection番号を追加
    if (value.id == '') {
      value.id = i+1;
    }
    //要素を生成
    let li = document.createElement('li');
    let a = document.createElement('a');

    //<a>見出し</a>
    a.innerHTML = value.textContent;
    //a要素にid追加
    a.href = '#' + value.id;
    //a要素にclass追加
    if (addClass != '') {
      a.classList.add(addClass);
    }
    //li要素にa要素を追加
    li.appendChild(a);
    //ol要素にli要素を追加
    ol.appendChild(li);
  });

  //tocClassNameのclassをもつ要素にすべて適用する
  contentsList.forEach(function (index){
    index.appendChild(ol);
  }); 
}


// /** 画面トップにスクロールする機能 */
// function scrollTop() {
//   //.js_scrollTTopの要素を取得
//   let scrollTopList = document.getElementsByClassName('js_scrollTop');
//   //配列に変換
//   scrollTopList = Array.from(scrollTopList);

//   //js_scrollTopが割り当てられている数だけ繰り返す
//   scrollTopList.forEach(function(value){
//     //イベントリスナー：クリック
//     value.addEventListener('click', function(e){
//       //a要素のデフォルトのクリックイベントを無効化
//       e.preventDefault();
//       //スクロール
//       pageTop();
//     });
//   }); 
// }


/** スクロールのアニメーション機能 */
function pageTop() {

  /** 現在のy座標を取得 */
  let scroll = document.body.scrollTop || document.documentElement.scrollTop;

  //画面トップまで繰り返す
  if (scroll) {
    scrollTo(0, scroll/1.05);
    setTimeout(function(){pageTop()}, 5);
  }
}


/** 対応するセクションまでスクロールする
 * 
 */
function sectionScroll() {
  //hrefが#で始まる要素を取得
  let scrollList = document.querySelectorAll('a[href^="#"]');
  //配列に変換
  scrollList = Array.from(scrollList);

  //リストの数だけ繰り返す
  scrollList.forEach(function(value){
    value.addEventListener('click', function(e) {
      /** scroll先のid */
      let sectionId = '';
      /** section要素の高さ */
      py = '';

      //hrefを取得
      sectionId = value.getAttribute('href');
      //整形(#を取り除く)
      sectionId = sectionId.substr(1);   

      //a要素のデフォルト処理を無効化
      e.preventDefault();
      if (sectionId != '') {
        //sectionのy座標の位置を取得
        py = document.getElementById(sectionId).getBoundingClientRect().top;
        //scrollTo(0, py - 32);
        scrollAnimetion(py - 32);
      } else { //href="#"は画面トップへスクロールするの意
        pageTop(0);
      }
    });
  });
}

/** スクロールのアニメーション機能 */
function scrollAnimetion(py) {

  /** 現在のy座標を取得 */
  let nowPy = document.body.scrollTop || document.documentElement.scrollTop;
  /** スクロール距離 */
  let scroll = py - nowPy;
  /** 一回分のscroll距離 */
  let diff = scroll - scroll/1.05;

  //移動距離が1以上かつ移動先が画面最下部より上
  if (Math.abs(diff) > 1 && document.body.clientHeight - window.innerHeight >= nowPy + diff) {
    scrollTo(0, nowPy + diff);
    setTimeout(function(){scrollAnimetion(py)}, 5);
  }
}