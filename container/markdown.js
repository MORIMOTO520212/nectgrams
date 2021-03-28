/*
    MarkDown記述システム
    create:2021.03.28
*/
const mkdn_container = {
    "br": "<br>",
    "plane": "<p>$t</p>",
    "#": "<p class='header header1'>$t</p>",
    "##": "<p class='header header2'>$t</p>",
    "###": "<p class='header header3'>$t</p>",
    "link": "<a class='link' href='$l'>$t<a>",
    "list": "<li>$t</li>",
    "bold": "<p class='bold'>$t</p>"
}
function markdown(data){
    var source = "";
    var textline = data.split("\n");
    for(let i=0; i<textline.length; i++){
        var text = textline[i];
        if(text.match(/^# /)){
            source += mkdn_container["#"].replace("$t", text.replace(/^# /,""));
            continue;
        }
        if(textline[i].match(/^## /)){
            source += mkdn_container["##"].replace("$t", text.replace(/^## /,""));
            continue;
        }
        if(textline[i].match(/^### /)){
            source += mkdn_container["###"].replace("$t", text.replace(/^### /,""));
            continue;
        }
        if(textline[i].match(/^- /)){
            source += mkdn_container["list"].replace("$t", text.replace(/^- /, ""));
            continue;
        }
        if(textline[i].match(/\[.*\]\(.*\)/)){
            let title = text.replace(/[\[\]]/g,"").replace(/\(.*\)/g, "");
            let link = text.replace(/\[.*\]/).replace(/[\(\)]/g, "");
            source += mkdn_container["link"].replace("$t", title).replace("$l", link);
            continue;
        }
        if(textline[i].match(/\*\*.*\*\*/g)){
            source += mkdn_container["bold"].replace("$t", text.replace(/\*\*/g, ""));
            continue;
        }
        if(text){
            source += mkdn_container["plane"].replace("$t", text);
            continue;
        }
        source += mkdn_container["br"];
    }
    return source;
}