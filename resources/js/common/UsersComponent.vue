<template>
    <!-- Slider main container -->
    <div class="swiper-container overflow-auto all_users">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div v-for="user in users" :key="user.id" class="swiper-slide">
                <user-component :userID ="user.id" />
            </div>
            <!--<div
                class="container-fluid swiper-slide p-0"
                :class="{ active: isActive }"
            >
                <div class="p-0 m-0 user_profile_image_wrap">
                    <img
                        class="user_profile_image"
                        :src="user.profile_image"
                        rel=""
                        alt=""
                    />
                </div>
                <div class="px-5 profile">
                    <div class="main_profile">
                        <div class="">
                            <div class="follow">
                                <div>
                                    <span>{{ user.screen_name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="follow">
                                <div>
                                    投稿数<span>{{ posts_count }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="follow">
                                <div>
                                    フォロー<span>{{ follow_count }}</span>
                                </div>
                            </div>
                            <div class="follower">
                                <div>
                                    フォロワー<span>{{ follower_count }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="thanks">
                                <div>
                                    THANK YOU！<span>{{ thanks_count }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="read_more">
                                <button type="submit" class="">
                                    Read More
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col sub_profile">
                        <div class="row py-3">
                            <div class="col">
                                <div class="profile_label">
                                    <label for="profile" class="mt-3" id="label"
                                        ><h1>PROFILE</h1></label
                                    >
                                </div>
                                <div>
                                    <p v-text="user.profile_text" />
                                </div>
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col">
                                <div class="skill_label">
                                    <label for="skill" class="" id="label"
                                        ><h1>SKILL</h1></label
                                    >
                                </div>
                                <div
                                    class="skills mt-3 d-flex align-items-center"
                                    v-for="progress in progresses"
                                    :key="progress.id"
                                >
                                    <span class="name">{{
                                        progress.name
                                    }}</span>
                                    <div class="percent">
                                        <div
                                            class="progress"
                                            :style="{
                                                width: progress.progress + '%'
                                            }"
                                        ></div>
                                    </div>
                                    <span class="value">{{
                                        progress.progress
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</template>

<script>
// import Swiper JS
import Swiper from "swiper/bundle";

export default {
    name: "users-component",
    data: function() {
        return {
            user: [],
            users: [],
            posts: [],
            posts_count: [],
            follow: [],
            follow_count: [],
            follower: [],
            follower_count: [],
            favo_count: [],
            comment_count: [],
            thanks_count: [],
            skills: [],
            progresses: [],
            skill_name: "",
            progress: "",
            isActive: false
        };
    },
    methods: {
        async getProfile() {
            try {
                const url = "/ajax/user";
                await axios.get(url).then(response => {
                    this.user = response.data[0];
                    this.posts = response.data[1];
                    this.posts_count = response.data[2];
                    this.follow = response.data[3];
                    this.follow_count = response.data[4];
                    this.follower = response.data[5];
                    this.follower_count = response.data[6];
                    this.thanks_count = response.data[7];
                });
            } catch (error) {
                console.log(error);
            }
        },
        async getUsers() {
            try {
                const url = "/ajax/users";
                await axios.get(url).then(response => {
                    this.users = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        getSkill() {
            const url = "/ajax/user/skill";
            axios.get(url).then(response => {
                this.progresses = response.data;
            });
        }
    },
    mounted() {
        this.getProfile();
        this.getSkill();
        this.getUsers();

        Echo.channel("post").listen("PostCreated", e => {
            this.getProfile();
        });

        Echo.channel("post").listen("PostDeleted", e => {
            this.getProfile();
        });
    },
    updated() {
        var swiper = new Swiper(".swiper-container", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true
            },
            pagination: {
                el: ".swiper-pagination"
            }
        });
    }
};
</script>
