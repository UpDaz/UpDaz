var observer = new IntersectionObserver(function (entries) {
    // sticky
    if (entries[0].intersectionRatio === 0) {
        document.getElementById("menu").classList.add("shadow-lg");
    } else if (entries[0].intersectionRatio === 1) {
        document.getElementById("menu").classList.remove("shadow-lg");
    }
}, { threshold: [0,1] });

observer.observe(document.querySelector("#menu-top"));
