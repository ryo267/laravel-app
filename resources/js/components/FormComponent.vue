<template>
    <div class="container-fluid post_form">
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

                    <div class="tag_form row m-0">
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

                    <div class="row m-0" style="height: calc(100% - 120px);">
                        <div class="col" v-if="show">
                            <div class="editor" id="editor"></div>
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
import Editor from "@toast-ui/editor";
import VueTagsInput from "@johmun/vue-tags-input";
import codeSyntaxHighlight from '@toast-ui/editor-plugin-code-syntax-highlight';
import hljs from 'highlight.js';
import tableMergedCell from '@toast-ui/editor-plugin-table-merged-cell';
import "codemirror/lib/codemirror.css";
import "@toast-ui/editor/dist/toastui-editor.css";
import 'highlight.js/styles/github.css';
import DOMPurify from 'dompurify';

export default {
    name: "form-component",
    data: function() {
        return {
            editorText: this.text,
            editorOptions: {
                hideModeSwitch: false
            },
            title: "",
            tag: "",
            tags: [],
            text: "テキスト",
            input: "",
            show: true,
            errors: [],
            chartOptions: [
                {
                    minWidth: 100
                },
                {
                    maxWidth: 600
                },
                {
                    minHeight: 100
                },
                {
                    maxHeight: 300
                }
            ],
            editor: "",
        };
    },
    methods: {
        scroll() {
            this.$refs.toastuiEditor.invoke("scrollTop", 10);
        },
        moveTop() {
            this.$refs.toastuiEditor.invoke("moveCursorToStart");
        },
        async getHtml() {
            let html = this.editor.getHtml();
            const url = "/ajax/post";
            const params = {
                title: this.title,
                tags: this.tags,
                text: DOMPurify.sanitize(html)
            };
            await axios
                .post(url, params)
                .then(response => {
                    this.title = "";
                    this.tags = [];
                    this.show = false;
                    this.show = true;
                    this.createEditor();
                })
                .catch(e => {
                    console.log(e.response.data.errors);
                    this.errors = e.response.data.errors;
                });
                
        },
        createEditor() {
            this.editor = new Editor({
                el: document.querySelector("#editor"),
                previewStyle: "vertical",
                height: "100%",
                initialValue: this.text,
                plugins: [
                    [codeSyntaxHighlight, { hljs }],
                    tableMergedCell,
                ],
                customHTMLSanitizer: html => {
                    return DOMPurify.sanitize(html);
                }
            });
        },
    },
    mounted() {
        this.createEditor();
    }
};
</script>
