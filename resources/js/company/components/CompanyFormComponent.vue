<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form v-on:submit.prevent="getHtml">
                    <div class="form-group row m-0">
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
                    <!--
                    <div class="form-group row m-0">
                        <div class="col">
                            <div>
                                <vue-tags-input
                                    v-model="tag"
                                    :tags="tags"
                                    @tags-changed="newTags => (tags = newTags)"
                                />
                            </div>
                        </div>
                    </div>
                    -->

                    <div class="form-group row m-0">
                        <div class="col" v-if="show">
                            <editor
                                class="editor"
                                :options="editorOptions"
                                :initialValue="text"
                                height="100vh"
                                ref="toastuiEditor"
                                :plugin="plugins" 
                            />
                        </div>
                    </div>

                    <div class="form-group row m-0">
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
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';
import 'tui-chart/dist/tui-chart.css';

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
            show: true
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
            await axios.post(url, params).then(response => {
                // 成功したらメッセージをクリア
                this.title = "";
                this.show = false;
            });

            this.show = true;
            //console.log(html);
        },
    },
    mounted() {}
};
</script>
