/* login session check. */
function getCookie(key){
    var cookies = document.cookie.split(/; /);
    for(let i=0; i<cookies.length; i++){
        cookie = cookies[i].split("="); // key-cookie[0], value-cookie[1]
        if(key==cookie[0]){
            return cookie[1]; // return value.
        }
    }
    return false;
}