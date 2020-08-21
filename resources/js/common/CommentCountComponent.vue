<template>
    <div class="w-100 d-flex align-items-center justify-content-end m-0 p-0">
        <div>
            <button class="" type="button" id="b_none">
                <i class="far fa-comments"></i>
            </button>
        </div>
        <span>{{ comment_count }}</span>
    </div>
</template>

<script>
export default {
    props: {
        postID: [Number, String]
    },
    data: function() {
        return {
            comment_count: 0
        };
    },
    methods: {
        getComment() {
            try {
                //console.log("post-component-getComment");
                const url = "/ajax/comment/";

                axios.get(url + this.postID).then(response => {
                    this.comment_count = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getComment();

        Echo.channel("comment").listen("CommentEvent", e => {
            //console.log("CommentEvent");
            this.getComment();
        });
    }
};
</script>
