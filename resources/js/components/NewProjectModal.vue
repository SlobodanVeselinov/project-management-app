<template>
    <div
        class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full"
    >
        <div
            class="relative top-20 mx-auto p-5 border lg:w-2/6 w-full shadow-lg rounded-md bg-white"
        >
            <!-- MODAL HEADER -->
            <div class="flex justify-between border-b mb-5">
                <h1>New Project</h1>
                <span
                    @click="closeModal"
                    class="cursor-pointer rotate-45 text-3xl"
                    >+</span
                >
            </div>

            <!-- MODAL BODY -->
            <div class="lg:flex gap-5 mb-3">
                <div class="lg:pr-5 lg:w-1/4 w-full">
                    <h1 class="font-bold text-sm text-gray-700">Project Name:</h1>
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
                    <h1 class="font-bold text-sm text-gray-700">Description:</h1>
                </div>
                <div class="lg:pr-5 lg:w-3/4 w-full">
                    <textarea
                        class="border rounded border-gray-300 p-1 w-full h-48"
                        v-model="form.description"
                    />
                </div>
            </div>

            <div class="lg:flex gap-5 mb-3">
                <div class="lg:pr-5 lg:w-1/4 w-full">
                    <h1 class="font-bold text-sm text-gray-700">Start date:</h1>
                </div>
                <div class="lg:pr-5 lg:w-3/4 w-full">
                    <input
                        type="date"
                        class="border rounded border-gray-300 p-1 w-full text-sm"
                        v-model="form.start_date"
                    />
                </div>
            </div>

            <div class="lg:flex gap-5 mb-3">
                <div class="lg:pr-5 lg:w-1/4 w-full">
                    <h1 class="font-bold text-sm text-gray-700">End Date:</h1>
                </div>
                <div class="lg:pr-5 lg:w-3/4 w-full">
                    <input
                        type="date"
                        class="border rounded border-gray-300 p-1 w-full text-sm"
                        v-model="form.end_date"
                    />
                </div>
            </div>

            <!-- MODAL FOOTER -->
            <div class="border-t pt-5 mt-5">
                <button
                    class="border rounded text-sm text-white mr-2 px-3 py-2 bg-blue-500 hover:bg-blue-700 transition duration-150 ease-in-out"
                    @click="createP"
                >
                    Create
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
    props: ["developer"],
    data(){
        return {
            form: {
                name:'',
                description:'',
                start_date:'',
                end_date:'',
            }
        }
    },
    methods: {
        ...mapActions(["createProject"]),
        closeModal() {
            this.$emit("closeModal");
        },
        createP(){
            this.createProject(this.form)
            this.closeModal()
        }
    },
    computed: {
        ...mapState(["roles"]),
    },
};
</script>

