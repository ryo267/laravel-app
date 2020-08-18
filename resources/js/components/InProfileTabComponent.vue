<template>
    <div class="profile_tabs">
        <div class="tabs_wrap">
            <ul class="tabs">
                <li
                    v-for="tab in currentTab"
                    :key="tab.id"
                    class=""
                    id="tab"
                    @click="activeTab(tab.id)"
                    :class="[isActive === tab.id ? 'active' : '']"
                >
                    {{ tab.name | uppercase }}
                </li>
            </ul>
        </div>
        <div class="contents">
            <posts-component id="content" :class="[isActive === 0 ? 'active' : '']" :userID="this.$userId"/>
            <user-scouts-component id="content" :class="[isActive === 1 ? 'active' : '']" />
            <user-applies-component id="content" :class="[isActive === 2 ? 'active' : '']" />
        </div>
    </div>
</template>

<script>
export default {
    name: "profile-tab-component",
    data: function() {
        return {
            currentTab: [
                {
                    id: 0,
                    name: 'posts',
                },
                {
                    id: 1,
                    name: 'scouts',
                },
                {
                    id: 2,
                    name: 'applies',
                }
            ],
            isActive: 0,
        };
    },
    filters: {
        uppercase(value) {
            return value.toUpperCase();
        }
    },
    methods: {
        activeTab(tab_id) {
            this.isActive = tab_id;
        }
    },
    mounted() {}
};
</script>
