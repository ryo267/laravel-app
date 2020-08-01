<template>
    <div>
        <span class="tag" v-for="tag in tags" :key="tag.id">{{
            tag.name
        }}</span>
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
