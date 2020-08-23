<template>
    <div class="w-100 d-flex justify-content-between m-0 p-0">
        <span>フォロー</span>
        <span>{{ follow_count }}</span>
    </div>
</template>

<script>
export default {
    props: {
        userID: [Number, String]
    },
    data: function() {
        return {
            follow_count: [],
        };
    },
    methods: {
        getFollowCount() {
            try {
                const url = "/ajax/user/follow/count/";
                axios.get(url + this.userID).then(response => {
                    this.follow_count = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getFollowCount();
    }
};
</script>
