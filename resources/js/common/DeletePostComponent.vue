<template>
    <div class="trash_btn_wrap m-0 p-0">
        <button v-if="flag" class="trash" type="button" @click="flag=false"><i class="fas fa-trash"></i></button>
        <button v-else class="trash" type="button" @click="deletePost()">削除</button>
    </div>
</template>

<script>
export default {
    props: {
        postID: [Number, String]
    },
    data: function() {
        return {
            flag: true,
        };
    },
    methods: {
        async deletePost() {
            try {
                const url = "/ajax/post/delete/";
                await axios.delete(url + this.postID).then(response => {
                });
            } catch (error) {
                console.log(error);
            } finally {
                this.$emit('parent-get-post');
            }
        },
    },
    mounted() {
    }
};
</script>
