<template>
    <div class="apply_btn_wrap m-0 p-0">
        <button v-if="apply_flag" class="apply_btn" type="button">
            応募済
        </button>
        <div v-else>
            <button v-if="flag" class="apply_btn" type="button" @click="flag=false">
                <i class="far fa-paper-plane"></i>
            </button>
            <button v-else class="apply_btn" type="button" @click="postApply()">
                応募する
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        companyID: [Number, String]
    },
    data: function() {
        return {
            apply_flag: false,
            flag: true,
        };
    },
    methods: {
        postApply() {
            try {
                const url = "/ajax/apply";
                const params = {
                    userID: this.$userId,
                    companyID: this.companyID
                };
                axios.post(url, params).then(response => {
                    this.apply_flag = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        getApply() {
            try {
                const url = "/ajax/apply/user/";
                axios
                    .get(url + this.$userId + "/" + this.companyID)
                    .then(response => {
                        this.apply_flag = response.data;
                    });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getApply();
    }
};
</script>
