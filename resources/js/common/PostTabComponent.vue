<template>
    <div>
        <div class="text-right mx-3">
            <button class="user_active_btn" @click="$emit('panret')">
                USER<i class="fas fa-angle-double-right ml-3"></i>
            </button>
        </div>
        <div class="overflow-auto post_tags">
            <ul class="d-flex align-items-center m-0">
                <li
                    @click="activeTag('all_posts', 0)"
                    id="tags"
                    :class="[isActive === 0 ? 'active' : '']"
                >
                    All-POST
                </li>
                <li
                    v-for="tag in tags"
                    :key="tag.id"
                    class="px-3"
                    id="tags"
                    @click="activeTag(tag.name, tag.id)"
                    :class="[isActive === tag.id ? 'active' : '']"
                >
                    {{ tag.name }}
                </li>
            </ul>
        </div>
        <div class="contents">
            <posts-component :key="currentTag" :post_tag="currentTag" />
        </div>
    </div>
</template>

<script>
export default {
    name: "post-tab-component",
    data: function() {
        return {
            tags: [],
            currentTag: "all_posts",
            isActive: 0
        };
    },
    methods: {
        activeTag(tag_name, tag_id) {
            this.currentTag = tag_name;
            this.isActive = tag_id;
        },
        getTags() {
            try {
                const url = "/ajax/tag";
                //console.log("getTags");

                axios.get(url).then(response => {
                    this.tags = response.data;
                });
            } catch (error) {
                console.log(error);
            }
        },
        isset(data) {
            return typeof data != "undefined";
        },
        empty(data) {
            return data.length != 0;
        }
    },
    mounted() {
        this.getTags();

        Echo.channel("post").listen("PostCreated", e => {
            //console.log("PostCreated");
            /*this.getProfile();*/
            this.getTags();
        });
    }
};
</script>
