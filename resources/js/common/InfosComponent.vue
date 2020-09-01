<template>
    <div class="container-fluid all_infos">
        <div class="row">
            <div v-if="infos.length" class="col">
                <ul class="p-0">
                    <li v-for="info in getItems" :key="info.id">
                        <info-component
                            :companyID="info.company_id"
                            :info="info"
                            :call="call" v-on:parent-get-info="getInfos"
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
    name: "infos-component",
    props: {
        tab: [String],
        companyID: [Number, String],
        call: [String]
    },
    data: function() {
        return {
            infos: [],
            show: false,
            isActive: false,
            parPage: 5,
            currentPage: 1,
            flag: false,
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
                if (this.tab != null && this.tab != "" && this.call == "tab") {
                    const url = "/ajax/info/";
                    await axios.get(url + this.tab).then(response => {
                        this.infos = response.data;
                        if (this.infos.length) {
                            this.flag = false;
                        } else {
                            this.flag = true;
                        }
                    });
                } else if (this.call == "profile") {
                    const url = "/ajax/info/company/";
                    await axios.get(url + this.companyID).then(response => {
                        this.infos = response.data;
                        if (this.infos.length) {
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
        this.getInfos();
    }
};
</script>
