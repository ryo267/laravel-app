<template>
    <div class="w-100 d-flex justify-content-between m-0 p-0">
        <span>THANKS</span>
        <span>{{ thanks_count }}</span>
    </div>
</template>

<script>
export default {
    props: {
        userID: [Number, String]
    },
    data: function() {
        return {
            thanks_count: 0,
        };
    },
    methods: {
        getThanksCount() {
            try {
                const url = "/ajax/user/thanks/count/";
                axios.get(url + this.userID).then(response => {
                    this.thanks_count = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getThanksCount();
    }
};
</script>
