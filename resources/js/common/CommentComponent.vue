<template>
    <div class="row mt-3 comment">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <img
                        v-if="
                            user.profile_image != null &&
                                user.profile_image != undefined
                        "
                        class="profile_image img-thumbnail rounded-circle"
                        :src="user.profile_image"
                    />
                    <img v-else class="profile_image img-thumbnail
                    rounded-circle" src=/sample/user.png />
                    <span>{{ user.screen_name }}</span>
                </div>
                <thanks-component v-if="user.id != this.$userId" :commentID="comment.id" />
            </div>
            <div class="comment_text">
                <p v-html="comment.text"></p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "comment-component",
    props: {
        comment: {
            type: Object,
            require: false,
            default: () => ({ count: 0 }) // Objectを生成する関数を指定する
        }
    },
    data: function() {
        return {
            user: ""
        };
    },
    methods: {
        async getUser() {
            const url = "/ajax/comment/user/";
            await axios.get(url + this.comment.id).then(response => {
                this.user = response.data;
                this.user = this.user[0];
            });
        }
    },
    mounted() {
        this.getUser();
    }
};
</script>
