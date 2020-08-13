<template>
    <div class="container-fluid post my-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="loading_2" :id="'loading_' + userID">
                        <i class="fas fa-spinner fa-5x"></i>
                    </div>
                    <delete-post-component
                        v-if="post.user_id === this.$userId"
                        :postID="postID"
                    />
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
                                            <div
                                                class="follow_submit_1"
                                                v-if="user.id != this.$userId && this.$userRole != 'company'"
                                            >
                                                <follow-component
                                                    :userID="userID"
                                                />
                                            </div>
                                        </div>
                                        <h5 class="title">{{ post.title }}</h5>
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
                                            v-if="user.id != this.$userId && this.$userRole != 'company'"
                                        >
                                            <follow-component
                                                :userID="userID"
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
                                        <h5 class="title">{{ post.title }}</h5>
                                        <tag-component :postID="postID" />
                                        <p
                                            class="description"
                                            v-html="post.text"
                                        ></p>
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
                            <comments-component
                                v-if="show"
                                :postID="postID"
                            ></comments-component>
                            <div v-if="show" class=" d-flex post_footer">
                                <favo-count-component :postID="postID" />
                                <comment-count-component :postID="postID" />
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
    name: "post-component",
    props: {
        postID: [Number, String],
        userID: [Number, String]
    },
    data: function() {
        return {
            user: [],
            post: [],
            tags: [],
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
        getPost() {
            try {
                //console.log("post-component-getPost");
                //console.log(this.postID);
                const url = "/ajax/post/";

                axios.get(url + this.postID).then(response => {
                    this.post = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        getProfile() {
            try {
                //console.log("post-component-getProfile");

                const url = "/ajax/user/";
                axios.get(url + this.userID).then(response => {
                    this.user = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        loaded() {
            var id = this.userID;
            window.addEventListener("load", function(event) {
                const spinner = document.getElementById("loading_" + id);
                spinner.classList.add("loaded");
            });
        }
    },
    mounted() {
        this.getProfile();
        this.getPost();
        this.loaded();
    }
};
</script>
