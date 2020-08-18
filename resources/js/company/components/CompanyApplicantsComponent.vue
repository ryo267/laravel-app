<template>
    <div class="container-fluid all_applicants">
        <div class="row">
            <div class="col">
                <ul class="p-0">
                    <li v-for="apply in getItems" :key="apply.id">
                        <company-applicant-component :userID="apply.id" />
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
        </div>
    </div>
</template>

<script>
import Paginate from "vuejs-paginate";

export default {
    name: "company-applicants-component",
    data: function() {
        return {
            applies: [],
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

                const url = "/ajax/applicant/user/all/";
                await axios.get(url+this.$userId).then(response => {
                    this.applies = response.data;
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
