let arrow = document.getElementById('arrow');
let cont = document.getElementById('leftsent2');
cont.addEventListener('mouseover', function () {
    arrow.style.visibility = 'visible';
})
cont.addEventListener('mouseout', function () {
    arrow.style.visibility = 'hidden';
});


let targetnum = 400;
let targetnum2 = 1000;
let targetnum3 = 500;
let countElement = document.getElementById('top1num');
let countElement2 = document.getElementById('top2num');
let countElement3 = document.getElementById('top3num');
let currentNumber = 0;

function updateCount() {
    if (currentNumber < targetnum) {
        currentNumber++;
        countElement.textContent = currentNumber;
        setTimeout(updateCount, 5);
    }
}
function updateCount2() {
    if (currentNumber < targetnum2) {
        currentNumber++;
        countElement2.textContent = currentNumber;
        setTimeout(updateCount2, 5);
    }
}

function updateCount3() {
    if (currentNumber < targetnum3) {
        currentNumber++;
        countElement3.textContent = currentNumber;
        setTimeout(updateCount3, 5);
    }
}


window.onload = function () {
    updateCount();
    updateCount2();
    updateCount3();
};

window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".Navbar");
    if (window.scrollY > 100) {
        navbar.classList.add("scroll");
    } 
    else {
        navbar.classList.remove("scroll");
    }
});

// function myFunction() {
//     var x = document.getElementById("myNavbar");
//     if (x.className === "navbar") {
//         x.className += " responsive";
//     } else {
//         x.className = "navbar";
//     }
// }



// document.addEventListener("DOMContentLoaded", function () {
//     const mobileMenuButton = document.getElementById("navbutton");
//     const navbar = document.getElementsById("navbar");

//     mobileMenuButton.addEventListener("click", function () {
//         navbar.classList.toggle("active");
//         mobileMenuButton.classList.toggle("active");
//     });         
// });


        // Check if a message is set in the query parameters
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');

        // Display an alert if a message is available
        if (message) {
            window.alert(message);
        }