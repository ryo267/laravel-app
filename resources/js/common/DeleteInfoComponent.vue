<template>
    <div class="w-100 d-flex justify-content-end m-0 p-0">
        <button class="trash" type="button" @click="deleteInfo()"><i class="fas fa-trash"></i></button>
    </div>
</template>

<script>
export default {
    props: {
        infoID: [Number, String]
    },
    data: function() {
        return {
        };
    },
    methods: {
        deleteInfo() {
            try {
                const url = "/ajax/info/delete/";
                axios.delete(url + this.infoID).then(response => {});
            } catch (error) {
                console.log(error);
            }
        },
    },
    mounted() {
    }
};
</script>
