/* logout */
function logout(){
    document.cookie = "session=;path=/";
    function reload(){ location.reload(); }
    setTimeout(reload, 1000);
}

var element_products = document.getElementById("products");

/* product upload */


function products_view(products){
    let source = "";
    products.forEach(product => {
        let title = product["title"];
        let message = product["message"];
        let photo = product["photo"];
        source += "<div class=\"product-box\"><div class=\"box-main\"><div class=\"image\"><img src=\""+photo+"\"></div><div class=\"text\"><p class=\"header\">"+title+"</p><p>"+message+"</p></div></div></div>";
    });
    element_products.innerHTML = source;
}
$.post("assets/products.php", {}, function(data){
    console.log("get products");
    jsonData = JSON.parse(data);
    //products_view(jsonData);
});