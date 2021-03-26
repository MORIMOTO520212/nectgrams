/* logout */
function logout(){
    document.cookie = "session=;path=/";
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}

function sort_database(jsonData) { /* yyyy/mm/dd sort */
    var sort_db = [];
    var _jsonData = [];

    // sort data
    for(let i=0; i<jsonData.length; i++){
        let sp_date = jsonData[i]["date"].split("/");
        sort_db.push(sp_date[0]*12*30 + sp_date[1]*30 + sp_date[2]); // day count
    }
    sort_db.sort();
    while(sort_db.length){
        for(let i=0; i<jsonData.length; i++){
            let sp_date = jsonData[i]["date"].split("/");
            let day_count = sp_date[0]*12*30 + sp_date[1]*30 + sp_date[2];
            if(day_count == sort_db[0]){
                _jsonData.push(jsonData[i]);
                sort_db.shift();
            }
        }
    }
    return _jsonData;
}

/* activities viewer , viewer controller */
var activities = [];
function getData_activities(jsonData) {
    activities = sort_database(jsonData);
}
$.post("../getData.php", {"dataType": "activity"}, function(getData){
    var jsonData = JSON.parse(getData);
    getData_activities(jsonData);
    if(session){
        activities_view("person", "normal"); // initial
    }else{
        activities_view("group", "normal"); // initial
        document.getElementById("pk_a").setAttribute("onclick", "alert('個人記録はサークルメンバーのみ閲覧することが可能です。');return false;");
    }
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
    if(session){
        source += '\
        <div class="activity-box"><div class="box-main"><div class="contributor inp">\
        <input id="date" type="date" value="2021-03-16"><input id="group" type="text" placeholder="所属班"><input id="contributor" type="text" placeholder="入力者">\
        <div class="create-btn"><a href="javascript:submit();">投稿</a></div></div><div class="main">\
        <div class="record"><li class="title">目標</li><div class="contents"><textarea id="target" placeholder="今回の活動目標を記入してください。"></textarea>\
        </div></div><div class="record"><li class="title">できたこと</li><div class="contents"><textarea id="do" placeholder="活動した内容について記入してください。"></textarea>\
        </div></div><div class="record"><li class="title">共有したいこと</li><div class="contents">\
        <textarea id="share" placeholder="全体や班の内で共有したいことや疑問点があればそれについて記入してください。"></textarea></div></div></div></div></div>';
    }
    if("reverse" == colum){
        for(let i=0; i<activities.length; i++){
            if(kind != activities[i]["kind"]){continue}
            source += '\
            <div class="activity-box"><div class="box-main">\
            <div class="contributor"><p>'+activities[i]["date"]+' '+activities[i]["group"]+' '+activities[i]["contributor"]+'</p>\
            </div><div class="main"><div class="record"><li id="target" class="title">目標</li>\
            <div class="contents"><p>'+activities[i]["target"]+'</p></div></div><div class="record"><li id="do" class="title">できたこと</li>\
            <div class="contents"><p>'+activities[i]["do"]+'</p></div></div>\
            <div class="record"><li id="share" class="title">共有したいこと</li><div class="contents"><p>'+activities[i]["share"]+'</p></div>\
            </div></div></div></div>';
        }
        e_colum_normal.setAttribute("style","");
        e_cn_p.setAttribute("style","");
        e_colum_reverse.setAttribute("style","background-color:#3d3c4c;");
        e_cr_p.setAttribute("style", "color:#eee;");
    }
    if("normal" == colum){
        for(let i=activities.length-1; 0<=i; i--){
            if(kind != activities[i]["kind"]){continue}
            source += '\
            <div class="activity-box"><div class="box-main">\
            <div class="contributor"><p>'+activities[i]["date"]+' '+activities[i]["group"]+' '+activities[i]["contributor"]+'</p>\
            </div><div class="main"><div class="record"><li id="target" class="title">目標</li>\
            <div class="contents"><p>'+activities[i]["target"]+'</p></div></div><div class="record"><li id="do" class="title">できたこと</li>\
            <div class="contents"><p>'+activities[i]["do"]+'</p></div></div>\
            <div class="record"><li id="share" class="title">共有したいこと</li><div class="contents"><p>'+activities[i]["share"]+'</p></div>\
            </div></div></div></div>';
        }
        e_colum_reverse.setAttribute("style","");
        e_cr_p.setAttribute("style","");
        e_colum_normal.setAttribute("style","background-color:#3d3c4c;");
        e_cn_p.setAttribute("style", "color:#eee;");
    }
    if("person" == kind){
        e_group_kind.setAttribute("style","");
        e_gk_p.setAttribute("style","");
        e_person_kind.setAttribute("style","background-color:#3d3c4c;");
        e_pk_p.setAttribute("style", "color:#eee;");
    }
    if("group" == kind){
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

function submit(kind) {
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
        function(data) {
            console.log("activity submit.");
            console.log(data);
    });
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}