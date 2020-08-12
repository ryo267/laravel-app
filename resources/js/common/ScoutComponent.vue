<template>
    <div class="scout">
        <div class="input_form" :class="{ active: isActive }">
            <textarea
                type="text"
                class="mt-5 form_scout_text"
                id="scout"
                v-model="text"
            />
            <div class="w-75 send_btn_wrap">
                <button type="submit" class="" @click="cancel()">
                    CANCEL
                </button>
                <button type="submit" class="" @click="scout()">
                    SEND
                </button>
            </div>
        </div>
        <div class="scout_btn_wrap m-0 p-0">
            <button type="submit" class="" v-if="scout_flag">
                <i class="fas fa-check"></i>
            </button>
            <button type="submit" class="" v-else @click="openInput()">
                <i class="far fa-paper-plane"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        userID: [Number, String],
        userNAME: [String]
    },
    data: function() {
        return {
            scout_flag: false,
            text: this.userNAME + "様",
            isActive: false
        };
    },
    methods: {
        openInput(){
            this.isActive = true;
        },
        cancel(){
            this.isActive = false;
        },
        scout() {
            const url = "/ajax/user/scout";
            const params = {
                userID: this.userID,
                companyID: this.$userId,
                text: this.text
            };
            axios.post(url, params).then(response => {
                this.scout_flag = response.data;
                this.isActive = false;
            });
        },
        getScout() {
            const url = "/ajax/user/scout/";
            axios.get(url + this.userID + "/" + this.$userId).then(response => {
                this.scout_flag = response.data;
            });
        }
    },
    mounted() {
        this.getScout();
    }
};
</script>
