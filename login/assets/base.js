var element_id = document.getElementById("id");
var element_passwd = document.getElementById("passwd");
const sha256 = new jsSHA("SHA-256", "TEXT");

/* login */
function submit(){
    let id = element_id.value;
    let password = element_passwd.value;
    sha256.update(password);
    let pass_hash = sha256.getHash("HEX");
    $.ajax({
        type: "POST",
        url: "assets/login.php",
        data: {"type": "form", "id": id, "pass_hash": pass_hash},
        success: function(mid){
            if(mid){
                console.log(mid);
                document.cookie = "session="+mid+";path=/";
            }else{
                alert("ユーザー名かパスワードが間違っています。\nパスワードを忘れた場合は関係者に問い合わせてください。");
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
function onSignIn(googleUser){
    let profile = googleUser.getBasicProfile();
    // user id hash create
    sha256.update(profile.getId());
    let hash = sha256.getHash("HEX");
    console.log(profile.getId());
    if(!session){
        $.ajax({
            type: "POST",
            url: "assets/login.php",
            data: {"type": "g_signin", "g_signin_hash": hash},
            success: function(mid){
                if(mid){
                    console.log(mid);
                    document.cookie = "session="+mid+";path=/";
                }else{
                    alert("このアカウントではログインできません。\nログインできない場合は関係者に問い合わせてください。");
                }  
            },
            error: function(){
                alert("通信エラー.");
            }
        });
        setTimeout(function(){location.reload()}, 1000);
    }else{
        $.ajax({
            type: "POST",
            url: "assets/g_signin_submit.php",
            data: {"mid": getCookie("session"), "g_signin_hash": hash},
            success: function(res){
                if("existed"==res){
                    console.log("google signin existed.");
                }else if("completed"==res){
                   alert("Googleアカウントを正常に紐づけました。");
                   setTimeout(function(){location.reload()}, 1000);
                }else if("failed"==res){
                    alert("Googleアカウントの紐づけに失敗しました。\nコンタクトページから関係者に問い合わせてください。");
                }else{
                    alert(res);
                }
            },
            error: function(){
                alert("通信エラー.");
            }
        });
        
    }
}