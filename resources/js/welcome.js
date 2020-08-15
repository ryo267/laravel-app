require("./bootstrap");

window.Vue = require('vue')
Vue.component("welcome-component", require("./common/WelcomComponent.vue").default);

const app = new Vue({
    el: '#app',
});

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



const r_btn = document.getElementById('register_btn');
const l_btn = document.getElementById('login_btn');

r_btn.addEventListener('click', () => {
    var login = document.getElementById('login');
    var register = document.getElementById('register');
    if( login.classList.contains('active') == true ){
        register.classList.add('active');
        login.classList.remove('active');
    } 
});
l_btn.addEventListener('click', () => {
    var login = document.getElementById('login');
    var register = document.getElementById('register');
    if( register.classList.contains('active') == true ){
        register.classList.remove('active');
        login.classList.add('active');
    }
});

const companies = document.getElementById('companies');
const users = document.getElementById('users');
companies.addEventListener('click', () => {
    console.log('click');
    var cover = document.getElementById('cover');
    var cover2 = document.getElementById('cover2');
    var user_contents_wrap = document.getElementById('user_contents_wrap');
    var company_contents_wrap = document.getElementById('company_contents_wrap');
    var user_container_wrap = document.getElementById('user_container_wrap');
    var compnay_container_wrap = document.getElementById('compnay_container_wrap');
    if( cover.classList.contains('active') == true ){
        cover.classList.remove('active');
        user_contents_wrap.classList.remove('active');
        company_contents_wrap.classList.add('active');
        cover2.classList.add('active');
        user_container_wrap.classList.remove('active');
        compnay_container_wrap.classList.add('active');
    } 
});
users.addEventListener('click', () => {
    console.log('click');
    var cover = document.getElementById('cover');
    var cover2 = document.getElementById('cover2');
    var user_contents_wrap = document.getElementById('user_contents_wrap');
    var company_contents_wrap = document.getElementById('company_contents_wrap');
    var user_container_wrap = document.getElementById('user_container_wrap');
    var compnay_container_wrap = document.getElementById('compnay_container_wrap');
    if( cover2.classList.contains('active') == true ){
        cover2.classList.remove('active');
        user_contents_wrap.classList.add('active');
        company_contents_wrap.classList.remove('active');
        cover.classList.add('active');
        user_container_wrap.classList.add('active');
        compnay_container_wrap.classList.remove('active');
    } 
});