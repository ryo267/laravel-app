<template>
    <div>
        <div class="text-right mx-3">
            <button class="user_active_btn" @click="$emit('panret')">
                USER<i class="fas fa-angle-double-right ml-3"></i>
            </button>
        </div>
        <div class="overflow-auto post_tags">
            <ul class="d-flex align-items-center m-0">
                <li class="search_form">
                    <form @submit.prevent="search">
                        <input
                            type="text"
                            class="form"
                            id="post_search_form"
                            placeholder="search"
                            v-model="searchTab"
                        />
                        <button class="search_button" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </li>
                <li
                    @click="activeTag('all-posts', 0)"
                    id="tags"
                    :class="[isActive === 0 ? 'active' : '']"
                >
                    全ての投稿
                </li>
                <li
                    v-for="tag in tags"
                    :key="tag.id"
                    class="px-3"
                    id="tags"
                    @click="activeTag(tag.name, tag.id)"
                    :class="[isActive === tag.id ? 'active' : '']"
                >
                    {{ tag.name }}<i class="fas fa-tag ml-2"></i>
                </li>
            </ul>
        </div>
        <div class="contents">
            <posts-component :key="currentTag" :post_tag="currentTag" :call="'tab'" />
        </div>
    </div>
</template>

<script>
export default {
    name: "post-tab-component",
    data: function() {
        return {
            tags: [],
            currentTag: "",
            searchTab: "",
            isActive: ""
        };
    },
    methods: {
        search() {
            this.currentTag = this.searchTab;
        },
        activeTag(tag_name, tag_id) {
            this.currentTag = tag_name;
            this.isActive = tag_id;
        },
        getTags() {
            try {
                const url = "/ajax/tag";
                
                axios.get(url).then(response => {
                    this.tags = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getTags();

        Echo.channel("post").listen("PostCreated", e => {
            this.getTags();
        });
    }
};
</script>
