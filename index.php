<?php
// get products json data
$products_data = file_get_contents("database/products.json");
$products_data = json_encode($products_data);
//$products_data = mb_convert_encoding($products_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
//$products = json_decode($products_data, true);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nectgrams - サークルページ</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <script>
            var products = JSON.parse(<?php echo $products_data ?>);
        </script>
        <?php require "container/header.html" ?>
        <div class="main">
            <div class="product_sb">
                <div class="scroll">
                    <a href="javascript:scroll_view('back');"></a>
                    <div class="btn"><img src="assets/left_arrow.png"></div>
                </div>
                <div id="screen" class="screen">
                    <img id="scroll_img_1" src="sample_images/img_01.jpg">
                    <img id="scroll_img_2" src="sample_images/img_03.png">
                </div>
                <div class="scroll">
                    <a href="javascript:scroll_view('next');"></a>
                    <div class="btn"><img src="assets/right_arrow.png"></div>
                </div>
                <div id="sb_btn_s"></div>
            </div>
            <div class="m_b">
                <div class="title"><p>共　創</p></div>
                <div class="msg">
                    <p>
                        チームとして最高のモノを作り上げる環境を提供します。プログラミングは大学でも学び、
                        かつ独学でも習得できます。Nectgramsはプログラミングスキルの向上を一つの結果と捉え、より実践的かつその応用の場として、
                        メンバー一人ひとりがプロジェクトを着々と達成し、成果を残す。複数人の力でより大きなものを作り上げることができる。
                        それを目的としています。その為、活動報告や進捗チェックが頻繁に行われたり、班が複数存在し、
                        取り扱うテーマに制限がないなどの特徴があります。一方、「個人制作を楽しみを共有する」「プログラミングのスキルアップをする」
                        といった活動は基本的にサポートされません。
                    </p>
                </div>
            </div>
            <div class="m_b">
                <div class="title"><p>このサークルについて</p></div>
                <div class="msg">
                    <p>各班に分かれてそれぞれの活動を行います。</p>
                    <div class="team"><p>・WEB班</p></div>
                    <div class="msg"><p>WEB班の紹介文を書きます。</p></div>
                    <div class="team"><p>・NNC深層学習班</p></div>
                    <div class="msg"><p></p></div>
                    <div class="team"><p>・アプリ開発班</p></div>
                    <div class="msg"><p></p></div>
                    <div class="team"><p>・Unityゲーム開発班</p></div>
                    <div class="msg"><p></p></div>
                </div>
            </div>
            <div class="m_b">
                <div class="title"><p>FAQ</p></div>
                <div class="faq-main">
                    <div class="faq-box">
                        <div class="question">
                            <div class="q-icon"><p>Q</p></div>
                            <div class="q-msg">
                                <p>プログラミングの知識がなくても大丈夫ですか。</p>
                            </div>
                        </div>
                        <div class="question">
                            <div class="a-icon"><p>A</p></div>
                            <div class="q-msg">
                                <p>知識は問いません。プロジェクトをやり切るやる気を問います。</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-box">
                        <div class="question">
                            <div class="q-icon"><p>Q</p></div>
                            <div class="q-msg">
                                <p>週にどれくらい活動しますか。</p>
                            </div>
                        </div>
                        <div class="question">
                            <div class="a-icon"><p>A</p></div>
                            <div class="q-msg">
                                <p>月数回〜週2〜3回まで、班によって様々です。</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-box">
                        <div class="question">
                            <div class="q-icon"><p>Q</p></div>
                            <div class="q-msg">
                                <p>サークルに入ると、どれくらいの費用がかかりますか。</p>
                            </div>
                        </div>
                        <div class="question">
                            <div class="a-icon"><p>A</p></div>
                            <div class="q-msg">
                                <p>班の方針にもよりますが現状費用がかかる班はありません。また、現状費用が発生する予定もありません。</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-box">
                        <div class="question">
                            <div class="q-icon"><p>Q</p></div>
                            <div class="q-msg">
                                <p>サークルに定員はありますか。</p>
                            </div>
                        </div>
                        <div class="question">
                            <div class="a-icon"><p>A</p></div>
                            <div class="q-msg">
                                <p>ありません。しかし、班に所属する際には班のポリシーや了解に基づきます。</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-box">
                        <div class="question">
                            <div class="q-icon"><p>Q</p></div>
                            <div class="q-msg">
                                <p>班をかけ持つことはできますか。</p>
                            </div>
                        </div>
                        <div class="question">
                            <div class="a-icon"><p>A</p></div>
                            <div class="q-msg">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="f-main">
                <div class="f-title"><p>Nectgrams</p></div>
                <div class="f-msg"><p>ここへフッターのメッセージを書きます。</p></div>
                <div class="f-link">
                    <a href="#">作品</a>
                    <a href="#">活動</a>
                    <a href="#">このサークルについて</a>
                    <a href="#">FAQ</a>
                    <a href="#">コンタクト</a>
                </div>
            </div>
        </div>
        <script src="assets/base.js"></script>
    </body>
</html>