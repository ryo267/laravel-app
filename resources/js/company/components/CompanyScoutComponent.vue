<template>
    <div class="container-fluid info my-5">
        <div class="row">
            <div class="col">
                <div class="card">
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
                                            user.back_image === null ||
                                                user.back_image === undefined
                                        "
                                        class="background-image"
                                    ></div>
                                    <div
                                        v-else
                                        class="background-image"
                                        :style="{
                                            background:
                                                'url(' +
                                                user.back_image +
                                                ') center/cover no-repeat'
                                        }"
                                    ></div>
                                    <div class="publication-details">
                                        <div>
                                            <img
                                                class="profile_image img-thumbnail rounded-circle"
                                                :src="user.profile_image"
                                            />
                                            <p></p>
                                            <p class="author">
                                                {{ user.screen_name }}
                                            </p>
                                        </div>
                                        <h5 class="title">{{ user.screen_name }}</h5>
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
                                        <h5 class="title">{{ user.screen_name }}</h5>
                                        <p
                                            class="description"
                                            v-html="scout.text"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        scoutID: [Number, String],
        userID: [Number, String]
    },
    data: function() {
        return {
            scout:[],
            user: [],
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
        async getUser() {
            try {

                const url = "/ajax/user/";
                await axios.get(url + this.userID).then(response => {
                    this.user = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        async getScout() {
            try {

                const url = "/ajax/scout/";
                await axios.get(url + this.scoutID).then(response => {
                    this.scout = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getUser();
        this.getScout();
    }
};
</script>
