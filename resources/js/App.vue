<template>
    <div class="bg-gray-200 min-h-screen">
        <Navigation />

        <div class="max-w-screen-xl mx-auto">
            <router-view v-slot="slotProps">
                <transition name="slide-fade" mode="out-in">
                    <component :is="slotProps.Component"></component>
                </transition>
            </router-view>
        </div>

        <Footer />
    </div>
</template>

<script>
import Navigation from "./pages/includes/Navigation.vue";
import Footer from "./pages/includes/Footer.vue";

export default {
    components: {
        Navigation,
        Footer,
    },
};
</script>

<style>
.slide-fade-enter-active {
    transition: all 0.2s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
