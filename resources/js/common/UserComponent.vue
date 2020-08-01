<template>
    <div class="container-fluid swiper-slide p-0 user" :class="{ active: isActive }">
        <div class="p-0 m-0 user_profile_image_wrap">
            <img
                class="user_profile_image"
                :src="user.profile_image"
                rel=""
                alt=""
            />
            <div class="hover_effect"></div>
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
                <div class="" v-if="user.id != this.$userId">
                    <div class="">
                        <button type="submit" class="" v-if="follow_flag" @click="reFollow()">
                            フォロー解除
                        </button>
                        <button type="submit" class="" v-else @click="follow()">
                            フォロー
                        </button>
                    </div>
                </div>
                <div class="">
                    <div class="read_more">
                        <button type="submit" class="" v-if="isActive" @click="more()">
                            Hidden
                        </button>
                        <button type="submit" class="" v-else @click="more()">
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
                            <span class="name">{{ progress.name }}</span>
                            <div class="percent">
                                <div
                                    class="progress"
                                    :style="{
                                        width: progress.progress + '%'
                                    }"
                                ></div>
                            </div>
                            <span class="value">{{ progress.progress }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "user-component",
    props: {
        userID: [Number, String]
    },
    data: function() {
        return {
            user: [],
            posts_count: [],
            follow_count: [],
            follow_flag: false,
            follower_count: "",
            thanks_count: [],
            skills: [],
            progresses: [],
            skill_name: "",
            progress: "",
            isActive: false
        };
    },
    methods: {
        follow(){
            const url = "/ajax/user/follow";
            const params = {
                userID: this.userID,
            };
            axios.post(url,params).then(response => {
                this.follower_count = response.data[0];
                this.follow_flag = response.data[1];
            });
        },
        reFollow(){
            const url = "/ajax/user/follow/remove/";
            axios.delete(url + this.userID ).then(response => {
                this.follower_count = response.data[0];
                this.follow_flag = response.data[1];
            });
        },
        more(){
            if(this.isActive){
                this.isActive = false;
            }else{
                this.isActive = true;
            }
        },
        getProfile() {
            try {
                const url = "/ajax/user/";
                axios.get(url+this.userID).then(response => {
                    this.user = response.data[0];
                    this.posts_count = response.data[1];
                    this.follow_count = response.data[2];
                    this.follow_flag = response.data[3];
                    this.follower_count = response.data[4];
                    this.thanks_count = response.data[5];
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
        //this.getSkill();

    }
};
</script>
