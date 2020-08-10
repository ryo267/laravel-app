<template>
    <div class="all_tabs">
        <ul class="tabs" >
            <li class="post" :class="{ active: post_Active }"><post-tab-component v-on:panret="userActive"/></li>
            <li class="user" :class="{ active: user_Active }"><user-tab-component v-on:panret="postActive"/></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "all-tab-component",
    data: function() {
        return {
            post_Active: true,
            user_Active: false,
        };
    },
    methods: {
        postActive() {
            this.post_Active = true;
            this.user_Active = false;
        },
        userActive() {
            this.post_Active = false;
            this.user_Active = true;
        }
    },
    mounted() {}
};
</script>
