/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/article.js ***!
  \*********************************/
Article = {
  windowLocationOrigin: null,
  initialization: function initialization() {
    Article.windowLocationOrigin = window.location.origin;
    Article.addTargetAttributeToExternalLinks();
  },
  addTargetAttributeToExternalLinks: function addTargetAttributeToExternalLinks() {
    var links = document.querySelectorAll('.article-content a');
    links.forEach(function (link, index) {
      var linkIndexOf = link.getAttribute('href').indexOf(Article.windowLocationOrigin);

      if (linkIndexOf == -1) {
        links[index].setAttribute('target', '_blank');
      }
    });
  }
};

window.onload = function () {
  Article.initialization();
};
/******/ })()
;