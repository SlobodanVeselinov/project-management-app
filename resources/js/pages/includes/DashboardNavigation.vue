<template>
    <div
        class="flex-col bg-white border-r border-gray-300 min-h-screen md:flex"
        :class="[menu ? 'hidden' : 'flex']"
    >
        <div class="flex flex-col items-center mt-6">
            <img
                class="object-cover w-24 h-24 mx-2 rounded-full"
                src="https://ui-avatars.com/api/?name=John+Doe"
                alt="avatar"
            />
            <h4
                v-if="user"
                class="mx-2 mt-2 text-lg font-semibold text-gray-800 dark:text-gray-200 hover:underline"
            >
                {{ user.name }}
            </h4>
            <p class="text-sm">({{ user.role.name }})</p>
            <p
                v-if="user"
                class="mx-2 mt-1 text-sm font-medium text-gray-600 dark:text-gray-400 hover:underline"
            >
                {{ user.email }}
            </p>
        </div>

        <nav class="mt-6">
            <router-link
                to="/projects"
                active-class="bg-gray-200"
                @click="
                    closeMenu();
                    toggleMenu();
                "
                class="flex text-sm items-center px-4 py-2 text-gray-600 transition-colors duration-300 transform hover:bg-gray-200 hover:text-gray-700"
            >
                <svg
                    class="w-5 h-5 mr-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                Projects
            </router-link>

            <router-link
                v-if="user.role.name === 'CEO'"
                class="flex text-sm items-center px-4 py-2 text-gray-600 transition-colors duration-300 transform hover:bg-gray-200 hover:text-gray-700"
                to="/developers"
                active-class="bg-gray-200"
                @click="
                    closeMenu();
                    toggleMenu();
                "
            >
                <svg
                    class="w-5 h-5 mr-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                Developers
            </router-link>

            <router-link
                class="flex text-sm items-center px-4 py-2 text-gray-600 transition-colors duration-300 transform hover:bg-gray-200 hover:text-gray-700"
                to="/to-do"
                active-class="bg-gray-200"
                @click="
                    closeMenu();
                    toggleMenu();
                "
            >
                <svg
                    class="w-5 h-5 mr-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                To Do`s`
            </router-link>

            <router-link
                class="flex text-sm items-center px-4 py-2 text-gray-600 transition-colors duration-300 transform hover:bg-gray-200 hover:text-gray-700"
                to="/notes"
                active-class="bg-gray-200"
                @click="
                    closeMenu();
                    toggleMenu();
                "
            >
                <svg
                    class="w-5 h-5 mr-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                Notes
            </router-link>
        </nav>
    </div>
</template>

<script>
import DashboardLinks from "./DashboardLinks.vue";
import { mapState, mapActions } from "vuex";
export default {
    data() {
        return {
            activeLinks: false,
        };
    },
    methods: {
        closeMenu() {
            this.activeLinks = false;
        },
        ...mapActions([
            "logout",
            "getLoggedUser",
            "toggleMenu",
            "getNotifications",
        ]),
    },
    components: {
        DashboardLinks,
    },
    computed: {
        ...mapState(["user", "menu"]),
    },
    mounted() {
        this.getLoggedUser();
        this.getNotifications();
    },
};
</script>

<style></style>
