<template>
    <div class="container-fluid all_scouts">
        <div class="row">
            <div v-if="scouts.length" class="col">
                <ul class="p-0">
                    <li v-for="scout in getItems" :key="scout.id">
                        <company-scout-component
                            :userID="scout.user_id"
                            :scoutID="scout.id"
                        />
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
    name: "company-scouts-component",
    data: function() {
        return {
            scouts: [],
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
            return this.scouts.slice(start, current);
        },
        getPageCount() {
            return Math.ceil(this.scouts.length / this.parPage);
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
        async getScouts() {
            try {
                const url = "/ajax/scout/company/all/";
                await axios.get(url + this.$userId).then(response => {
                    if (response.data.length) {
                        this.flag = false;
                        this.scouts = response.data;
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
        this.getScouts();
    }
};
</script>
