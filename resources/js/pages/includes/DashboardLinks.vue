<template>
    <div>
        <div class="text-sm flex md:flex-row flex-col">
            <router-link
                to="/projects"
                active-class="border rounded border-blue-900"
                class="md:ml-12 px-5 py-3"
                @click="closeMenu"
                >Projects</router-link
            >
             <router-link
                v-if="user.role.name === 'CEO' || user.role.name === 'Project Manager'"
                to="/developers"
                class="md:ml-12 px-5 py-3"
                active-class="border rounded border-blue-900"
                @click="closeMenu"
                >Developers</router-link
            >
            <router-link
                to="/to-do"
                active-class="border rounded border-blue-900"
                class="md:ml-12 px-5 py-3"
                @click="closeMenu"
                >To Do`s</router-link
            >
            <router-link
                to="/notes"
                active-class="border rounded border-blue-900"
                class="md:ml-12 px-5 py-3"
                @click="closeMenu"
                >Notes</router-link
            >
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    methods: {
        closeMenu() {
            this.$emit("closeMenu");
        },
    },
    computed: {
        ...mapState(["user"]),
    },
};
</script>

<style></style>