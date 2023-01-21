<template>
    <div class="lg:p-5">
        <Transition>
            <DeveloperDetailsModal
                v-if="showModal"
                @closeModal="closeModal"
                :developer="this.developer"
            />
        </Transition>
        <Transition>
            <ConfirmUserDeleteModal
             v-if="showConfirmationModal"
             @closeConfirmationModal="closeConfirmationModal"
             :developer="this.developer"
        />
        </Transition>
        <Transition>
            <AddDeveloperModal
             v-if="showDeveloperModal"
             @closeDeveloperModal="closeDeveloperModal"
        />
        </Transition>

        <div 
            v-if="loading"
            class="w-full text-center"
            >Loading...
        </div>

        <div v-else class="shadow-md sm:rounded-lg w-full">
            <div class="lg:flex items-center justify-between pb-4 bg-white lg:p-3 p-5">
                    <input
                        type="text"
                        v-model="search"
                        id="table-search-users"
                        class="block p-2 pl-10 mb-5 lg:mb-0 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for developers"
                    />

                    <button v-if="user.role_id == 1"
                        class="py-2 px-3 bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out text-white text-sm rounded w-full lg:max-w-fit"
                        @click="openDeveloperModal"
                    >
                        Add Developer
                    </button>
            </div>
            <div class="overflow-x-scroll">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700"
                >
                    <tr>
                        <th scope="col" class="py-3 px-6">Name</th>
                        <th scope="col" class="py-3 px-6">Role</th>
                        <th scope="col" class="py-3 px-6">Status</th>
                        <th scope="col" class="py-3 px-6">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="developer in filtered"
                        :key="developer.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                    >
                        <th
                            scope="row"
                            class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            <img
                                class="w-10 h-10 rounded-full"
                                src="https://picsum.photos/200"
                                alt="Jese image"
                            />
                            <div class="pl-3">
                                <div class="text-base font-semibold">
                                    {{ developer.name }}
                                </div>
                                <div class="font-normal text-gray-500">
                                    {{ developer.email }}
                                </div>
                            </div>
                        </th>
                        <td class="py-4 px-6">{{ developer.role.name }}</td>
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <div
                                    class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"
                                ></div>
                                Online
                            </div>
                        </td>
                        <td class="py-4 px-6 flex flex-col">
                            <a
                                href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                @click="setDeveloper(developer)"
                                >Edit user</a
                            >
                            <a
                                href="#"
                                class="font-medium text-red-600 hover:underline"
                                @click="setDeveloperForDelete(developer)"
                                >Delete user</a
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import DeveloperDetailsModal from "../../components/DeveloperDetailsModal.vue";
import ConfirmUserDeleteModal from "../../components/ConfirmUserDeleteModal.vue";
import AddDeveloperModal from "../../components/AddDeveloperModal.vue";


export default {
    components: {
        DeveloperDetailsModal,
        ConfirmUserDeleteModal,
        AddDeveloperModal
    },
    data() {
        return {
            developer: {},
            showModal: false,
            showConfirmationModal: false,
            showDeveloperModal: false,
            search: '',
        };
    },
    computed: {
        ...mapState(["allUsers", "user", "loading"]),
        filtered(){
            return this.allUsers.filter((user) => user.name.toString().toLowerCase().includes(this.search.toLowerCase()))
        }
    },
    methods: {
        ...mapActions(["getAllUsers"]),

        setDeveloper(developer) {
            this.developer = developer;
            this.openModal();
        },

        setDeveloperForDelete(developer) {
            this.developer = developer;
            this.openConfirmationModal();
        },

        openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        openConfirmationModal() {
            this.showConfirmationModal = true;
        },
        closeConfirmationModal() {
            this.showConfirmationModal = false;
        },
        openDeveloperModal() {
            this.showDeveloperModal = true;
        },
        closeDeveloperModal() {
            this.showDeveloperModal = false;
        },
    },

    created() {
        this.getAllUsers();
    },
};
</script>

<style>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.1s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
