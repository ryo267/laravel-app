<template>
    <section class="all_posts">
    <div class="container-fluid">
        <div class="row">
            <div v-if="posts.length" class="col">
                <ul class="p-0">
                    <li v-for="post in getItems" :key="post.id">
                        <post-component :postID ="post.id" :userID="post.user_id"></post-component>
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
            <div v-else class="col text-white text-center">
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
        userID: [String, Number]
    },
    data: function() {
        return {
            posts: [],
            parPage: 5,
            currentPage: 1
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
                if( this.post_tag != null &&  this.post_tag != "" && this.userID == null){
                    const url = "/ajax/post/all/";
                    await axios.get(url + this.post_tag).then(response => {
                        this.posts = response.data;
                    });
                }else if( this.userID != null ){
                    const url = "/ajax/post/user/";
                    await axios.get(url + this.userID).then(response => {
                        this.posts = response.data;
                    });
                }
                
            } catch (error) {
                console.log(error);
            }
        },
    },
    mounted() {

        this.getPosts();

        Echo.channel("post").listen("PostCreated", e => {
            this.getPosts();
        });

        Echo.channel("post").listen("PostDeleted", e => {
            this.getPosts();
        });
    }
};
</script>
