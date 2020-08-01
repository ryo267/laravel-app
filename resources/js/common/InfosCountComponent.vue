<template>
    <div class="w-100 d-flex justify-content-between m-0 p-0">
        <span>投稿数</span>
        <span>{{ infos_count }}</span>
    </div>
</template>

<script>
export default {
    props: {
        userID: [Number, String]
    },
    data: function() {
        return {
            infos_count: [],
        };
    },
    methods: {
        getInfosCount() {
            try {
                const url = "/ajax/company/infos/count/";
                axios.get(url + this.userID).then(response => {
                    this.infos_count = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getInfosCount();
    }
};
</script>
