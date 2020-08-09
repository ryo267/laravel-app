<template>
    <div class="all_tabs">
        <ul class="tabs">
            <li><post-tab-component/></li>
            <li><user-tab-component/></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "all-tab-component",
    data: function() {
        return {
            tabs: [
                {
                    id: "1",
                    name: "posts",
                    link: "ajax/user/all/"
                },
                {
                    id: "2",
                    name: "users",
                    link: "ajax/user/follower/"
                },
            ],
            currentTab: "posts",
            isActive: 0
        };
    },
    filters: {
        uppercase(value) {
            return value.toUpperCase();
        }
    },
    methods: {
        activeTab(tab_name, tab_id) {
            this.currentTab = tab_name;
            this.isActive = tab_id;
        }
    },
    mounted() {}
};
</script>
