<template>
    <div class="container-fluid">
        <div class="row px-3">
            <div class="col">
                <div class="photo_wrap">
                    <img
                        v-if="
                            user.back_image === null ||
                                user.back_image === undefined
                        "
                        class="back_photo"
                        src="/sample/noimage.jpg"
                    />
                    <img v-else class="back_photo" :src="user.back_image" />
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
                <div class="text-center" v-if="errors.file" id="error_message">
                    <div style="color:#e74c3c">{{ errors.file[0] }}</div>
                </div>
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
                                    user.profile_image === null ||
                                        user.profile_image === undefined
                                "
                                class="my_profile_image"
                                src="/sample/noimage.jpg"
                            />
                            <img
                                v-else
                                class="my_profile_image"
                                :src="user.profile_image"
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
                        <div class="col text-center">
                            <button v-on:click="fileUpload" class="upload_btn">
                                UPLOAD<i
                                    class="fas fa-cloud-upload-alt ml-3"
                                ></i>
                            </button>
                            <div class="text-center" v-if="errors.file" id="error_message">
                                <div style="color:#e74c3c">
                                    {{ errors.file[0] }}
                                </div>
                            </div>
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
                                        <div style="color:#e74c3c">
                                            {{ errors.screen_name[0] }}
                                        </div>
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
                                    <div class="text-center" v-if="errors.name" id="error_message">
                                        <div style="color:#e74c3c">
                                            {{ errors.name[0] }}
                                        </div>
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
                                    <div class="text-center" v-if="errors.email" id="error_message">
                                        <div style="color:#e74c3c">
                                            {{ errors.email[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col info">
                            <infos-count-component :userID="$userId" />
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col">
                        <button
                            type="submit"
                            class="col update_btn"
                            @click="submit()"
                        >
                            UPDATE<i class="fas fa-sync-alt ml-3"></i>
                        </button>
                        <div v-if="response">
                            <p class="text-success text-center">プロフィールを更新しました</p>
                        </div>
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
            </div>
        </div>
        <div class="row px-3 mt-5">
            <div class="col">
                <in-company-profile-tab-component />
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
            infos: [],
            fileInfo: [],
            fileInfo_2: [],
            parPage: 5,
            currentPage: 1,
            errors: [],
            response: false,
            isActive: false
        };
    },
    components: {
        paginate: Paginate
    },
    computed: {
        getItems() {
            let current = this.currentPage * this.parPage;
            let start = current - this.parPage;
            return this.infos.slice(start, current);
        },
        getPageCount() {
            return Math.ceil(this.infos.length / this.parPage);
        }
    },
    methods: {
        clickCallback(pageNum) {
            this.currentPage = Number(pageNum);
        },
        fileUpload() {
            const formData = new FormData();

            formData.append("file", this.fileInfo);

            axios
                .post("/company/profile", formData)
                .then(response => {
                    this.user = response.data;
                })
                .catch(e => {
                    console.log(e.response.data.errors);
                    this.errors = e.response.data.errors;
                });
        },
        fileUpload_2() {
            const formData = new FormData();

            formData.append("file", this.fileInfo_2);

            axios
                .post("/company/profile/back", formData)
                .then(response => {
                    this.user = response.data;
                })
                .catch(e => {
                    console.log(e.response.data.errors);
                    this.errors = e.response.data.errors;
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
                const url = "/ajax/company";
                await axios.get(url).then(response => {
                    this.user = response.data;
                    //this.infos = response.data[1];
                    //console.log(this.infos);
                });
            } catch (error) {
                console.log(error);
            }
        },
        submit() {
            this.errors.length = 0;
            const url = "/ajax/company/";
            axios
                .put(url + this.user.id, this.user)
                .then(response => {
                    this.response = true;
                })
                .catch(e => {
                    console.log(e.response.data.errors);
                    this.errors = e.response.data.errors;
                    this.response = false;
                });
        }
    },
    mounted() {
        this.getProfile();

        Echo.channel("info").listen("InfoDeleted", e => {
            this.getProfile();
        });
    }
};
</script>
