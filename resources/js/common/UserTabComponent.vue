<template>
    <div>
        <div class="mx-3">
            <button class="post_active_btn" @click="$emit('parent')">
                <i class="fas fa-angle-double-left mr-3"></i>POST
            </button>
        </div>
        <div class="overflow-auto user_tabs">
            <ul class="d-flex align-items-center m-0">
                <li class="search_form">
                    <form @submit.prevent="search">
                        <input
                            type="text"
                            class="form"
                            id="user_search_form"
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
                    {{ tab.display }}
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
    name: "user-tab-component",
    data: function() {
        return {
            tabs: [
                {
                    id: "1",
                    name: "all-users",
                    display: "全てのユーザー"
                },
                {
                    id: "2",
                    name: "follower",
                    display: "フォロワー数"
                },
                {
                    id: "3",
                    name: "thanks",
                    display: "いいね"
                },
                {
                    id: "4",
                    name: "post",
                    display: "投稿数"
                },
                {
                    id: "5",
                    name: "new",
                    display: "新着ユーザー"
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
