require("../bootstrap");

window.Vue = require("vue");

//Vue.use(VueRouter);
Vue.prototype.$userId = document
    .querySelector("meta[name='user-id']")
    .getAttribute("content");
Vue.prototype.$userEmail = document
    .querySelector("meta[name='user-email']")
    .getAttribute("content");

Vue.component(
    "company-profile-component",
    require("./components/CompanyProfileComponent.vue").default
);
Vue.component(
    "company-form-component",
    require("./components/CompanyFormComponent.vue").default
);
Vue.component(
    "infos-component",
    require("../common/InfosComponent.vue").default
);
Vue.component("info-component", require("../common/InfoComponent.vue").default);
Vue.component("chat-component", require("../common/ChatComponent.vue").default);
Vue.component(
    "posts-component",
    require("../common/PostsComponent.vue").default
);
Vue.component("post-component", require("../common/PostComponent.vue").default);

Vue.component(
    "comments-component",
    require("../common/CommentsComponent.vue").default
);
Vue.component(
    "thanks-component",
    require("../common/ThanksComponent.vue").default
);
Vue.component("post-tab-component", require("../common/PostTabComponent.vue").default);
Vue.component(
    "users-component",
    require("../common/UsersComponent.vue").default
);
Vue.component("user-component", require("../common/UserComponent.vue").default);
Vue.component(
    "google-form-component",
    require("../common/GoogleFormComponent.vue").default
);
Vue.component(
    "posts-count-component",
    require("../common/PostsCountComponent.vue").default
);
Vue.component(
    "follow-count-component",
    require("../common/FollowCountComponent.vue").default
);
Vue.component(
    "follower-count-component",
    require("../common/FollowerCountComponent.vue").default
);
Vue.component('thanks-count-component', require('../common/thanksCountComponent.vue').default);
Vue.component(
    "infos-count-component",
    require("../common/InfosCountComponent.vue").default
);
Vue.component(
    "delete-post-component",
    require("../common/DeletePostComponent.vue").default
);
Vue.component(
    "delete-info-component",
    require("../common/DeleteInfoComponent.vue").default
);
/*
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home',
            component: HomeComponent,
        },
    ]
});
*/
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
/*
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

*/
const app = new Vue({
    el: "#app"
    //router
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$(function() {
    console.log("読込みました");
});

$(function() {
    var nav = ["#r_nav", "#o_nav", "#b_nav", "#p_nav", "#g_nav"];
    var nav_flag = false;

    $("#r_nav").on("click", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $("#r_nav_2").removeClass("active");
            $("#r_icon_wrap").removeClass("active");

            $.each(nav, function(index, value) {
                if ($(value).hasClass("active")) {
                    console.log(value);
                    nav_flag = false;
                    return false;
                } else {
                    nav_flag = true;
                }
            });
            if (nav_flag == true) {
                $("#said_nav").css({
                    width: "80px",
                    transition: "1s"
                });
            } else {
                $("#said_nav").css({
                    transition: "1s"
                });
            }

            console.log("close");
        } else {
            $("#said_nav").css("width", "100%");
            $(this).addClass("active");
            $("#r_nav_2").addClass("active");
            $("#r_icon_wrap").addClass("active");
            console.log("open");
        }
    });

    $("#o_nav").on("click", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $("#o_nav_2").removeClass("active");
            $("#o_icon_wrap").removeClass("active");
            $.each(nav, function(index, value) {
                if ($(value).hasClass("active")) {
                    console.log(value);
                    nav_flag = false;
                    return false;
                } else {
                    nav_flag = true;
                }
            });
            if (nav_flag == true) {
                $("#said_nav").css({
                    width: "80px",
                    transition: "1s"
                });
            } else {
                $("#said_nav").css({
                    transition: "1s"
                });
            }

            console.log("close");
        } else {
            $("#said_nav").css("width", "100%");
            $(this).addClass("active");
            $("#o_nav_2").addClass("active");
            $("#o_icon_wrap").addClass("active");
            console.log("open");
        }
    });

    $("#b_nav").on("click", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $("#b_nav_2").removeClass("active");
            $("#b_icon_wrap").removeClass("active");
            $.each(nav, function(index, value) {
                if ($(value).hasClass("active")) {
                    console.log(value);
                    nav_flag = false;
                    return false;
                } else {
                    nav_flag = true;
                }
            });
            if (nav_flag == true) {
                $("#said_nav").css({
                    width: "80px",
                    transition: "1s"
                });
            } else {
                $("#said_nav").css({
                    transition: "1s"
                });
            }
            console.log("close");
        } else {
            $("#said_nav").css("width", "100%");
            $(this).addClass("active");
            $("#b_nav_2").addClass("active");
            $("#b_icon_wrap").addClass("active");
            console.log("open");
        }
    });

    $("#p_nav").on("click", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $("#p_nav_2").removeClass("active");
            $("#p_icon_wrap").removeClass("active");
            $.each(nav, function(index, value) {
                if ($(value).hasClass("active")) {
                    console.log(value);
                    nav_flag = false;
                    return false;
                } else {
                    nav_flag = true;
                }
            });
            if (nav_flag == true) {
                $("#said_nav").css({
                    width: "80px",
                    transition: "1s"
                });
            } else {
                $("#said_nav").css({
                    transition: "1s"
                });
            }
            console.log("close");
        } else {
            $("#said_nav").css("width", "100%");
            $(this).addClass("active");
            $("#p_nav_2").addClass("active");
            $("#p_icon_wrap").addClass("active");
            console.log("open");
        }
    });

    $("#g_nav").on("click", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $("#g_nav_2").removeClass("active");
            $("#g_icon_wrap").removeClass("active");
            $.each(nav, function(index, value) {
                if ($(value).hasClass("active")) {
                    console.log(value);
                    nav_flag = false;
                    return false;
                } else {
                    nav_flag = true;
                }
            });
            if (nav_flag == true) {
                $("#said_nav").css({
                    width: "80px",
                    transition: "1s"
                });
            } else {
                $("#said_nav").css({
                    transition: "1s"
                });
            }
            console.log("close");
        } else {
            $("#said_nav").css("width", "100%");
            $(this).addClass("active");
            $("#g_nav_2").addClass("active");
            $("#g_icon_wrap").addClass("active");
            console.log("open");
        }
    });
});

window.onload = function() {
    const spinner = document.getElementById("loading");
    spinner.classList.add("loaded");
};
