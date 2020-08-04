<template>
    <div>
        <div class="overflow-auto all_tabs">
            <ul class="d-flex align-items-center m-0">
                <li @click="activeTab('all_users',0)" id="tags" :class="[ isActive === 0 ? 'active' : '' ]">All-USERS</li>
                <li
                    v-for="tab in tabs"
                    :key="tab.id"
                    class="px-3"
                    id="tabs"
                    @click="activeTab(tab.name,tab.id)" :class="[ isActive === tab.id ? 'active' : '' ]"
                >
                    {{ tab.name }}
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
            tabs:[
                {
                    id: '1',
                    name: 'FOLLOWER',
                    link: 'ajax/user/follower/desk'
                },
                {
                    id: '2',
                    name: 'THANKS',
                    link: 'ajax/user/thanks/desk'
                },
                {
                    id: '3',
                    name: 'POST',
                    link: 'ajax/user/post/desk'
                },
                {
                    id: '4',
                    name: 'REGISTRATION',
                    link: 'ajax/user/registration/desk'
                },
            ],
            currentTab: "all_users",
            isActive: 0
        };
    },
    methods: {
        activeTab( tab_name, tab_id){
            this.currentTab = tab_name;
            this.isActive = tab_id;
        },
    },
    mounted() {

    }
};
</script>
