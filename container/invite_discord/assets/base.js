var params = get_params();
var name = params["name"];
var user = params["user"];

var e_name = document.getElementById("name");
var e_user = document.getElementById("user");
var e_copy = document.getElementById("copy");

// write.
e_name.innerText = decodeURI(name);
e_user.value = decodeURI(user);
e_user.setAttribute("style", "width:"+decodeURI(user).length*12+"px;");

function copy(){
    e_copy.innerText = "完了";
    e_user.select();
    document.execCommand("copy");
}