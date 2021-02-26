# Nectgrams
<img src="https://user-images.githubusercontent.com/28892090/99180929-ee6d6f80-276d-11eb-8453-f8e0e8e817c4.png" width="400">  

### 役割
web_home - 紗帆さん  
web_products - 終わり次第  
web_activity - 終わり次第  
web_login - 森本  

### ホームページ
作品画像サイズ：5x3  

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
Cookieで管理　失効期間1ヶ月~6ヶ月
- プログラム  
HTML5/CSS, JS, PHP

googleアカウントでのログインとパスワードでのログインの実装。  

[base table]  
username VARCHAR(20), password VARCHAR(100), userid VARCHAR(10)  

[product table]  
id VARCHAR(10), userid VARCHAR(10), title VARCHAR(50), message VARCHAR(200), photo VARCHAR(50)  

[activity table]  
id VARCHAR(10), userid VARCHAR(10), message VARCHAR(200), photo VARCHAR(50)  