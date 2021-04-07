/*
    logout.js
    create: 2021.03.30
*/
function logout() {
    document.cookie = "session=false;path=/";
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function(){console.log('User signed out.');});
    setTimeout(function(){location.reload()}, 1000);
}