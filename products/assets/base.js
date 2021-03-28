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
var e_ta_markdown = document.getElementById("input_markdown");
var sample_txt = "## Markdown 記述シート\n作品の詳細な内容を記述してください。\n# 見出し１\n## 見出し２\n### 見出し３\n- リスト１\n- リスト２\n- リスト３\n\n**強調**\n\n[リンク](https://www.nectgrams.com)";
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
        alert("ヘッダーメッセージが記入されていません。");
        return 0;
    }
    if(!element_message.value){
        alert("メッセージが記入されていません。");
        return 0;
    }
    if(sample_txt==e_ta_markdown.value){
        alert("内容が書かれていません。");
        return 0;
    }
    var title = element_header.value;
    var message = element_message.value;
    var photo = "database/images/" + up_filename;
    var document = e_ta_markdown.value;

    $.post("assets/submit.php", {
        "title": title,
        "message": message,
        "photo": photo,
        "document": document
        },
        function(data){
            console.log("product submit.");
            console.log(data);
    });
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}

/* markdown */
var e_preview = document.getElementById("preview");
var e_main = document.getElementById("main");
var e_document = document.getElementById("document");
var e_document_title = document.getElementById("document_title");

$("textarea").on("keyup", function() {
    var data = e_ta_markdown.value;
    e_preview.innerHTML = markdown(data);
});

/* sample */
e_ta_markdown.value = sample_txt;
e_preview.innerHTML = markdown(sample_txt);

function documentWrite(){
    e_main.setAttribute("style","display:none;");
    e_document.setAttribute("style","");
    console.log("open the Markdown window.");
    var title = element_header.value;
    e_document_title.innerText = title;
}

function document_submit(){
    e_main.setAttribute("style","");
    e_document.setAttribute("style","display:none;");
    console.log("product document submit.");

}

function markdownCloseWindow(){
    e_main.setAttribute("style","");
    e_document.setAttribute("style","display:none;");
    console.log("close the Markdown window.");
}