<template>
    <div
        class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full"
    >
        <div
            class="relative top-20 mx-auto p-5 border lg:w-2/5 w-full shadow-lg rounded-md bg-white"
        >
            <!-- MODAL HEADER -->
            <div class="flex justify-between border-b mb-5">
                <h1></h1>
                <span
                    @click="closeConfirmationModal"
                    class="cursor-pointer rotate-45 text-3xl"
                    >+</span
                >
            </div>

            <!-- MODAL BODY -->
            <div class="mb-3">
                <div class="w-full">
                    <h1 class="text-sm text-red-500">Are you sure you want to delete this project from the database? This can`t be undone!</h1>
                </div>
                
            </div>

           

            <!-- MODAL FOOTER -->
            <div class="border-t pt-5 mt-5">
                <button
                    class="border rounded border-red-500 text-sm text-red-500 mr-2 px-3 py-2 hover:bg-red-500 hover:text-white transition duration-150 ease-in-out"
                    @click="deleteP"
                >
                    Yes, delete it!
                </button>
                <button
                    class="border rounded text-sm px-3 py-2 hover:bg-gray-300 transition duration-150 ease-in-out"
                    @click="closeConfirmationModal"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
    props: ["project"],
    methods: {
        ...mapActions(["deleteProject"]),
        closeConfirmationModal() {
            this.$emit("closeConfirmationModal");
        },
        deleteP(){
            this.deleteProject(this.project.id)
            this.$emit("closeConfirmationModal");
        }
        
    },
    
};
</script>

