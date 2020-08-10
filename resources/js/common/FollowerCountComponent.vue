<template>
    <div class="w-100 d-flex justify-content-between m-0 p-0">
        <span>FOLLOWER</span>
        <span>{{ follower_count }}</span>
    </div>
</template>

<script>
export default {
    props: {
        userID: [Number, String]
    },
    data: function() {
        return {
            follower_count: [],
        };
    },
    methods: {
        getFollowerCount() {
            try {
                const url = "/ajax/user/follower/count/";
                axios.get(url + this.userID).then(response => {
                    this.follower_count = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getFollowerCount();
    }
};
</script>
