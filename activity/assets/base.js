/* logout */
function logout(){
    document.cookie = "session=;path=/";
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}

/* activities viewer , viewer controller */
var activities = [];
var sort_db = [];
function getData_activities(jsonData){
    activities = jsonData;
    for(let i=0; i<activities.length; i++){
        let sp_date = activities[i]["date"].split("/");
        sp_date[0]*12*30 + sp_date[1]*30 + sp_date[2]
    }

}
$.post("../getData.php", {"dataType": "activity"}, function(getData){
    var jsonData = JSON.parse(getData);
    getData_activities(jsonData);
    activities_view("person", "normal"); // initial
});

var e_activities = document.getElementById("activities");
var e_person_kind = document.getElementById("person_kind");
var e_group_kind = document.getElementById("group_kind");
var e_colum_normal = document.getElementById("colum_normal");
var e_colum_reverse = document.getElementById("colum_reverse");
var e_pk_p = document.getElementById("pk_p");
var e_gk_p = document.getElementById("gk_p");
var e_cn_p = document.getElementById("cn_p");
var e_cr_p = document.getElementById("cr_p");
var _kind = "person";
var _colum = "normal";
function activities_view(kind, colum) { // kind - person, group   colum - normal, reverse
    console.log("activities view - ", kind, colum);
    if(0 == kind){kind = _kind}
    else{_kind = kind}
    if(0 == colum){colum = _colum}
    else{_colum = colum}
    var source = "";
    if("reverse" == colum) {
        for(let i=0; i<activities.length; i++) {
            if(kind != activities[i]["kind"]){continue}
            source += "\
            <div class=\"activity-box\"><div class=\"box-main\">\
            <div class=\"contributor\"><p>"+activities[i]["date"]+" "+activities[i]["group"]+" "+activities[i]["contributor"]+"</p>\
            </div><div class=\"main\"><div class=\"record\"><li id=\"target\" class=\"title\">目標</li>\
            <div class=\"contents\"><p>"+activities[i]["target"]+"</p></div></div><div class=\"record\"><li id=\"do\" class=\"title\">できたこと</li>\
            <div class=\"contents\"><p>"+activities[i]["do"]+"</p></div></div>\
            <div class=\"record\"><li id=\"share\" class=\"title\">共有したいこと</li><div class=\"contents\"><p>"+activities[i]["share"]+"</p></div>\
            </div></div></div></div>";
        }
        e_colum_normal.setAttribute("style","");
        e_cn_p.setAttribute("style","");
        e_colum_reverse.setAttribute("style","background-color:#3d3c4c;");
        e_cr_p.setAttribute("style", "color:#eee;");
    }
    if("normal" == colum) {
        for(let i=activities.length-1; 0<=i; i--) {
            if(kind != activities[i]["kind"]){continue}
            source += "\
            <div class=\"activity-box\"><div class=\"box-main\">\
            <div class=\"contributor\"><p>"+activities[i]["date"]+" "+activities[i]["group"]+" "+activities[i]["contributor"]+"</p>\
            </div><div class=\"main\"><div class=\"record\"><li id=\"target\" class=\"title\">目標</li>\
            <div class=\"contents\"><p>"+activities[i]["target"]+"</p></div></div><div class=\"record\"><li id=\"do\" class=\"title\">できたこと</li>\
            <div class=\"contents\"><p>"+activities[i]["do"]+"</p></div></div>\
            <div class=\"record\"><li id=\"share\" class=\"title\">共有したいこと</li><div class=\"contents\"><p>"+activities[i]["share"]+"</p></div>\
            </div></div></div></div>";
        }
        e_colum_reverse.setAttribute("style","");
        e_cr_p.setAttribute("style","");
        e_colum_normal.setAttribute("style","background-color:#3d3c4c;");
        e_cn_p.setAttribute("style", "color:#eee;");
    }
    if("person" == kind) {
        e_group_kind.setAttribute("style","");
        e_gk_p.setAttribute("style","");
        e_person_kind.setAttribute("style","background-color:#3d3c4c;");
        e_pk_p.setAttribute("style", "color:#eee;");
    }
    if("group" == kind) {
        e_person_kind.setAttribute("style","");
        e_pk_p.setAttribute("style","");
        e_group_kind.setAttribute("style","background-color:#3d3c4c;");
        e_gk_p.setAttribute("style", "color:#eee;");
    }
    e_activities.innerHTML = source;
}


/* submit */
var e_date = document.getElementById("date");
var e_group = document.getElementById("group");
var e_contributor = document.getElementById("contributor");
var e_target = document.getElementById("target");
var e_do = document.getElementById("do");
var e_share = document.getElementById("share");

function submit(kind){
    var mid = ""; // user mid
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
    $.post("assets/submit.php", 
        {
            "kind": kind,
            "mid": mid,
            "date": date,
            "group": group,
            "contributor": contributor,
            "target": target_text,
            "do": do_text,
            "share": share_text
        }, 
        function(data){
            console.log("activity submit.");
            console.log(data);
    });
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}