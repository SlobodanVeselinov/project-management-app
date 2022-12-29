<template>
    <div
        class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full"
    >
        <div
            class="relative top-20 mx-auto p-5 border lg:w-2/6 w-full shadow-lg rounded-md bg-white"
        >
            <!-- MODAL HEADER -->
            <div class="flex justify-between border-b mb-5">
                <h1>Assign Developer</h1>
                <span
                    @click="closeModal"
                    class="cursor-pointer rotate-45 text-3xl"
                    >+</span
                >
            </div>

            <!-- MODAL BODY -->
            <div class="mb-3">
                <div class="mb-5">
                    From the list below, choose the developer who you are
                    assigning to this ticket:
                </div>
                <div class="w-full">
                    <select 
                        v-model="form.developer_id"
                        class="w-full">
                        <option 
                            v-for="user in allUsers"
                            :key="user.id" 
                            :value="user.id">
                                {{ user.name }} - {{ user.role.name }}</option>
                    </select>
                </div>
            </div>

            <!-- MODAL FOOTER -->
            <div class="border-t pt-5 mt-5">
                <button
                    class="border rounded text-sm text-white mr-2 px-3 py-2 bg-blue-500 hover:bg-blue-700 transition duration-150 ease-in-out"
                    @click="assignD"
                >
                    Save
                </button>
                <button
                    class="border rounded text-sm px-3 py-2 hover:bg-gray-300 transition duration-150 ease-in-out"
                    @click="closeModal"
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
    data() {
        return {
            form: {
                developer_id: "",
                ticket_id: this.$route.params.t_id,
            },
        };
    },
    methods: {
        ...mapActions(["assignDeveloper"]),
        closeModal() {
            this.$emit("closeModal");
        },
        assignD() {
            this.assignDeveloper(this.form);
            this.closeModal();
        },
    },
    computed: {
        ...mapState(["allUsers"]),
    },
};
</script>
