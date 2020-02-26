document.addEventListener('DOMContentLoaded', function() {
  //追加機能一覧

  //目次追加
  makeTableOfContents('js_toc', 'js_note', 'link-hover');

  //アマゾンリンクカード生成
  makeAmznCard();

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

/**
 * アマゾンリンクカードを生成する
 */
function makeAmznCard() {
  let cardList = document.getElementsByClassName('amzn-card_js');
  cardList = Array.from(cardList);

  const attr_name = 'name';
  const attr_img_url = 'img-url';
  const attr_link = 'link';
  const btnName = 'Amazon.co.jpで購入';
  const div = 'div';
  const a = 'a';
  const p = 'p';
  const span = 'span';
  const img = 'img';
  const cl_amznName = 'amzn-name';
  const cl_amznUrl = 'amzn-url';
  const cl_amznLink__text = 'amzn-link__text';
  const cl_amznLink__a = 'amzn-link__a';
  const cl_amznLink__img = 'amzn-link__img';
  const cl_amznLink = 'amzn-link';
  const blank = '_blank';


  cardList.forEach(function (index) {
    let name = index.getAttribute(attr_name);
    let img_url = index.getAttribute(attr_img_url);
    let link = index.getAttribute(attr_link);
    let div_amznLink = document.createElement(div);
    let el_a = document.createElement(a);
    let div_text = document.createElement(div);
    let p_name = document.createElement(p);
    let p_url = document.createElement(p);
    let el_span = document.createElement(span);
    let div_img = document.createElement(div);
    let el_img = document.createElement(img)

    //div.amzn-link__text要素の生成
    p_name.classList.add(cl_amznName);
    p_name.innerHTML = name;
    p_url.classList.add(cl_amznUrl);
    el_span.innerHTML = btnName;
    p_url.appendChild(el_span);
    div_text.classList.add(cl_amznLink__text);
    div_text.appendChild(p_name);
    div_text.appendChild(p_url);

    //a要素の生成
    el_a.href = link;
    el_a.classList.add(cl_amznLink__a);
    el_a.target = blank;

    //div>img要素の生成
    div_img.classList.add(cl_amznLink__img);
    el_img.src = img_url;
    div_img.appendChild(el_img);

    //div.amzn-linkの生成
    div_amznLink.classList.add(cl_amznLink);
    div_amznLink.appendChild(el_a);
    div_amznLink.appendChild(div_text);
    div_amznLink.appendChild(div_img);
    
    index.appendChild(div_amznLink);
  });
}

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