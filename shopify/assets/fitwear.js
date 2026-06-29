document.addEventListener("DOMContentLoaded",function(){
    document.querySelectorAll(".fitwear-cartbtn").forEach(function(button){
        button.addEventListener("click",function(){
            alert("Add to Cart button clicked");
        });
    });
});