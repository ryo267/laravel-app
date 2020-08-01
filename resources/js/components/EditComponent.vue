<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form v-on:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label"
                            >Title</label
                        >
                        <input
                            type="text"
                            class="col-sm-9 form-control"
                            id="title"
                            v-model="post.title"
                        />
                    </div>
                    <div class="form-group row">
                        <label for="tag" class="col-sm-3 col-form-label"
                            >Tag</label
                        >
                        <input
                            type="text"
                            class="col form-control"
                            id="tag"
                            v-model="tags"
                        />
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-3 col-form-label"
                            >Content</label
                        >
                        <input
                            type="text"
                            class="col-sm-9 form-control"
                            id="content"
                            v-model="post.text"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        postID: [Number, String]
    },
    name: "edit-component",
    data: function() {
        return {
            post: [],
            tags: []
        };
    },
    methods: {
        getPost() {
            try {
                const url = "/ajax/post/";
                axios.get(url + this.postID).then(response => {
                    this.post = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        async getTags() {
            try {
                console.log("getTags");

                const url = "/ajax/tag/";
                await axios.get(url + this.postID).then(response => {
                    this.tags = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        submit() {
            const url1 = "/ajax/tag";
            const params = {
                id: this.postID,
                tags: this.tags,
            };
            console.log(this.tags);
            
            axios.put(url1, params).then(response => {
            });
            const url2 = "/ajax/post/";
            axios.put(url2+this.postID, this.post).then(response => {
                this.$router.push({ name: "home" });
            });
        }
    },
    mounted() {
        console.log("edit");
        this.getTags();
        this.getPost();
    }
};
</script>
