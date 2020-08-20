<template>
    <section class="all_users">
        <div class="container-fluid">
            <div class="row">
                <div v-if="users.length" class="col">
                    <ul class="p-0">
                        <li v-for="user in getItems" :key="user.id">
                            <user-component
                                :user="user"
                            ></user-component>
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
    name: "users-component",
    props: {
        tab: [String]
    },
    data: function() {
        return {
            users: [],
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
            return this.users.slice(start, current);
        },
        getPageCount() {
            return Math.ceil(this.users.length / this.parPage);
        }
    },
    methods: {
        clickCallback(pageNum) {
            this.currentPage = Number(pageNum);
        },
        async getUsers() {
            try {
                //console.log('users-component-getUsers');

                if (this.tab != null && this.tab != "") {
                    const url = "/ajax/user/all/";
                    await axios.get(url + this.tab).then(response => {
                        this.users = response.data;
                    });
                }
                //console.log('this.post' + this.users);
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getUsers();
    }
};
</script>
