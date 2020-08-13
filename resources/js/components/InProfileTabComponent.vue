<template>
    <div class="profile_tabs">
        <div class="tabs_wrap">
            <ul class="tabs">
                <li class="posts" id="tab" @click="postActive()" :class="{ active: post_Active }">POST</li>
                <li class="scouts" id="tab" @click="scoutActive()" :class="{ active: scout_Active }">SCOUT</li>
            </ul>
        </div>
        <div class="contents">
            <posts-component class="posts_content" :class="{ active: post_Active }" :userID="this.$userId"/>
            <user-scouts-component class="scouts_content" :class="{ active: scout_Active }" />
        </div>
    </div>
</template>

<script>
export default {
    name: "profile-tab-component",
    data: function() {
        return {
            post_Active: true,
            scout_Active: false
        };
    },
    methods: {
        postActive() {
            this.post_Active = true;
            this.scout_Active = false;
        },
        scoutActive() {
            this.post_Active = false;
            this.scout_Active = true;
        }
    },
    mounted() {}
};
</script>
