<template>
    <div class="container-fluid">
        <div class="row px-3">
            <div class="col">
                <div class="photo_wrap">
                    <img
                        v-if="
                            user.back_image != null ||
                                user.back_image != undefined
                        "
                        class="back_photo"
                        :src="user.back_image"
                    />
                    <img
                        v-else
                        class="back_photo"
                        src="/sample/noimage.jpg"
                    />
                    <div class="input-item">
                        <label class="input-item__label">
                            <i class="fas fa-camera fa-3x"></i>
                            <input type="file" v-on:change="fileSelected_2" />
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-3">
            <div class="col text-center">
                <button v-on:click="fileUpload_2" class="upload_btn">
                    UPLOAD<i class="fas fa-cloud-upload-alt ml-3"></i>
                </button>
            </div>
        </div>
        <div class="row px-3 profile">
            <div class="col-md-4 main_profile">
                <div class="my-2">
                    <div class="row p-0 m-0 text-center">
                        <div
                            class="col p-0 m-0 my_profile_image_wrap"
                            style="overflow:hidden"
                        >
                            <img
                                v-if="
                                    user.profile_image != null ||
                                        user.profile_image != undefined
                                "
                                class="my_profile_image"
                                :src="user.profile_image"
                            />
                            <img
                                v-else
                                class="my_profile_image"
                                src="/sample/user.png"
                                rel=""
                                alt=""
                            />
                            <div class="input-item">
                                <label class="input-item__label">
                                    <i class="fas fa-camera fa-3x"></i>
                                    <input
                                        type="file"
                                        v-on:change="fileSelected"
                                    />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button v-on:click="fileUpload" class="upload_btn">
                                UPLOAD<i
                                    class="fas fa-cloud-upload-alt ml-3"
                                ></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <div class="col">
                                    <div>
                                        <label
                                            for="screen_name"
                                            class=""
                                            id="label"
                                            >ACCOUNT-NAME</label
                                        >
                                    </div>
                                    <div>
                                        <input
                                            type="text"
                                            class="form"
                                            id="scrren_name"
                                            v-model="user.screen_name"
                                        />
                                    </div>
                                    <div
                                        v-if="errors.screen_name"
                                        id="error_message"
                                    >
                                        <div style="color:#e74c3c">{{ errors.screen_name[0] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <div>
                                        <label for="name" class="" id="label"
                                            >USER-NAME</label
                                        >
                                    </div>
                                    <div>
                                        <input
                                            type="text"
                                            class=" form"
                                            id="name"
                                            v-model="user.name"
                                        />
                                    </div>
                                    <div v-if="errors.name" id="error_message">
                                        <div style="color:#e74c3c">{{ errors.name[0] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <div>
                                        <label for="email" class="" id="label"
                                            >MAIL</label
                                        >
                                    </div>
                                    <div>
                                        <input
                                            type="text"
                                            class=" form"
                                            id="email"
                                            v-model="user.email"
                                        />
                                    </div>
                                    <div v-if="errors.email" id="error_message">
                                        <div style="color:#e74c3c">{{ errors.email[0] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col posts_count">
                            <posts-count-component :userID="this.$userId" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col follow">
                            <follow-count-component :userID="this.$userId" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col follower">
                            <follower-count-component :userID="this.$userId" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col thanks">
                            <thanks-count-component :userID="this.$userId" />
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col">
                        <button type="submit" class="col update_btn" @click="submit()">
                            UPDATE<i class="fas fa-sync-alt ml-3"></i>
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
                            <textarea
                                style="height:500px"
                                type="text"
                                class="mt-3 form_profile_text"
                                id="profile"
                                v-model="user.profile_text"
                            />
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

                            <button
                                type="submit"
                                class="btn"
                                @click="deleteSkill(progress.id)"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div>
                            <form class="d-flex" v-on:submit.prevent="addSkill">
                                <div class="w-50">
                                    <input
                                        placeholder="SKILL_NAME"
                                        type="text"
                                        class="h-100 w-100 input_skill "
                                        id="skill_name my-2"
                                        v-model="skill_name"
                                    />
                                </div>
                                <div class="w-25">
                                    <input
                                        placeholder="1~100"
                                        type="text"
                                        class="h-100 w-100 input_progress"
                                        id="progress my-2"
                                        v-model="progress"
                                    />
                                </div>
                                <div class="w-25">
                                    <button type="submit" class="col skill_add_btn">
                                        ADD<i class="far fa-arrow-alt-circle-up ml-3"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <in-profile-tab-component/>
            </div>
        </div>
    </div>
</template>

<script>
import Paginate from "vuejs-paginate";

export default {
    name: "profile-component",
    data: function() {
        return {
            user: [],
            posts: [],
            skills: [],
            progresses: [],
            skill_name: "",
            progress: "",
            fileInfo: [],
            fileInfo_2: [],
            parPage: 5,
            currentPage: 1,
            errors: []
        };
    },
    components: {
        paginate: Paginate
    },
    computed: {
        getItems() {
            let current = this.currentPage * this.parPage;
            let start = current - this.parPage;
            return this.posts.slice(start, current);
        },
        getPageCount() {
            return Math.ceil(this.posts.length / this.parPage);
        }
    },
    methods: {
        clickCallback(pageNum) {
            this.currentPage = Number(pageNum);
        },
        fileUpload() {
            const formData = new FormData();

            formData.append("file", this.fileInfo);

            axios.post("/profile", formData).then(response => {
                this.user = response.data;
                alert("プロフィール画像を変更しました");
            });
        },
        fileUpload_2() {
            const formData = new FormData();

            formData.append("file", this.fileInfo_2);

            axios.post("/profile/back", formData).then(response => {
                this.user = response.data;
                alert("プロフィール背景画像を変更しました");
            });
        },
        fileSelected(event) {
            this.fileInfo = event.target.files[0];
        },
        fileSelected_2(event) {
            this.fileInfo_2 = event.target.files[0];
        },
        async getProfile() {
            try {
                const url = "/ajax/user";
                await axios.get(url).then(response => {
                    this.user = response.data;
                });
                //console.log('this.response ='+this.response);
            } catch (error) {
                console.log(error);
            }
        },
        addSkill() {
            const url = "/ajax/user/skill";
            const params = {
                skill_name: this.skill_name,
                progress: this.progress
            };
            axios
                .post(url, params)
                .then(response => {
                    this.skill_name = "";
                    this.progress = "";
                    this.progresses = response.data;
                })
                .catch(e => {
                    console.log(e.response.data.errors);
                    this.errors = e.response.data.errors;
                });
        },
        getSkill() {
            const url = "/ajax/user/skill/";
            axios.get(url + this.$userId ).then(response => {
                this.progresses = response.data;
            });
        },
        deleteSkill(id) {
            //console.log(id);
            const url = "/ajax/user/skill/delete/";
            axios
                .delete(url + id)
                .then(response => {
                    this.progresses = response.data;
                })
                .catch(e => {
                    console.log(e.response.data.errors);
                    this.errors = e.response.data.errors;
                });
        },
        submit() {
            const url = "/ajax/user/";
            axios
                .put(url + this.user.id, this.user)
                .then(response => {
                    alert("プロフィールを変更しました");
                })
                .catch(e => {
                    console.log(e.response.data.errors);
                    this.errors = e.response.data.errors;
                });
        },
    },
    mounted() {
        this.getProfile();
        this.getSkill();

        Echo.channel("post").listen("PostCreated", e => {
            this.getProfile();
        });

        Echo.channel("post").listen("PostDeleted", e => {
            this.getProfile();
        });
    }
};
</script>
