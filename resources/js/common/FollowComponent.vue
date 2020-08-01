<template>
    <div class="w-100 d-flex justify-content-center m-0 p-0">
        <button type="submit" class="" v-if="follow_flag" @click="reFollow()">
            フォロー解除
        </button>
        <button type="submit" class="" v-else @click="follow()">
            フォロー
        </button>
    </div>
</template>

<script>
export default {
    props: {
        userID: [Number, String]
    },
    data: function() {
        return {
            follow_flag: false,
            follower_count: 0,
        };
    },
    methods: {
        follow() {
            const url = "/ajax/user/follow";
            const params = {
                userID: this.userID,
            };
            axios.post(url, params).then(response => {
                this.follower_count = response.data[0];
                this.follow_flag = response.data[1];
            });
        },
        reFollow() {
            const url = "/ajax/user/follow/remove/";
            axios.delete(url + this.userID).then(response => {
                this.follower_count = response.data[0];
                this.follow_flag = response.data[1];
            });
        },
        getFollow(){
            const url = "/ajax/user/follow/";
            axios.get(url + this.userID+'/'+this.$userId).then(response => {
                this.follow_flag = response.data;
            });
        }
    },
    mounted() {
        console.log(this.userID);
        this.getFollow();
    }
};
</script>
