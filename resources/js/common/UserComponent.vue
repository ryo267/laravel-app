<template>
    <div class="container-fluid user my-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div v-if="this.$userRole == 'company'">
                        <scout-component
                            :userID="user.id"
                            :userNAME="user.screen_name"
                        />
                    </div>
                    <!--
                    <div class="loading_2" :id="'loading_' + user.id ">
                        <i class="fas fa-spinner fa-5x"></i>
                    </div>
                    -->
                    <div class="card-body p-0">
                        <div class="col">
                            <div
                                class="row post-row"
                                :class="{ active: isActive }"
                            >
                                <div
                                    class="text-center image-data"
                                    :class="{ active: isActive }"
                                >
                                    <div
                                        v-if="
                                            user.back_image != null ||
                                                user.back_image != undefined
                                        "
                                        class="background-image"
                                        :style="{
                                            background:
                                                'url(' +
                                                user.back_image +
                                                ') center/cover no-repeat'
                                        }"
                                    ></div>
                                    <div
                                        v-else
                                        class="background-image"
                                        :style="{
                                            background:
                                                'url(' +
                                                '/sample/noimage.jpg' +
                                                ') center/cover no-repeat'
                                        }"
                                    ></div>
                                    <div class="publication-details">
                                        <div>
                                            <img
                                                v-if="
                                                    user.profile_image !=
                                                        null ||
                                                        user.profile_image !=
                                                            undefined
                                                "
                                                class="profile_image img-thumbnail rounded-circle"
                                                :src="user.profile_image"
                                            />
                                            <img v-else class="profile_image
                                            img-thumbnail rounded-circle"
                                            src=/sample/user.png />
                                            <p></p>
                                            <p class="author">
                                                {{ user.screen_name }}
                                            </p>
                                            <div class="row">
                                                <div class="col posts_count">
                                                    <posts-count-component
                                                        :userID="user.id"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col follower">
                                                    <follower-count-component
                                                        :userID="user.id"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col thanks">
                                                    <thanks-count-component
                                                        :userID="user.id"
                                                    />
                                                </div>
                                            </div>
                                            <div
                                                v-if="
                                                    this.$userRole != 'company'
                                                "
                                            >
                                                <div
                                                    class="follow_submit_1 p-3"
                                                    v-if="
                                                        user.id != this.$userId
                                                    "
                                                >
                                                    <follow-component
                                                        :userID="user.id"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cta">
                                            <button
                                                v-if="show"
                                                class="hidden_post"
                                                type="button"
                                                @click="hiddenPost()"
                                            >
                                                <p>Hidden</p>
                                            </button>
                                            <button
                                                v-else
                                                class="show_post"
                                                type="button"
                                                @click="showPost()"
                                            >
                                                <p style="color:white">
                                                    Read More
                                                </p>
                                            </button>
                                        </div>
                                        <div
                                            class="follow_submit_2"
                                            v-if="user.id != this.$userId"
                                        >
                                            <follow-component
                                                :userID="user.id"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col post-data"
                                    :class="{ active: isActive }"
                                >
                                    <div
                                        class="overview"
                                        :class="{ active: isActive }"
                                    >
                                        <h5 class="title">
                                            {{ user.screen_name }}
                                        </h5>
                                        <h3 id="label">PROFILE</h3>
                                        <p
                                            class="description"
                                            v-html="user.profile_text"
                                        ></p>
                                        <h3 id="label">SKILL</h3>
                                        <div
                                            class="skills mt-3"
                                            v-for="progress in progresses"
                                            :key="progress.id"
                                        >
                                            <div class="name pr-3">
                                                {{ progress.name }}
                                            </div>
                                            <div
                                                class="d-flex align-items-center"
                                            >
                                                <div class="percent">
                                                    <div
                                                        class="progress"
                                                        :style="{
                                                            width:
                                                                progress.progress +
                                                                '%'
                                                        }"
                                                    ></div>
                                                </div>
                                                <span class="value">{{
                                                    progress.progress
                                                }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cta">
                                        <button
                                            v-if="show"
                                            class="hidden_post"
                                            type="button"
                                            @click="hiddenPost()"
                                        >
                                            <p>Hidden</p>
                                        </button>
                                        <button
                                            v-else
                                            class="show_post"
                                            type="button"
                                            @click="showPost()"
                                        >
                                            <p>Read More</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
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
        user: {
            type     : Object,
            require  : false,
            'default': () => ({ count: 0 })
        },
    },
    data: function() {
        return {
            progresses: [],
            show: false,
            isActive: false
        };
    },
    methods: {
        showPost() {
            this.show = true;
            this.isActive = true;
        },
        hiddenPost() {
            this.show = false;
            this.isActive = false;
        },
        getSkill() {
            const url = "/ajax/user/skill/";
            axios.get(url + this.user.id).then(response => {
                this.progresses = response.data;
            });
        },
        loaded() {
            var id = this.user.id;
            window.addEventListener("load", function(event) {
                const spinner = document.getElementById("loading_"+ id );
                spinner.classList.add("loaded");
            });
        }
    },
    mounted() {
        this.getSkill();
    }
};
</script>
