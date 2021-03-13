# Nectgrams
<img src="https://user-images.githubusercontent.com/28892090/99180929-ee6d6f80-276d-11eb-8453-f8e0e8e817c4.png" width="400">  

### やること
[ホームページ]
・FAQを増やす。
[ログインページ]
・Google Sign-InとmySQLを連結させる。
[活動ページ]
・個人活動と班活動で切り替えるスイッチ。
・<個人活動>記録に表示する情報は活動日、入力者、所属班、今回の到達目標、できたこと、全体や班で共有したい発見・疑問など
・<班活動>記録に表示する情報は活動日、入力者、所属班、種別(班の新規作成・班の活動に関する更新/活動の経過報告)、活動内容、班での製作物、班長の名前、班員の名前、製作物の完成度、班全体の活動状況
・ログインユーザーのみ進捗グラフを表示。

### 役割
web_home - 紗帆さん  
web_products - 終わり次第  
web_activity - 終わり次第  
web_login - 森本  

### ホームページ
作品画像サイズ：5x3  

FAQ  
班をかけ持つことはできますか。  

### 作品ページ
作品画像サイズ：5x3  

- プログラム  
HTML5/CSS, JS, PHP

レスポンシブ対応範囲：1290px ~ 1980px  
ログイン後に作品を投稿できるページを設ける。  

### 活動ページ

- プログラム  
HTML5/CSS, JS, PHP

レスポンシブ対応範囲：1290px ~ 1980px  
ログイン後に作品を投稿できるページを設ける。  

### ログインページ

- ログインデータ  
データベース管理 mySQL
- セッション  
Cookieで管理　失効期間：ブラウザを閉じるまで  
- プログラム  
HTML5/CSS, JS, PHP

googleアカウントでのログインとパスワードでのログインの実装。  

[base table]  
username VARCHAR(20), password VARCHAR(100), userid VARCHAR(10)  

[product table]  
id VARCHAR(10), userid VARCHAR(10), title VARCHAR(50), message VARCHAR(200), photo VARCHAR(50)  

[activity table]  
id VARCHAR(10), userid VARCHAR(10), message VARCHAR(200), photo VARCHAR(50)  

### コンタクトページ
サークルの加入についてはサークル管理者に連絡してください。

連絡先
サークル管理
- 稲野辺 快生 Twitter Discord
ホームページ管理
- 森本 悠真 Twitter Discord
- 近藤 紗帆 Twitter Discord
- 栗田 悠矢 Twitter Discord
