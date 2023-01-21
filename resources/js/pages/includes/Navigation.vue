<template>
    <div class="w-full bg-gray-900 text-gray-100 py-5 sticky top-0">
        <div class="max-w-screen-xl px-5 mx-auto flex justify-between items-center">
            <div class="text-lg font-bold text-gray-100 flex items-center">
                <span 
                    class="md:hidden pr-5 cursor-pointer"
                    @click="toggleM">
                    <i class="fa-solid fa-bars"></i>
                </span>
                <span class="pr-2 lg:ml-0 ml-3">
                    <i class="fa-solid fa-bug text-3xl"></i>
                </span>
                <span class="hidden lg:flex">Project Management</span>
                <div class="text-sm font-normal ml-12">
                    <router-link class="mr-3" to="/">Home</router-link>
                    <router-link v-if="isLoggedIn" class="mr-3" to="/dashboard"
                        >Dashboard</router-link
                    >
                </div>
            </div>
            <div>
                <div v-if="isLoggedIn">
                    <span class="text-sm sm:visible invisible">Logout</span>
                    <span class="mr-3 ml-5 text-sm font-normal" @click="logout">
                        <i
                            class="fa-solid fa-arrow-right-from-bracket cursor-pointer"
                        ></i>
                    </span>
                </div>
                <!-- <button @click="logout">logout</button> -->
                <div v-if="!isLoggedIn">
                    <router-link class="mr-3 text-sm font-normal" to="/login"
                        >LogIn</router-link
                    >
                    <router-link class="mr-3 text-sm font-normal" to="/register"
                        >Register</router-link
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
    computed: {
        ...mapState(["isLoggedIn"]),
    },
    methods: {
        ...mapActions(["logout", "toggleMenu"]),

        toggleM(){
            this.toggleMenu()
        }
    },
};
</script>

<style></style>