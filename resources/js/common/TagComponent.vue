<template>
    <div>
        <span class="mr-1" id="tag" v-for="tag in tags" :key="tag.id">{{
            tag.name
        }}<i class="fas fa-tag ml-3"></i></span>
    </div>
</template>

<script>
export default {
    props: {
        postID: [Number, String]
    },
    data: function() {
        return {
            tags: []
        };
    },
    methods: {
        getTag() {
            try {
                //console.log("post-component-getTag");
                const url = "/ajax/tag/";

                axios.get(url + this.postID).then(response => {
                    this.tags = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getTag();
    }
};
</script>
