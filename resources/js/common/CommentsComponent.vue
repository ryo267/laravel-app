<template>
    <div class="row comment_group">
        <div class="col">
            <div
                class="row mt-3"
                v-for="comment in comments"
                :key="comment.id"
            >
                <div class="col">
                    <div class="col comment_text">
                        <!-- メッセージ内容 -->
                        <p v-html="comment.text"></p>
                    </div>
                    <div class="col comment_created_at">
                        <!-- 登録された日時 -->
                        <p>{{ comment.created_at }}</p>
                    </div>
                </div>
                <thanks-component :commentID="comment.id" />
            </div>
            <div class="row mt-3">
                <div class="col">
                    <form v-on:submit.prevent="getHtml" style="width:100%">
                        <div class="form-group row m-0">
                            <div class="col" v-if="show_editer">
                                <editor
                                    class="editor"
                                    :options="editorOptions"
                                    ref="toastuiEditor"
                                    initialEditType="wysiwyg"
                                    previewStyle="vertical"
                                />
                            </div>
                        </div>

                        <div class="form-group row m-0">
                            <div class="col">
                                <button
                                    type="submit"
                                    class="btn btn-success w-100"
                                >
                                    解答する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Editor } from "@toast-ui/vue-editor";

export default {
    name: "log-component",
    props: {
        postID: [Number, String]
    },
    data: function() {
        return {
            editorText: this.text,
            editorOptions: {
                hideModeSwitch: true
            },
            text: "",
            comments: [],
            message: "",
            messages: [],
            show_editer: true
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
            const url = "/ajax/comment";
            const params = {
                postID: this.postID,
                userID: this.$userId,
                message: html
            };
            await axios.post(url, params).then(response => {
                this.show_editer = false;
                this.getComments();
            });

            this.show_editer = true;
            //console.log(html);
        },
        getComments() {
            const url = "/ajax/comments/";
            axios.get(url + this.postID).then(response => {
                this.comments = response.data;
            });
            //console.log(this.comments);
        }
    },
    mounted() {
        this.getComments();

        Echo.channel("comment").listen("CommentEvent", e => {
            //console.log("CommentEvent");
            this.getComments(); //全メッセージを再読込
        });
    }
};
</script>
