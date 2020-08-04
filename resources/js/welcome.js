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


class MatrixAnimation {
    constructor(element, letterColor, letterSize, font, speed, fillColor) {
        this.element = element;
        this.width = element.offsetWidth;
        this.height = element.offsetHeight;
        this.letterColor = letterColor;
        this.letterSize = letterSize;
        this.font = font;
        this.speed = speed < 24 ? 24 : speed;
        this.status = true;
        this.ctx = undefined;
        this.letters = undefined;
        this.fillColor = fillColor;
    }

    drawAnimation() {

        if (this.status) {
            
            this.ctx.fillStyle = this.letterColor;
            this.ctx.font = '${this.letterSize}pt ${this.font}';
    
            this.letters.forEach((y, index) => {
                const randomSymbol = String.fromCharCode(Math.random() * 128);
                const x = index * this.letterSize;
    
                this.ctx.fillText(randomSymbol, x, y);
    
                if (y > 250 + Math.random() * 15000) this.letters[index] = 0;
                else this.letters[index] = y + this.letterSize;
            });
    
            this.ctx.fillStyle = this.fillColor;
            this.ctx.fillRect(0,0, this.width, this.height);
        }

    }

    createCanvas(element) {
        this.element.innerHTML = '';

        this.width = element ? element.offsetWidth : this.width;
        this.height = element ? element.offsetHeight : this.height;

        const canvas = document.createElement('canvas');
        canvas.setAttribute('id', 'canvas');
        canvas.setAttribute('width', this.width);
        canvas.setAttribute('height', this.height);
        canvas.style.backgroundColor='#FFFFFF';

        this.ctx = canvas.getContext('2d');

        const col = Math.floor(this.width / this.letterSize);
        this.letters = Array(col).fill(0);

        this.element.append(canvas);
    }

    init() {
        this.createCanvas();

        setInterval(() => {
            this.drawAnimation(); 
        },this.speed);
    }

    pausePlay() {
        this.status = this.status ? false : true;
    }
}
const matrix = new MatrixAnimation(document.querySelector('#matrix'),
'#fff',15,'Arial',100,'rgba(0,0,0,0.1)');
const matrix2 = new MatrixAnimation(document.querySelector('#matrix2'),
'#000',15,'Arial',100,'rgba(255,255,255,0.1)');

matrix.init();
matrix2.init();

window.addEventListener('resize', () => {
    matrix.createCanvas(document.querySelector('#matrix'));
    matrix2.createCanvas(document.querySelector('#matrix2'));
});
