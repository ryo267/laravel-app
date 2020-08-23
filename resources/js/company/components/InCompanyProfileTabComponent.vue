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
            <infos-component id="content" :class="[isActive === 0 ? 'active' : '']" :companyID="this.$userId" :call="'profile'"/>
            <company-scouts-component id="content" :class="[isActive === 1 ? 'active' : '']" />
            <company-applicants-component id="content" :class="[isActive === 2 ? 'active' : '']" />
        </div>
    </div>
</template>

<script>
export default {
    name: "in-company-profile-tab-component",
    data: function() {
        return {
            currentTab: [
                {
                    id: 0,
                    name: '投稿',
                },
                {
                    id: 1,
                    name: 'スカウト',
                },
                {
                    id: 2,
                    name: '応募',
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
        },
    },
    mounted() {}
};
</script>
