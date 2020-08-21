<template>
    <div class="w-100 d-flex align-items-center m-0 p-0">
        <div v-if="favo_flag">
            <button
                class="delete_favo"
                type="button"
                id="b_none"
                @click="deleteFavo()"
            >
                <i class="fas fa-heart"></i>
            </button>
        </div>
        <div v-else>
            <button
                class="add_favo"
                type="button"
                id="b_none"
                @click="addFavo()"
            >
                <i class="far fa-heart"></i>
            </button>
        </div>
        <span>{{favo_count}}</span>
    </div>
</template>

<script>
export default {
    name: "favo-component",
    props: {
        postID: [Number, String]
    },
    data: function() {
        return {
            favo_count: 0,
            favo_flag: false
        };
    },
    methods: {
        addFavo() {
            const url = "/ajax/favo/add";
            const params = { postID: this.postID, userID: this.$userId };
            axios.post(url, params).then(response => {
                this.favo_count = response.data[0];
                this.favo_flag = response.data[1];
            });
        },
        deleteFavo() {
            const url = "/ajax/favo/delete/";
            axios.delete(url + this.postID+'/'+ this.$userId).then(response => {
                this.favo_count = response.data[0];
                this.favo_flag = response.data[1];
            });
        },
        getFavo() {
            try {
                const url = "/ajax/favo/";
                axios.get(url + this.postID+'/'+ this.$userId).then(response => {
                    this.favo_flag = response.data[0];
                    this.favo_count = response.data[1];
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getFavo();
    }
};
</script>
