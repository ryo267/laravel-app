<template>
    <div class="container-fluid info my-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <delete-info-component
                        v-if="info.company_id == this.$userId"
                        :infoID="info.id"
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
                                        <div :id="'viewer' + info.id + call" ></div>
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
import Editor from "@toast-ui/editor";
import codeSyntaxHighlight from '@toast-ui/editor-plugin-code-syntax-highlight';
import hljs from 'highlight.js';
import tableMergedCell from '@toast-ui/editor-plugin-table-merged-cell';
import "codemirror/lib/codemirror.css";
import "@toast-ui/editor/dist/toastui-editor.css";
import 'highlight.js/styles/github.css';

export default {
    name: "info-component",
    props: {
        companyID: [Number, String],
        info: {
            type: Object,
            require: false,
            default: () => ({ count: 0 }) // Objectを生成する関数を指定する
        },
        call: [String]
    },
    data: function() {
        return {
            company: [],
            show: false,
            isActive: false,
            viewer: "",
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
        createViewer () {
            this.viewer = Editor.factory({
                el: document.querySelector("#viewer"+this.info.id+this.call),
                viewer: true,
                height: "100%",
                initialValue: this.info.text,
                plugins: [
                    [codeSyntaxHighlight, { hljs }],
                    tableMergedCell,
                ]
            });
        },
    },
    mounted() {
        this.getCompany();
        this.createViewer();
    }
};
</script>
