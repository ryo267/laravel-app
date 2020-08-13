<template>
    <div class="container-fluid info my-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <delete-info-component v-if="info.company_id == this.$userId" :infoID="infoID"/>
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
                                            company.back_image === null ||
                                                company.back_image === undefined
                                        "
                                        class="background-image"
                                    ></div>
                                    <div
                                        v-else
                                        class="background-image"
                                        :style="{
                                            background:
                                                'url(' +
                                                company.back_image +
                                                ') center/cover no-repeat'
                                        }"
                                    ></div>
                                    <div class="publication-details">
                                        <div>
                                            <img
                                                class="profile_image img-thumbnail rounded-circle"
                                                :src="company.profile_image"
                                            />
                                            <p></p>
                                            <p class="author">
                                                {{ company.screen_name }}
                                            </p>
                                        </div>
                                        <h5 class="title">{{ info.title }}</h5>
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
                                        <h5 class="title">{{ info.title }}</h5>
                                        <p
                                            class="description"
                                            v-html="info.text"
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
        infoID: [Number, String],
        companyID: [Number, String]
    },
    data: function() {
        return {
            info:[],
            company: [],
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
                //console.log("info-component-getCompany");

                const url = "/ajax/company/";
                await axios.get(url + this.companyID).then(response => {
                    this.company = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        async getInfo() {
            try {
                //console.log("info-component-getInfo");

                const url = "/ajax/info/";
                await axios.get(url + this.infoID).then(response => {
                    this.info = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        //console.log('this.infoID'+this.infoID);
        //console.log('this.companyID'+this.companyID);
        this.getCompany();
        this.getInfo();
    }
};
</script>
