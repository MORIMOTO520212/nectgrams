/* logout */
function logout(){
    document.cookie = "session=;path=/";
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}

var activities = [];
function getData_activities(jsonData){
    activities = jsonData;
}
$.post("../getData.php", {"dataType": "activity"}, function(getData){
    var jsonData = JSON.parse(getData);
    getData_activities(jsonData);
});

var e_activities = document.getElementById("activities");
function activities_view(kind, colum){
    var source = "";
    for(let i=0; i<activities.length; i++){
        if(kind != activities[i]["kind"]){ continue; }
        source += "<div class=\"activity-box\"><div class=\"box-main\">\
                <div class=\"contributor\"><p>"+activities[i]["date"]+" "+activities[i]["group"]+" "+activities[i]["contributor"]+"</p>\
                </div><div class=\"main\"><div class=\"record\"><li id=\"target\" class=\"title\">目標</li>\
                <div class=\"contents\"><p>"+activities[i]["target"]+"</p></div></div><div class=\"record\"><li id=\"do\" class=\"title\">できたこと</li>\
                <div class=\"contents\"><p>"+activities[i]["do"]+"</p></div></div>\
                <div class=\"record\"><li id=\"share\" class=\"title\">共有したいこと</li><div class=\"contents\"><p>"+activities[i]["share"]+"</p></div>\
                </div></div></div></div>";
    }
    e_activities.innerHTML = source;
}

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