/* logout */
function logout(){
    document.cookie = "session=;path=/";
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}



/* product upload */
var element_setimg = document.getElementById("setimg");
var element_header = document.getElementById("header");
var element_message = document.getElementById("message");
var up_filename = "";


function setfile(filename){ // 画像表示
    element_setimg.setAttribute("src", "../database/images/"+filename);
    up_filename = filename;
}

$(function(){
    $('#drag-area').bind('drop', function(e){
        e.preventDefault();
        var files = e.originalEvent.dataTransfer.files;
        uploadFiles(files);
    }).bind('dragenter', function(){
        return false;
    }).bind('dragover', function(){
        return false;
    });
    
    $('#btn').click(function() {
        console.log("drop button");
        $('input[type="file"]').click();
    });
    
    $('input[type="file"]').change(function(){
        var files = this.files;
        uploadFiles(files);
    });
});

function uploadFiles(files) {
    var fd = new FormData();
    var filesLength = files.length;
    
    for (var i = 0; i < filesLength; i++) {
        console.log("get file name: "+files[i]["name"]);
        fd.append("files[]", files[i]);
    }
    
    // Ajaxでアップロード処理をするファイルへ内容渡す
    $.ajax({
        url: "assets/upload.php",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        success: function(data) {
            alert(data);
            setfile(data);
        }
    });
}

/* product submit */
function submit(){
    if(!up_filename){
        alert("画像がセットされていません。");
        return 0;
    }
    if(!element_header.value){
        alert("ヘッダーメッセージがセットされていません。");
        return 0;
    }
    if(!element_message.value){
        alert("メッセージがセットされていません。");
        return 0;
    }
    let title = element_header.value;
    let message = element_message.value;
    let photo = "../database/images/" + up_filename;
    $.post("assets/submit.php", {"title": title, "message": message, "photo": photo}, function(data){
        console.log("product submit.");
        console.log(data);
    });
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}