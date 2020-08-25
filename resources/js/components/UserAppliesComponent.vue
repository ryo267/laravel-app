<template>
    <div class="container-fluid all_applies">
        <div class="row">
            <div v-if="applies.length" class="col">
                <ul class="p-0">
                    <li v-for="apply in getItems" :key="apply.id">
                        <user-apply-component :companyID="apply.id" />
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
</template>

<script>
import Paginate from "vuejs-paginate";

export default {
    name: "user-applies-component",
    data: function() {
        return {
            applies: [],
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
            return this.applies.slice(start, current);
        },
        getPageCount() {
            return Math.ceil(this.applies.length / this.parPage);
        }
    },
    methods: {
        clickCallback(pageNum) {
            this.currentPage = Number(pageNum);
        },
        showPost() {
            this.show = true;
            this.isActive = true;
        },
        hiddenPost() {
            this.show = false;
            this.isActive = false;
        },
        async getApplies() {
            try {
                const url = "/ajax/apply/user/all/";
                await axios.get(url + this.$userId).then(response => {
                    if (response.data.length) {
                        this.flag = false;
                        this.applies = response.data;
                    } else {
                        this.flag = true;
                    }
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getApplies();
    }
};
</script>
