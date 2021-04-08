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
        document.getElementById("pk_a").setAttribute("onclick", "alert('個人記録はサークル内のみ閲覧することが可能です。');return false;");
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
        if("person" == kind){
            source += '\
            <div class="activity-box">\
                <div class="box-main">\
                    <div class="contributor inp">\
                        <input id="date" type="date" value="2021-03-16">\
                        <input id="group" type="text" placeholder="所属班" value="'+userName+'">\
                        <input id="contributor" type="text" placeholder="入力者" value="'+userGroup+'">\
                        <div class="create-btn"><a href="javascript:submit(\''+kind+'\');">投稿</a></div>\
                    </div>\
                    <div class="main">\
                        <div class="record">\
                            <li class="title">目標</li>\
                            <div class="contents">\
                                <textarea id="target" placeholder="今回の活動目標を記入してください。"></textarea>\
                            </div>\
                        </div>\
                        <div class="record">\
                            <li class="title">できたこと　　達成度：<input id="complete" type="text" placeholder="50"> %</li>\
                            <div class="contents">\
                                <textarea id="do" placeholder="活動した内容について記入してください。"></textarea>\
                            </div>\
                        </div>\
                        <div class="record">\
                            <li class="title">共有したいこと</li>\
                            <div class="contents">\
                                <textarea id="share" placeholder="全体や班の内で共有したいことや疑問点があればそれについて記入してください。"></textarea>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>';
        }
        if("group" == kind){
            source += '\
            <div class="activity-box">\
                <div class="box-main">\
                    <div class="contributor inp">\
                        <input id="date" type="date" value="2021-03-16">\
                        <input id="group" type="text" placeholder="所属班" value="">\
                        <input id="contributor" type="text" placeholder="入力者" value="">\
                        <div class="create-btn"><a id="submit" href>投稿</a></div>\
                    </div>\
                    <div class="main">\
                        <div class="control control-kind">\
                            <div class="kc">\
                                <div id="ak_new" class="pgc-btn left-btn" style><a id="ak_new_a" href="#" onclick="activity_control(\'new\');return false;"></a><p id="ak_new_p" style>新規</p></div>\
                                <div id="ak_group" class="pgc-btn right-btn" style><a id="ak_group_a" href="#" onclick="activity_control(\'group\');return false;"></a><p id="ak_group_p" style>活動</p></div>\
                            </div>\
                        </div>\
                        <div id="ak_contents"></div>\
                    </div>\
                </div>\
            </div>\
            ';
        }
    }

    if("reverse" == colum){
        for(let i=0; i<activities.length; i++){
            if("person" == kind && "person" == activities[i]["kind"]){
                source += '\
                <div class="activity-box">\
                    <div class="box-main">\
                        <div class="contributor">\
                            <p>'+activities[i]["date"]+' '+activities[i]["group"]+' '+activities[i]["contributor"]+'</p>\
                        </div>\
                        <div class="main">\
                            <div class="record">\
                                <li id="target" class="title">目標</li>\
                                <div class="contents"><p>'+activities[i]["target"]+'</p></div>\
                            </div>\
                            <div class="record">\
                                <li id="do" class="title">できたこと　達成度：'+activities[i]["complete"]+' %</li>\
                                <div class="contents"><p>'+activities[i]["do"]+'</p></div>\
                            </div>\
                            <div class="record">\
                                <li id="share" class="title">共有したいこと</li>\
                                <div class="contents"><p>'+activities[i]["share"]+'</p></div>\
                            </div>\
                        </div>\
                    </div>\
                </div>';
            }
            if("group" == kind){
                if("group" == activities[i]["kind"]){
                    source += '\
                    <div class="activity-box">\
                        <div class="box-main">\
                            <div class="contributor">\
                                <p>'+activities[i]["date"]+' '+activities[i]["group"]+' '+activities[i]["contributor"]+'</p>\
                            </div>\
                            <div class="main">\
                                <div class="record">\
                                    <li id="do" class="title">活動状況　完成度：'+activities[i]["complete"]+'</li>\
                                    <div class="contents"><p>'+activities[i]["do"]+'</p></div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                    ';
                }
                if("new" == activities[i]["kind"]){
                    source += '\
                    <div class="activity-box">\
                        <div class="box-main">\
                            <div class="contributor">\
                                <p>'+activities[i]["date"]+' '+activities[i]["group"]+' '+activities[i]["contributor"]+'</p>\
                            </div>\
                            <div class="main">\
                                <div class="record">\
                                    <li class="title">班員</li>\
                                    <div class="contents"><p>'+activities[i]["member"]+'</p></div>\
                                </div>\
                                <div class="record">\
                                    <li class="title">製作物</li>\
                                    <div class="contents"><p>'+activities[i]["product"]+'</p></div>\
                                    </div>\
                                <div class="record">\
                                    <li class="title">活動内容</li>\
                                    <div class="contents"><p>'+activities[i]["activity"]+'</p></div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                    ';
                }
            }
        }
        e_colum_normal.setAttribute("style","");
        e_cn_p.setAttribute("style","");
        e_colum_reverse.setAttribute("style","background-color:#3d3c4c;");
        e_cr_p.setAttribute("style", "color:#eee;");
    }

    if("normal" == colum){
        for(let i=activities.length-1; 0<=i; i--){
            if("person" == kind && "person" == activities[i]["kind"]){
                source += '\
                <div class="activity-box">\
                    <div class="box-main">\
                        <div class="contributor">\
                            <p>'+activities[i]["date"]+' '+activities[i]["group"]+' '+activities[i]["contributor"]+'</p>\
                        </div>\
                        <div class="main">\
                            <div class="record">\
                                <li id="target" class="title">目標</li>\
                                <div class="contents"><p>'+activities[i]["target"]+'</p></div>\
                            </div>\
                            <div class="record">\
                                <li id="do" class="title">できたこと　達成度：'+activities[i]["complete"]+' %</li>\
                                <div class="contents"><p>'+activities[i]["do"]+'</p></div>\
                            </div>\
                            <div class="record">\
                                <li id="share" class="title">共有したいこと</li>\
                                <div class="contents"><p>'+activities[i]["share"]+'</p></div>\
                            </div>\
                        </div>\
                    </div>\
                </div>';
            }
            if("group" == kind){
                if("group" == activities[i]["kind"]){
                    source += '\
                    <div class="activity-box">\
                        <div class="box-main">\
                            <div class="contributor">\
                                <p>'+activities[i]["date"]+' '+activities[i]["group"]+' '+activities[i]["contributor"]+'</p>\
                            </div>\
                            <div class="main">\
                                <div class="record">\
                                    <li id="do" class="title">活動状況　完成度：'+activities[i]["complete"]+'</li>\
                                    <div class="contents"><p>'+activities[i]["do"]+'</p></div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                    ';
                }
                if("new" == activities[i]["kind"]){
                    source += '\
                    <div class="activity-box">\
                        <div class="box-main">\
                            <div class="contributor">\
                                <p>'+activities[i]["date"]+' '+activities[i]["group"]+' '+activities[i]["contributor"]+'</p>\
                            </div>\
                            <div class="main">\
                                <div class="record">\
                                    <li class="title">班員</li>\
                                    <div class="contents"><p>'+activities[i]["member"]+'</p></div>\
                                </div>\
                                <div class="record">\
                                    <li class="title">製作物</li>\
                                    <div class="contents"><p>'+activities[i]["product"]+'</p></div>\
                                    </div>\
                                <div class="record">\
                                    <li class="title">活動内容</li>\
                                    <div class="contents"><p>'+activities[i]["activity"]+'</p></div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                    ';
                }
            }
        }
        e_colum_reverse.setAttribute("style","");
        e_cr_p.setAttribute("style","");
        e_colum_normal.setAttribute("style","background-color:#3d3c4c;");
        e_cn_p.setAttribute("style", "color:#eee;");
    }
    e_activities.innerHTML = source;

    /* activity control style */
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
        if(session) activity_control("group"); // init
    }
    
}


function activity_control(control) {
    var e_ak_new = document.getElementById("ak_new");
    var e_ak_group = document.getElementById("ak_group");
    var e_ak_new_p = document.getElementById("ak_new_p");
    var e_ak_group_p = document.getElementById("ak_group_p");
    var e_ak_contents = document.getElementById("ak_contents");
    var e_submit = document.getElementById("submit");

    console.log("activity control",control);
    if("new" == control){
        e_ak_group.setAttribute("style","");
        e_ak_group_p.setAttribute("style","");
        e_ak_new.setAttribute("style","background-color:#3d3c4c;");
        e_ak_new_p.setAttribute("style", "color:#eee;");
        e_submit.setAttribute("href", "javascript:submit('new')");
        e_ak_contents.innerHTML = '\
        <div class="record">\
            <li class="title">班員</li>\
            <div class="contents">\
                <textarea id="member" placeholder="班長,班員1,班員2, ..."></textarea>\
            </div>\
        </div>\
        <div class="record">\
            <li class="title">製作物</li>\
            <div class="contents">\
                <textarea id="product" placeholder="製作物を記入してください。"></textarea>\
            </div>\
            </div>\
        <div class="record">\
            <li class="title">活動内容</li>\
            <div class="contents">\
                <textarea id="activity" placeholder="活動内容を記入してください。"></textarea>\
            </div>\
        </div>\
        ';
    }
    if("group" == control){
        e_ak_new.setAttribute("style","");
        e_ak_new_p.setAttribute("style","");
        e_ak_group.setAttribute("style","background-color:#3d3c4c;");
        e_ak_group_p.setAttribute("style","color:#eee;");
        e_submit.setAttribute("href", "javascript:submit('group')");
        e_ak_contents.innerHTML = '\
        <div class="record">\
            <li class="title">できたこと　　達成度：<input id="complete" type="text" placeholder="1~10"></li>\
            <div class="contents">\
                <textarea id="do" placeholder="活動状況を記入してください。"></textarea>\
            </div>\
        </div>\
        ';
    }
}

/* submit */
function submit(kind) {
    var mid = getCookie("session"); // user mid
    var e_date = document.getElementById("date");
    var e_group = document.getElementById("group");
    var e_contributor = document.getElementById("contributor");
    var date = e_date.value.replace(/-/g, "/");
    var group = e_group.value;
    var contributor = e_contributor.value;

    if("person" == kind){
        var contents = {};
        let e_target = document.getElementById("target");
        let e_do = document.getElementById("do");
        let e_complete = document.getElementById("complete");
        let e_share = document.getElementById("share");
        let target_text = e_target.value;
        let do_text = e_do.value;
        let complete = e_complete.value;
        let share_text = e_share.value;
        if(!group){
            alert("”所属班”が記入されていません。");
            return 0;
        }
        if(!contributor){
            alert("”入力者”が記入されていません。");
            return 0;
        }
        if(!target_text){
            alert("”目標”が記入されていません。");
            return 0;
        }
        if(!complete){
            alert("”達成度”が記入されていません。");
        }
        if(!do_text){
            alert("”できたこと”が記入されていません。");
            return 0;
        }
        contents = {
            "kind": "person",
            "mid": mid,
            "date": date,
            "group": group,
            "contributor": contributor,
            "target": target_text,
            "do": do_text,
            "complete": complete,
            "share": share_text
        }
    }
    if("group" == kind){
        let e_do = document.getElementById("do");
        let e_complete = document.getElementById("complete");
        let do_text = e_do.value;
        let complete = e_complete.value;
        contents = {
            "kind": "group",
            "mid": mid,
            "date": date,
            "group": group,
            "contributor": contributor,
            "do": do_text,
            "complete": complete
        }
    }
    if("new" == kind){
        let e_member = document.getElementById("member");
        let e_product = document.getElementById("product");
        let e_activity = document.getElementById("activity");
        let member = e_member.value;
        let product = e_product.value;
        let activity = e_activity.value;
        contents = {
            "kind": "new",
            "mid": mid,
            "date": date,
            "group": group,
            "contributor": contributor,
            "member": member,
            "product": product,
            "activity": activity
        }
    }

    $.post("assets/submit.php", contents, 
        function(data) {
            console.log("activity submit.");
            console.log(data);
    });
    setTimeout(function(){location.reload()}, 1000);
}