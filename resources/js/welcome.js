require("./bootstrap");
//require('../../node_modules/easy-pie-chart/dist/jquery.easypiechart');
//require('../../node_modules/jquery.diamonds.js/src/jquery.diamonds');

window.Vue = require('vue')
Vue.component("welcome-component", require("./common/WelcomComponent.vue").default);

const app = new Vue({
    el: '#app',
});

$(function() {
    console.log("読込みました");
});
/*
$(function() {
    $(".chart").easyPieChart({
        size: 180,
        barColor: "#00ff43",
        trackColor: "false",
        scaleColor: "rgba(0,0,0,0)",
        lineWidth: 15,
        ainimate: 2000
    });
});

$("#diamond-grid").diamonds({
    size: 200, // Size of diamonds in pixels. Both width and height.
    gap: 5, // Pixels between each square.
    hideIncompleteRow: false, // Hide last row if there are not enough items to fill it completely.
    autoRedraw: true, // Auto redraw diamonds when it detects resizing.
    itemSelector: ".item" // the css selector to use to select diamonds-items.
});
*/

window.onload = function() {
    const spinner = document.getElementById("loading");
    spinner.classList.add("loaded");
};