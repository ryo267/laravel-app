<template>
    <div class="w-100 d-flex justify-content-between m-0 p-0">
        <span>投稿数</span>
        <span>{{ posts_count }}</span>
    </div>
</template>

<script>
export default {
    props: {
        userID: [Number, String]
    },
    data: function() {
        return {
            posts_count: 0,
        };
    },
    methods: {
        getPostsCount() {
            try {
                const url = "/ajax/user/posts/count/";
                axios.get(url + this.userID).then(response => {
                    this.posts_count = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getPostsCount();
    }
};
</script>
