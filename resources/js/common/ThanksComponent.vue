<template>
    <span class="text-center">
        <button
            class="give_thanks"
            id="b_none"
            type="submit"
            @click="giveThanks()"
        >
            <i class="far fa-thumbs-up"></i>
        </button>
        <span v-text="thanks" />
    </span>
</template>

<script>
export default {
    name: "thanks-component",
    props: {
        commentID: [Number, String]
    },
    data: function() {
        return {
            thanks: 0,
        };
    },
    methods: {
        getThanks() {
            const url = "/ajax/thanks/";
            axios.get(url + this.commentID).then(response => {
                this.thanks = response.data;
            });
        },
        giveThanks() {
            const url = "/ajax/thanks";
            const params = { commentID: this.commentID, userID: this.$userId };
            axios.post(url, params).then(response => {
                this.thanks = response.data;
            });
        }
    },
    mounted() {
        this.getThanks();
    }
};
</script>
