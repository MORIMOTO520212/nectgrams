/* logout */
function logout(){
    document.cookie = "session=;path=/";
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}

var element_products = document.getElementById("products");

$.post("assets/products.php", {}, function(data){
    console.log(data);
});