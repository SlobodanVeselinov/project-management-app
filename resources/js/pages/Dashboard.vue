<template>
    <div class="md:flex">
        <div class="w-full md:w-2/12">
            <DashboardNavigation />
        </div>
        <div class="bg-gray-200 w-full">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import DashboardNavigation from "./includes/DashboardNavigation.vue";

import { mapState, mapActions } from "vuex";
export default {
    components: {
        DashboardNavigation,
    },
    computed: {
        ...mapState(["user"]),
    },
    methods: {
        ...mapActions(["getLoggedUser","getSelectedProject"]),
    },
};
</script>

<style>
.slide-fade-enter-active {
    transition: all 0.1s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.1s cubic-bezier(1, 0.2, 0.2, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>