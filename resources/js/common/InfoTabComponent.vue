<template>
    <div class="container-fluid">
        <div class="overflow-auto info_tabs">
            <ul class="d-flex align-items-center m-0">
                <li class="search_form">
                    <form @submit.prevent="search">
                        <input
                            type="text"
                            class="form"
                            id="info_search_form"
                            placeholder="search"
                            v-model="searchTab"
                        />
                        <button class="search_button" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </li>
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
            <infos-component :key="currentTab" :tab="currentTab" />
        </div>
    </div>
</template>

<script>
export default {
    name: "user-tab-component",
    data: function() {
        return {
            tabs: [
                {
                    id: "1",
                    name: "all-info",
                },
                {
                    id: "2",
                    name: "new",
                }
            ],
            currentTab: "",
            searchTab: "",
            isActive: ""
        };
    },
    filters: {
        uppercase(value) {
            return value.toUpperCase();
        }
    },
    methods: {
        search() {
            this.currentTab = this.searchTab;
        },
        activeTab(tab_name, tab_id) {
            this.currentTab = tab_name;
            this.isActive = tab_id;
        }
    },
    mounted() {}
};
</script>
