<template>
    <div>
        <div class="overflow-auto all_tags">
            <ul class="d-flex align-items-center m-0">
                <li @click="activeTag('all_users',0)" id="tags" :class="[ isActive === 0 ? 'active' : '' ]">All-USERS</li>
                <li
                    v-for="tag in tags"
                    :key="tag.id"
                    class="px-3"
                    id="tags"
                    @click="activeTag(tag.name,tag.id)" :class="[ isActive === tag.id ? 'active' : '' ]"
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
    name: "tab-component",
    data: function() {
        return {
            tags:[
                {
                    id: '1',
                    name: 'FOLLOWER',
                    link: 'ajax/user/follower/desk'
                },
                {
                    id: '2',
                    name: 'THANKS',
                    link: 'ajax/user/follower/desk'
                },
                {
                    id: '3',
                    name: 'POST',
                    link: 'ajax/user/follower/desk'
                },
                {
                    id: '4',
                    name: 'REGISTRATION',
                    link: 'ajax/user/follower/desk'
                },
            ],
            currentTag: "all_users",
            isActive: 0
        };
    },
    methods: {
        activeTag( tag_name, tag_id){
            this.currentTag = tag_name;
            this.isActive = tag_id;
        },
    },
    mounted() {

    }
};
</script>
