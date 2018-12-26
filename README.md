# CSSPropertyChecker
CSSプロパティが正しいかを判定する関数．

### 構成
- CSSプロパティ一覧は[TAG index](http://www.tagindex.com/stylesheet/properties/abc.html)よりABC順であることを利用してスクレイプしている．
    - CSSプロパティの最新バージョンが追加されるかは分からないがスクレイピングによって最新バージョンも柔軟に気楽に取得できることを想定している．  
    もっと良い・豊富な辞書サイトがあったら教えてください．
- 関数
    - **cssPropCheck(\$selector,\$cssprop)**  
    この機能を呼び出す際はこの関数にHTMLタグ（セレクタ）とCSSプロパティを渡して呼び出すようにする．  
    戻り値はエラーが無ければtrue，エラーがあればerror文が返される（そのため呼び出す側における判定としては **is_string()** を用いることが望ましい）．
    - **searchCSSJList(\$cssprop)**  
    CSSプロパティ一覧を格納したJSONファイルを取得し，引数に渡されたCSSプロパティの頭文字から探索範囲を限定させその中で一致するプロパティが存在するかを判定する．  
    大文字小文字も区別するため，CSSプロパティは小文字で入力する前提で判定を行っている．
    - **scrapeCSSListToJson()**  
    指定リンクよりABC順のグループとCSSプロパティ群をスクレイピングし，連想配列にまとめJSONファイルとして保存する．

### 使い方
- 本コードでは**phpQuery-onefile.php**を使用しているので，これを以下リンクからダウンロードする．
    - [phpquery | Google Code](https://code.google.com/archive/p/phpquery/downloads)
- test.phpを参考に．
    - 取得したHTMLタグ（セレクタ）とCSSプロパティを関数 **cssPropCheck()** に渡して実行する．
    - **is_string()** で戻り値の判定を行い，エラー文を表示させるなど．
### 出力例
※正常な処理においてはis_string()においてそのようにechoするようにしている．
```php
//「font-color」という存在しないプロパティ
$result=CPC::cssPropCheck("div","font-color");

/*--------------出力--------------*/
//divにおけるCSSプロパティが間違っています。
//Wrong CSS property in div.
```
```php
//大文字が混じったプロパティ
$result=CPC::cssPropCheck("table","Width");

/*--------------出力--------------*/
//tableにおけるCSSプロパティが間違っています。
//Wrong CSS property in table.
```
```php
//正常
$result=CPC::cssPropCheck("body","background-attachment");

/*--------------出力--------------*/
//CSSプロパティは正しいです
//Correct CSS property.
```

    