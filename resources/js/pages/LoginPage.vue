<template>
    <section class="max-w-xl p-6 mx-auto bg-white rounded-md shadow-md">
        <h2 class="text-lg mb-5 font-semibold text-gray-700 capitalize">
            Log In
        </h2>
        <div v-if="errors" class="mb-5">
            <div v-for="field in errors" :key="field">
                <p v-for="error in field" :key="error" class="text-sm text-red-600">{{ error }}</p>
            </div>
        </div>
        <form>
            <div>
                <div>
                    <label class="text-gray-700" for="emailAddress"
                        >Email Address</label
                    >
                    <input
                        id="emailAddress"
                        type="email"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                        v-model="form.email"
                    />
                </div>

                <div>
                    <label
                        class="text-gray-700 dark:text-gray-200"
                        for="password"
                        >Password</label
                    >
                    <input
                        id="password"
                        type="password"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                        v-model="form.password"
                    />
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button
                    class="px-6 py-2 leading-5 text-sm text-white transition-colors duration-200 transform bg-blue-900 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600"
                    @click.prevent="loginUser(this.form)"
                >
                    Log in
                </button>
            </div>
        </form>
    </section>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data() {
        return {
            form: {},
        };
    },
    computed: {
        ...mapState(["errors"])
    },
    methods: {
        ...mapActions(['loginUser']),
    },
    // computed: {
    //     ...mapState(["errors"])
    // }
};
</script>

<style></style>
