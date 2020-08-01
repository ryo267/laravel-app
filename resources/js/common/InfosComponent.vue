<template>
    <div class="container-fluid all_infos">
        <div class="row">
            <div class="col">
                <ul class="p-0">
                    <li v-for="info in getItems" :key="info.id">
                        <info-component :companyID="info.company_id" :infoID="info.id"/>
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
    name: "companies-component",
    data: function() {
        return {
            infos: [],
            show: false,
            isActive: false,
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
            return this.infos.slice(start, current);
        },
        getPageCount() {
            return Math.ceil(this.infos.length / this.parPage);
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
        async getInfos() {
            try {
                //console.log("companies-component-getCompanies");

                const url = "/ajax/info";
                await axios.get(url).then(response => {
                    this.infos = response.data;
                });
                //console.log("this.infos" + this.infos);
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getInfos();

         Echo.channel("info").listen("InfoCreated", e => {
            //console.log("InfoCreated");
            this.getInfos();
        });
    }
};
</script>
