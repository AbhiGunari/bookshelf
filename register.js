document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const success=document.getElementById("success");
    form.addEventListener("submit", function () { 
        success.innerhtml="Registration suucesull";
    });
});

