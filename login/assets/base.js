var element_id = document.getElementById("id");
var element_passwd = document.getElementById("passwd");

/* login */
function submit(){
    let id = element_id.value;
    let password = element_passwd.value;
    console.log(id);
    console.log(password);
    $.ajax({
        type: "POST",
        url: "assets/login.php",
        data: {"id": id, "password": password},
        success: function(sql_userId){
            if(sql_userId){
                console.log(sql_userId);
                document.cookie = "session="+sql_userId+";path=/";
            }else{
                alert("ユーザー名かパスワードが間違っています。\n忘れた場合は関係者に問い合わせてください。");
            }  
        },
        error: function(){
            alert("通信エラー.");
        }
    });
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}

/* Google Signin */
const sha256 = new jsSHA("SHA-256", "TEXT");
function onSignIn(googleUser){
    let profile = googleUser.getBasicProfile();
    let hash = sha256.update(profile.getId()); // user id hash create
    $.ajax({
        type: "POST",
        url: "assets/login.php",
        data: {"g_signin_hash": hash},
        success: function(sql_userId){
            if(sql_userId){
                console.log(sql_userId);
                document.cookie = "session="+sql_userId+";path=/";
            }else{
                alert("このアカウントではログインできません。");
            }  
        },
        error: function(){
            alert("通信エラー.");
        }
    });
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}

/* logout */
function logout(){
    document.cookie = "session=;path=/";
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}
