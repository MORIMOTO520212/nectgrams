# Nectgrams
<img src="https://user-images.githubusercontent.com/28892090/99180929-ee6d6f80-276d-11eb-8453-f8e0e8e817c4.png" width="400">  

# やること

## ホームページ  
- モバイル端末の画面を作る。  
- ホームページに使われている言語を表記する。  

## 作品ページ  

## 活動ページ  
- 投稿するとき、Googleスプレッドシートに記述する。  
- <班活動>記録に表示する情報は活動日、入力者、所属班、種別(班の新規作成・班の活動に関する更新/活動の経過報告)、活動内容、班での製作物、班長の名前、班員の名前、製作物の完成度、班全体の活動状況
- ログインユーザーのみ進捗グラフを表示。  

## ログインページ  
 

# ドメインとDNSの設定
ドメイン取得：お名前ドットコム
サイトURL：https://www.nectgrams.com  
レジストラ：Google Cloud Platform Cloud DNS  
NSレコード：  
ns-cloud-d1.googledomains.com  
ns-cloud-d2.googledomains.com  
ns-cloud-d3.googledomains.com  
ns-cloud-d4.googledomains.com  
Aレコード：  
www.nectgrams.com ttl300s ip34.105.127.227  

# SSL
Let's Encrypt  

# サーバーへのログイン方法
ホストIP：34.105.127.227  
ユーザー名：nectgrams  
パスワード：agario520212  
秘密鍵：nectgrams-ssh-key.ppk  

# ホームページ
作品画像サイズ：5x3  
Open Graph Protocol 1200x630px 5MB  

# 作品ページ
作品画像サイズ：5x3  

- プログラム  
HTML5/CSS, JS, PHP
レスポンシブ対応範囲：1290px ~ 1980px  

# 活動ページ

- プログラム  
HTML5/CSS, JS, PHP
レスポンシブ対応範囲：1290px ~ 1980px  

# ログインページ

- ログインデータ  
データベース管理 mySQL
- セッション  
Cookieで管理　失効期間：ブラウザを閉じるまで  
- プログラム  
HTML5/CSS, JS, PHP

googleアカウントでのログインとパスワードでのログインの実装。    

## ユーザー管理テーブル  
```bash
CREATE TABLE users(id VARCHAR(50), password VARCHAR(64), gsh VARCHAR(64), mid VARCHAR(12) PRIMARY KEY, name VARCHAR(100), `group` VARCHAR(100), count INT, last VARCHAR(10));  
```
## Users Table  
|カラム|説明|エンコード|型|
|--|--|--|--|
|`id`|ユーザーID|半角英数+記号|varchar(50)|
|`password`|パスワード|SHA256 HEX|varchar(64)|
|`gsh`|Google SignIn Hash|SHA256 HEX|varchar(64)|
|`mid`|ユーザー識別ID|半角英数(12文字)|varchar(12)|PRIMARY KEY|
|`name`|ユーザー名|base64|varchar(100)|
|`group`|所属班|base64|varchar(100)|
|`count`|アクセスカウンタ|int|int|
|`last`|最終アクセス日時|yyyy/mm/dd|varchar(10)|

## 挿入形式  
```bash
INSERT INTO users VALUES('id', 'pass-sha256', 'google-signin-sha256', 'mid, 'name-base64', 'group-base64', 0, '2021/03/18');  
```

## GCP server MySQL ログイン
```bash
mysql -u nectgrams -p
agario520212
```

# コンタクトページ
サークルの加入についてはサークル管理者に連絡してください。

# 連絡先
サークル管理
- 稲野辺 快生 Twitter Discord
ホームページ管理
- 森本 悠真 Twitter Discord
- 近藤 紗帆 Twitter Discord
- 栗田 悠矢 Twitter Discord
