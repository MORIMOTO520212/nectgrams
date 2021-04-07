var element_id = document.getElementById("id");
var element_passwd = document.getElementById("passwd");
const sha256 = new jsSHA("SHA-256", "TEXT");

/* login */
function submit() {
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
    setTimeout(function(){location.reload();}, 1000);
}


/* Google onSignIn */
function onSignIn(googleUser) {
    var id_token = googleUser.getAuthResponse().id_token;
    var mid = getCookie("session");
    if("false" == mid){
        /* --- Google login --- */
        $.ajax({
            type: "POST",
            url: "assets/login.php",
            data: {"type": "g_signin", "g_signin_hash": id_token},
            success: function(mid) {
                if(mid){ // Succsessful.
                    console.log(mid);
                    document.cookie = "session="+mid+";path=/";
                    alert("お使いのGoogleアカウントログインしました。");
                    setTimeout(function(){location.replace(location.href.replace("/login/",""))}, 1000);
                }else{  // Failed.
                    alert("このアカウントではログインできませんでした。\nアカウントを紐づけていない場合は、紐づけてください。");
                    logout(); // Delete Google Cookie.
                }
            },
            error: function(){
                alert("通信エラー.");
            }
        });
    }else{
        /* --- Google SignUp --- */
        if("false" != mid){ // is not already.
            $.ajax({
                type: "POST",
                url: "assets/g_signin_submit.php",
                data: {"mid": mid, "g_signin_hash": id_token},
                success: function(res) {
                    if("existed"==res){
                        alert("お使いのGoogleアカウントは既に紐づいています。");
                    }else if("completed"==res){
                        alert("お使いのGoogleアカウントを正常に紐づけました。");
                        setTimeout(function(){location.reload()}, 1000);
                    }else if("failed"==res){
                        alert("お使いのGoogleアカウントの紐づけに失敗しました。\nコンタクトページから関係者に問い合わせてください。");
                        logout();
                    }else if("error_payload"==res){
                        alert("Google認証エラー");
                        logout();
                    }else{
                        alert(res);
                    }
                },
                error: function(){
                    alert("通信エラー.");
                }
            });
        }else{
            // gshも紐づけされていてidでログインした後、googleでログインした場合.
        }
    }
}