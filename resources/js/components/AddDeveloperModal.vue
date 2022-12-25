<template>
    <div
        class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full"
    >
        <div
            class="relative top-20 mx-auto p-5 border lg:w-2/5 w-full shadow-lg rounded-md bg-white"
        >
            <!-- MODAL HEADER -->
            <div class="flex justify-between border-b mb-5">
                <h1>Register new developer / Project Manager</h1>
                <span
                    @click="closeDeveloperModal"
                    class="cursor-pointer rotate-45 text-3xl"
                    >+</span
                >
            </div>

            <!-- MODAL BODY -->
            <div class="lg:flex gap-5 mb-3">
                <div class="lg:pr-5 lg:w-1/4 w-full">
                    <h1 class="font-bold text-sm text-gray-700">Full Name:</h1>
                </div>
                <div class="lg:pr-5 lg:w-3/4  w-full">
                    <input
                        type="text"
                        class="border rounded border-gray-300 p-1 w-full"
                        v-model="form.name"
                    />
                </div>
            </div>

             <div class="lg:flex gap-5 mb-3">
                <div class="lg:pr-5 lg:w-1/4 w-full">
                    <h1 class="font-bold text-sm text-gray-700">Email adress:</h1>
                </div>
                <div class="lg:pr-5 lg:w-3/4  w-full">
                    <input
                        type="email"
                        class="border rounded border-gray-300 p-1 w-full"
                        v-model="form.email"
                    />
                </div>
            </div>

            <div class="lg:flex gap-5 mb-3">
                <div class="lg:pr-5 lg:w-1/4">
                    <h1 class="font-bold text-gray-700">Role:</h1>
                </div>
                <div class="lg:pr-5 w-3/4">
                    <select 
                        v-model="form.role_id"
                        class="border rounded border-gray-300 p-1 w-full">
                        <option 
                            class="text-sm"
                            v-for="role in roles"
                            :key="role.id" 
                            :value="role.id">
                                {{ role.name }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- MODAL FOOTER -->
            <div class="border-t pt-5 mt-5">
                <button
                    class="border rounded text-sm text-white mr-2 px-3 py-2 bg-blue-500 hover:bg-blue-700 transition duration-150 ease-in-out"
                    @click="saveUser"
                >
                    Save
                </button>
                <button
                    class="border rounded text-sm px-3 py-2 hover:bg-gray-300 transition duration-150 ease-in-out"
                    @click="closeDeveloperModal"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
    props: ["developer"],
    data(){
        return {
            form: {
                name:'',
                role_id:'',
                email:'',
            }
        }
    },
    methods: {
        ...mapActions(["getRoles", "createUser"]),
        closeDeveloperModal() {
            this.$emit("closeDeveloperModal");
        },

        saveUser(){
            this.createUser(this.form)
            this.$emit("closeDeveloperModal");
        }
    },
    computed: {
        ...mapState(["roles"]),
    },
    created(){
        this.getRoles
    }
};
</script>

