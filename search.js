document.querySelector(".search form").addEventListener("submit", function (event) {
        event.preventDefault();
        document.getElementById("searchitem").style.display = "block";
    });