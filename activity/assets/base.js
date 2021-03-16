/* logout */
function logout(){
    document.cookie = "session=;path=/";
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}

var e_date = document.getElementById("date");
var e_group = document.getElementById("group");
var e_contributor = document.getElementById("contributor");
var e_target = document.getElementById("target");
var e_do = document.getElementById("do");
var e_share = document.getElementById("share");

function submit(){
    var date = e_date.value.replace(/-/g, "/");
    var group = e_group.value;
    var contributor = e_contributor.value;
    var target_text = e_target.value;
    var do_text = e_do.value;
    var share_text = e_share.value;
    if(!group){
        alert("所属班が記入されていません。");
        return 0;
    }
    if(!contributor){
        alert("入力者が記入されていません。");
        return 0;
    }
    if(!target_text){
        alert("”目標”が記入されていません。");
        return 0;
    }
    if(!do_text){
        alert("”できたこと”が記入されていません。");
    }
    $.post("assets/submit.php", {"date": date,"group": group,"contributor": contributor,"target": target_text,"do": do_text,"share": share_text}, function(data){
        console.log("activity submit.");
        console.log(data);
    });
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}