document.addEventListener('DOMContentLoaded', function() {
  /**昨日一覧 */
  //アマゾンリンクカード生成
  makeAmznCard();
  //目次生成コンポーネント
  makeElTavleOfContents();
  //href^=#のa要素にスクロールアニメーションを追加
  sectionScroll();
});

function insertAdBeforeSubtitle() {

}


/** table-of-contentsコンポーネント
 * 
 */
function makeElTavleOfContents() {
  //table-of-contentsという要素を取得
  const el_toc = Array.from(document.getElementsByTagName('table-of-contents'));
  //article要素を生成
  let article = makeArticle(['table-of-contents']);
  //目次タイトル
  let p = document.createElement('p');
  //目次body
  let div = document.createElement('div');


  p.classList.add('table-of-contents__header');
  p.innerHTML = '目次';
  div.classList.add('table-of-contents__body');

  div.appendChild(makeTableOfContentsBody('js_note'));
  article.appendChild(p);
  article.appendChild(div);

  el_toc.forEach(function (index){
    //table-of-contentsにarticleを生成
    index.appendChild(article.cloneNode(true));
    //table-of-contentsからarticleを取り出す
    index.parentNode.insertBefore(index.firstChild, index);
    //table-of-contentsを削除
    index.remove();
  });
}


/** classを付与したarticle要素を生成
 * @addClass 要素に追加したいclass
 * @returns article 生成したarticle要素
 */
function makeArticle(addClass='') {
  //article要素を生成
  let article = document.createElement('article');

  //classが指定されている場合、クラスを追加
  if (addClass != '') {
    addClass.forEach(function (index) {
      //クラス追加
      article.classList.add(index);
    });
  }
  return article;

}

/** 記事から目次を作成する。
 *  @tocClassName 目次生成先のclass名
 *  @entryClassName 目次追加元のクラス名
 */
function makeTableOfContentsBody(entryClassName) {
  /** 記事内のh3要素を全て格納 */
  const sectionList = document.querySelectorAll('.' + entryClassName + ' h3');
  //olを生成
  const ol = document.createElement('ol');

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
    a.classList.add('link-hover');
  
    //li要素にa要素を追加
    li.appendChild(a);
    //ol要素にli要素を追加
    ol.appendChild(li);
  });

  return ol;
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
    const name = index.getAttribute(attr_name);
    const img_url = index.getAttribute(attr_img_url);
    const link = index.getAttribute(attr_link);
    const div_amznLink = document.createElement(div);
    const el_a = document.createElement(a);
    const div_text = document.createElement(div);
    const p_name = document.createElement(p);
    const p_url = document.createElement(p);
    const el_span = document.createElement(span);
    const div_img = document.createElement(div);
    const el_img = document.createElement(img)

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
  const scroll = document.body.scrollTop || document.documentElement.scrollTop;

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
      let py = '';

      //hrefを取得
      sectionId = value.getAttribute('href');
      //整形(#を取り除く)
      sectionId = sectionId.substr(1);   
      //a要素のデフォルト処理を無効化
      e.preventDefault();
      if (sectionId != '') {
        //sectionのy座標の位置を取得
        py = window.pageYOffset + document.getElementById(sectionId).getBoundingClientRect().top;
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
  const nowPy = document.body.scrollTop || document.documentElement.scrollTop;
  /** スクロール距離 */
  const scroll = py - nowPy;
  /** 一回分のscroll距離 */
  const diff = scroll - scroll/1.05;

  //移動距離が1以上かつ移動先が画面最下部より上
  if (Math.abs(diff) > 1 && document.body.clientHeight - window.innerHeight >= nowPy + diff) {
    scrollTo(0, nowPy + diff);
    setTimeout(function(){scrollAnimetion(py)}, 5);
  }
}