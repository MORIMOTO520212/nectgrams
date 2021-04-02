<?php
require "container/connect_mysql_users.php";
require "container/login_session_check.php";


$session = sessionCheck($mysqli); // return true or false.

// get products json data
$topics_data = file_get_contents("database/topics.json");
$topics_data = json_encode($topics_data);
//$products_data = mb_convert_encoding($products_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
//$products = json_decode($products_data, true);
?>
<!DOCTYPE html>
<html>
    <head id="head">
        <title>Nectgrams - サークルページ</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <?php require "container/metadata.html" ?>
        <?php require "container/open_graph_protocol.html" ?>
    </head>
    <body>
        <div class="block">
            <div class="smart-header">
                <div class="smart-logo">
                    <p><img src="assets/nectgrams_icon.png">Nectgrams</p>
                </div>
            </div>
            <div class="smart-main">
                <div class="smart-message"><p>申し訳ございませんが、現在スマートフォン向けのウェブサイトは開発中ですので、パソコンからのアクセスをお願い致します。</p></div>
                <div class="smart-m_b">
                    <div class="title"><p>共　創</p></div>
                    <div class="msg"><p>
                        チームとして最高のモノを作り上げる環境を提供します。プログラミングは大学でも学び、
                        かつ独学でも習得できます。Nectgramsはプログラミングスキルの向上を一つの結果と捉え、より実践的かつその応用の場として、
                        メンバー一人ひとりがプロジェクトを着々と達成し、成果を残す。複数人の力でより大きなものを作り上げることができる。
                        それを目的としています。その為、活動報告や進捗チェックが頻繁に行われたり、班が複数存在し、
                        取り扱うテーマに制限がないなどの特徴があります。一方、「個人制作を楽しみを共有する」「プログラミングのスキルアップをする」
                        といった活動は基本的にサポートされません。
                    </p></div>
                </div>
                <div class="smart-m_b">
                    <div class="title"><p>このサークルについて</p></div>
                    <div class="msg">
                        <p>
                            各班に分かれてそれぞれの活動を行います。
                            主にDiscordで活動していますが、ミーティングをする場合は学校内で集まり行っています。
                        </p>
                        <div class="team"><p>・WEB班</p></div>
                        <div class="msg"><p>
                            WEB班は主にウェブサイトやウェブアプリケーションをグループで製作します。そのほかにも、
                            Linux操作やデータベース、ネットワーク構築、SEOの勉強などもしています。ウェブやサーバー、ネットワークに興味がある方は大歓迎です！
                            ちなみに、このホームページはWEB班が製作しています。
                        </p></div>
                        <div class="team"><p>・NNC深層学習班</p></div>
                        <div class="msg"><p>
                            人工知能の
                        </p></div>
                        <div class="team"><p>・アプリ開発班</p></div>
                        <div class="msg"><p>
                            アプリ開発班はスマートフォンのアプリケーションの製作をしています。
                        </p></div>
                        <div class="team"><p>・Unityゲーム開発班</p></div>
                        <div class="msg"><p></p></div>
                    </div>
                </div>
                <div class="smart-footer">
                    <div class="f-main">
                        <div class="f-title"><p>Nectgrams</p></div>
                        <div class="f-msg"><p>パソコンからのアクセスでは作品、活動、FAQ、ページなどにアクセスすることができます。</p></div>
                    </div>
                </div>
            </div>
        </div>
        <script>var topics = JSON.parse(<?php echo $topics_data ?>);</script>
        <script>var session = <?php echo $session ?>;</script>
        <?php require "container/header.html" ?>
        <div class="g-signin2" data-onsuccess="onSignIn" style="display:none;"></div>
        <div class="main">
            <div class="product_sb">
                <div class="scroll">
                    <a href="javascript:scroll_view('back', true);"></a>
                    <div class="btn"><img src="assets/left_arrow.png"></div>
                </div>
                <div id="screen" class="screen">
                    <img id="scroll_img_1" src>
                    <img id="scroll_img_2" src>
                </div>
                <div class="scroll">
                    <a href="javascript:scroll_view('next', true);"></a>
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
                    <p>
                        各班に分かれてそれぞれの活動を行います。
                        主にDiscordで活動していますが、ミーティングをする場合は学校内で集まり行っています。
                    </p>
                    <div class="team"><p>・WEB班</p></div>
                    <div class="msg"><p>
                        WEB班は主にウェブサイトやウェブアプリケーションをグループで製作します。そのほかにも、
                        Linux操作やデータベース、ネットワーク構築、SEOの勉強などもしています。ウェブやサーバー、ネットワークに興味がある方は大歓迎です！
                        ちなみに、このホームページはWEB班が製作しています。
                    </p></div>
                    <div class="team"><p>・NNC深層学習班</p></div>
                    <div class="msg"><p>
                        NNC（Neural Network Console）を活用してAIの深層学習を学んでいます。
                    </p></div>
                    <div class="team"><p>・アプリ開発班</p></div>
                    <div class="msg"><p>
                        アプリ開発班はスマートフォンのアプリケーションの製作をします。他にもアプリケーション製作を中心に、Java言語のを学んだり、レイアウトを考えたりしています。
                        現在、アプリ開発班はToDoリストを製作しています。
                    </p></div>
                    <div class="team"><p>・Unityゲーム開発班</p></div>
                    <div class="msg"><p>
                        Unityを使ってゲームの開発をしています。
                    </p></div>
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
                                <p>プログラミングに触れたことがないのですが、参加することはできますか。</p>
                            </div>
                        </div>
                        <div class="question">
                            <div class="a-icon"><p>A</p></div>
                            <div class="q-msg">
                                <p>可能です。プログラミング自体は大学でも触れますし、追々身に着ければ問題ありません。「やりたいこと」が明確である事が大切です。</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-box">
                        <div class="question">
                            <div class="q-icon"><p>Q</p></div>
                            <div class="q-msg">
                                <p>具体的になにをしているのか教えて欲しいです。</p>
                            </div>
                        </div>
                        <div class="question">
                            <div class="a-icon"><p>A</p></div>
                            <div class="q-msg">
                                <p>何をしているのかは班によって変わりますが、共通するのは、ゲームであれアプリであれ、班で何を作るかを決め、計画を練り、制作を行うという事です。Nectgramsはその枠組みと場を提供しています。</p>
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
                                <p>班のかけ持ちに制限はありませんので複数の掛け持ちが可能です。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m_b">
                    <div class="title"><p>Languages</p></div>
                    <div class="msg"><p>Nectgramsのウェブサイトはこれらのファイルから成り立っています。</p></div>
                    <div class="img"><img src="assets/languages.png"></div>
            </div>
        </div>
        <?php require "container/footer.html" ?>
        <script src="assets/base.js"></script>
    </body>
</html>