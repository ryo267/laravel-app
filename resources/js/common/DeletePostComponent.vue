<template>
    <div class="w-100 d-flex m-0 p-0">
        <button class="trash" type="button" @click="deletePost()"><i class="fas fa-trash"></i></button>
    </div>
</template>

<script>
export default {
    props: {
        postID: [Number, String]
    },
    data: function() {
        return {
        };
    },
    methods: {
        deletePost() {
            try {
                const url = "/ajax/post/delete/";
                axios.delete(url + this.postID).then(response => {});
            } catch (error) {
                console.log(error);
            }
        },
    },
    mounted() {
    }
};
</script>
