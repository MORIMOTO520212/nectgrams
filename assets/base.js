var e_scroll_img_1 = document.getElementById("scroll_img_1");
var e_scroll_img_2 = document.getElementById("scroll_img_2");
var e_sb_btn_s = document.getElementById("sb_btn_s");
var si = 0;
var si_p = [];

var source = "";
for(var i=0; i<topics.length-1; i++){
    si_p.push([i,i+1]);
    source += "<div id=\"btn_"+i+"\" style><a href=\"javascript:scroll_view("+i+");\"></a></div>";
}
si_p.push([topics.length-1,0]);
source += "<div id=\"btn_"+i+"\" style><a href=\"javascript:scroll_view("+i+");\"></a></div>";
e_sb_btn_s.innerHTML = source; // scroll view btn

function scroll_view(direction, arrowDetect){
    if(arrowDetect){
        clearInterval(auto_scroll);
        console.log("stop auto scroll.");
    }
    if("next" == direction){
        if(si != si_p.length-1){
            si++;
        }else{
            si = 0;
        }
    }else if("back" == direction){
        if(si != 0){
            si--;
        }else{
            si = si_p.length-1;
        }
    }else{
        si = direction;
    }
    e_scroll_img_1.setAttribute("src", "database/"+topics[si_p[si][0]]["photo"]);
    e_scroll_img_2.setAttribute("src", "database/"+topics[si_p[si][1]]["photo"]);
    for(var i=0; i<topics.length; i++){
        document.getElementById("btn_"+i).setAttribute("style", "");
    }
    document.getElementById("btn_"+si).setAttribute("style", "background-color:#bebebe;");
}
scroll_view("next", false); // initial view.
var auto_scroll = setInterval(function(){ // auto scroll view.
    scroll_view("next", false);
}, 5000);

/* logout */
function logout(){
    document.cookie = "session=;path=/";
    setTimeout(function(){location.reload()}, 1000);
}