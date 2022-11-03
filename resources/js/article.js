Article = {
    windowLocationOrigin : null,
    initialization : function () {
        Article.windowLocationOrigin = window.location.origin;
        Article.addTargetAttributeToExternalLinks();
    },
    addTargetAttributeToExternalLinks: function () {
        var links = document.querySelectorAll('.article-content a');
        links.forEach((link, index) => {
            var linkIndexOf = link.getAttribute('href').indexOf(Article.windowLocationOrigin);
            if (linkIndexOf == -1) {
                links[index].setAttribute('target', '_blank');
            }
        })
    }
}

window.onload = function () {
    Article.initialization();
}
