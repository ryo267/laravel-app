<template>
    <div>
        <div class="overflow-auto user_tabs">
            <ul class="d-flex align-items-center m-0">
                <li
                    v-for="tab in tabs"
                    :key="tab.id"
                    class="px-3"
                    id="tabs"
                    @click="activeTab(tab.name, tab.id)"
                    :class="[isActive === tab.id ? 'active' : '']"
                >
                    {{ tab.name | uppercase }}
                </li>
            </ul>
        </div>
        <div class="contents">
            <users-component :key="currentTab" :tab="currentTab" />
        </div>
    </div>
</template>

<script>
export default {
    name: "tab-component",
    data: function() {
        return {
            tabs: [
                {
                    id: "1",
                    name: "all-users",
                    link: "ajax/user/all/"
                },
                {
                    id: "2",
                    name: "follower",
                    link: "ajax/user/follower/"
                },
                {
                    id: "3",
                    name: "thanks",
                    link: "ajax/user/thanks/"
                },
                {
                    id: "4",
                    name: "post",
                    link: "ajax/user/post/"
                },
                {
                    id: "5",
                    name: "new-registration",
                    link: "ajax/user/registration/"
                }
            ],
            currentTab: "all-users",
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
