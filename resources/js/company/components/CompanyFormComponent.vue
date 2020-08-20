<template>
    <div class="container-fluid info_form">
        <div
            v-if="errors.text || errors.title"
            id="error_message"
            class="error_modal"
        >
            <div class="wrap">
                <div v-if="errors.title" style="color:#e74c3c">
                    {{ errors.title[0] }}
                </div>
                <div v-if="errors.text" style="color:#e74c3c">
                    {{ errors.text[0] }}
                </div>
                <div>
                    <button class="btn" type="button" @click="errors = []">
                        閉じる
                    </button>
                </div>
            </div>
        </div>
        <div class="row h-100">
            <div class="col">
                <form v-on:submit.prevent="getHtml" style="height:100%;">
                    <div class="title_form row m-0">
                        <div class="col">
                            <div>
                                <input
                                    placeholder="Title"
                                    type="text"
                                    class="form-control"
                                    id="title"
                                    v-model="title"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row m-0" style="height: calc(100% - 80px);">
                        <div class="col" v-if="show">
                            <editor
                                class="editor"
                                :options="editorOptions"
                                :initialValue="text"
                                height="100%"
                                ref="toastuiEditor"
                                :plugin="plugins"
                            />
                        </div>
                    </div>

                    <div class="form_btn row m-0">
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">
                                投稿する
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { Editor } from "@toast-ui/vue-editor";
//import VueTagsInput from "@johmun/vue-tags-input";
import Chart from "@toast-ui/editor-plugin-chart";
import "codemirror/lib/codemirror.css";
import "@toast-ui/editor/dist/toastui-editor.css";
import "tui-chart/dist/tui-chart.css";

export default {
    name: "chat-component",
    data: function() {
        return {
            editorText: this.text,
            editorOptions: {
                hideModeSwitch: false
            },
            plugins: {
                chart: Chart
            },
            title: "",
            tag: "",
            tags: [],
            text: "",
            input: "",
            show: true,
            errors: [],
        };
    },
    components: {
        editor: Editor
    },
    methods: {
        scroll() {
            this.$refs.toastuiEditor.invoke("scrollTop", 10);
        },
        moveTop() {
            this.$refs.toastuiEditor.invoke("moveCursorToStart");
        },
        async getHtml() {
            let html = this.$refs.toastuiEditor.invoke("getHtml");
            const url = "/ajax/info/company";
            const params = {
                title: this.title,
                text: html
            };
            await axios
                .post(url, params)
                .then(response => {
                    // 成功したらメッセージをクリア
                    this.title = "";
                    this.show = false;
                })
                .catch(e => {
                    console.log(e.response.data.errors);
                    this.errors = e.response.data.errors;
                });

            this.show = true;
            //console.log(html);
        }
    },
    mounted() {}
};
</script>
