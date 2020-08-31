<template>
    <section class="all_posts">
        <div class="container-fluid">
            <div class="row">
                <div v-if="posts.length" class="col">
                    <ul class="p-0">
                        <li v-for="post in getItems" :key="post.id">
                            <post-component
                                :post="post"
                                :userID="post.user_id"
                                :call="call"
                                v-on:parent-get-post="getPosts"
                            ></post-component>
                        </li>
                    </ul>
                    <paginate
                        :page-count="getPageCount"
                        :page-range="3"
                        :margin-pages="2"
                        :click-handler="clickCallback"
                        :prev-text="'＜'"
                        :next-text="'＞'"
                        :container-class="'pagination'"
                        :page-class="'page-item'"
                    >
                    </paginate>
                </div>
                <div v-if="flag" class="col text-white text-center">
                    <h3>検索結果：0件</h3>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Paginate from "vuejs-paginate";

export default {
    name: "posts-component",
    props: {
        post_tag: [String],
        userID: [String, Number],
        call: [String]
    },
    data: function() {
        return {
            posts: [],
            parPage: 5,
            currentPage: 1,
            flag: false
        };
    },
    components: {
        paginate: Paginate
    },
    computed: {
        getItems() {
            let current = this.currentPage * this.parPage;
            let start = current - this.parPage;
            return this.posts.slice(start, current);
        },
        getPageCount() {
            return Math.ceil(this.posts.length / this.parPage);
        }
    },
    methods: {
        clickCallback(pageNum) {
            this.currentPage = Number(pageNum);
        },
        async getPosts() {
            try {
                if (
                    this.post_tag != null &&
                    this.post_tag != "" &&
                    this.call == "tab"
                ) {
                    const url = "/ajax/post/all/";
                    await axios.get(url + this.post_tag).then(response => {
                        this.posts = response.data;
                        if (response.data.length) {
                            this.flag = false;
                        } else {
                            this.flag = true;
                        }
                    });
                } else if (this.call == "profile") {
                    const url = "/ajax/post/user/";
                    await axios.get(url + this.userID).then(response => {
                        this.posts = response.data;
                        if (response.data.length) {
                            this.flag = false;
                        } else {
                            this.flag = true;
                        }
                    });
                }
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getPosts();
    }
};
</script>
