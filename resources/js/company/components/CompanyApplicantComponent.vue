<template>
    <div class="container-fluid applicant my-5">
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
                                        <h3 id="label">MAIL</h3>
                                        <p class="description">{{user.email}}</p>
                                        <h3 id="label">PROFILE</h3>
                                        <p
                                            class="description"
                                        >{{user.profile_text}}</p>
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
    name: "company-applicant-component",
    props: {
        userID: [Number, String]
    },
    data: function() {
        return {
            user: [],
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
        async getCompany() {
            try {
                const url = "/ajax/user/";
                await axios.get(url + this.userID).then(response => {
                    this.user = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        getSkill() {
            const url = "/ajax/user/skill/";
            axios.get(url + this.userID).then(response => {
                this.progresses = response.data;
            });
        },
    },
    mounted() {
        this.getCompany();
        this.getSkill();
    }
};
</script>
