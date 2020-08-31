<template>
    <div class="trash_btn_wrap m-0 p-0">
        <button v-if="flag" class="trash" type="button" @click="flag=false"><i class="fas fa-trash"></i></button>
        <button v-else class="trash" type="button" @click="deleteInfo()">削除する</button>
    </div>
</template>

<script>
export default {
    props: {
        infoID: [Number, String]
    },
    data: function() {
        return {
            flag: true,
        };
    },
    methods: {
        deleteInfo() {
            try {
                const url = "/ajax/info/delete/";
                axios.delete(url + this.infoID).then(response => {
                });
            } catch (error) {
                console.log(error);
            } finally {
                this.$emit('parent-get-info');
            }
        },
    },
    mounted() {
    }
};
</script>
