/*
    getPrams.js
    create: 2021.03.29
    return: {"key1", "value1", "key2", "value2"}
*/
function get_params() {
    var url = document.location.href;
    var paramlink = url.replace(/.*\?/, "");
    var paramsdb = paramlink.split("&");
    var params = [];
    for(let i=0; i<paramsdb.length; i++){
        kv = paramsdb[i].split("=");
        params[kv[0]] = kv[1];
    }
    return params;
}