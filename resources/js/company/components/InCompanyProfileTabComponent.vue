<template>
    <div class="profile_tabs">
        <div class="tabs_wrap">
            <ul class="tabs">
                <li class="infos" id="tab" @click="infoActive()" :class="{ active: info_Active }">INFO</li>
                <li class="scouts" id="tab" @click="scoutActive()" :class="{ active: scout_Active }">SCOUT</li>
            </ul>
        </div>
        <div class="contents">
            <infos-component class="infos_content" :class="{ active: info_Active }" :companyID="this.$userId"/>
            <company-scouts-component class="scouts_content" :class="{ active: scout_Active }" />
        </div>
    </div>
</template>

<script>
export default {
    name: "profile-tab-component",
    data: function() {
        return {
            info_Active: true,
            scout_Active: false
        };
    },
    methods: {
        infoActive() {
            this.info_Active = true;
            this.scout_Active = false;
        },
        scoutActive() {
            this.info_Active = false;
            this.scout_Active = true;
        }
    },
    mounted() {}
};
</script>
