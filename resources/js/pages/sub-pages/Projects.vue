<template>
    <div class="p-5 min-h-[calc(100%_-_10rem)]">
        <Transition>
        <NewProjectModal
             v-if="showModal"
             @closeModal="closeModal"
        />
        </Transition>

        <div class="lg:flex items-center justify-between pb-4 bg-white p-3 mb-5">
                    <input
                        type="text"
                        v-model="search"
                        id="table-search-users"
                        class="block p-2 pl-10 lg:w-80 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 lg:mb-0 mb-3"
                        placeholder="Search for projects"
                    />

                    <button v-if="user.role_id == 1"
                        class="py-2 px-3 bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out text-white text-sm rounded w-full lg:w-auto"
                         @click="openModal"
                    >
                        Create new project
                    </button>
            </div>
            <div v-if="user.role_id == 1" class="lg:grid lg:grid-cols-3 lg:gap-5 md:grid md:grid-cols-2 md:gap-3">
                <div v-for="project in filtered" :key="project.id" class="flex items-stretch w-full">
                    <div class="w-full p-6 rounded shadow bg-white hover:bg-gray-100 max-w-sm lg:mb-0 mb-3">
                        <h5 class="text-gray-900 leading-tight font-medium mb-5">{{ project.name.toUpperCase() }}</h5>
                        <router-link
                            :to="{ name: 'project', params: { id:project.id} }" 
                            active-class="border rounded border-blue-900"
                            class="text-lg font-semibold mb-2"
                            >
                                <button type="button" class="mt-auto inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Details
                                </button>
                        </router-link>
                        
                    </div>
                </div>
            </div>

            <div v-else-if="user.projects.length" class="lg:grid lg:grid-cols-3 lg:gap-5">
                <div v-for="project in filteredToUser" :key="project.id" class="flex justify-center w-full">
                    <div class="block p-6 rounded-lg shadow-lg bg-white w-full">
                        <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">{{ project.name.toUpperCase() }}</h5>
                        <p class="text-gray-700 text-base mb-4">
                        {{ project.description.substring(0,50) + '...' }}
                        </p>

                        <router-link
                            :to="{ name: 'project', params: { id:project.id} }" 
                            active-class="border rounded border-blue-900"
                            class="text-lg font-semibold mb-2"
                            >
                                <button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Details</button>
                            </router-link>
                        
                    </div>
                </div>
            </div>
            
            <div v-else>
                You are not assigned to any projects at this time. Contact your Project Manager.
            </div>
        
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import NewProjectModal from "../../components/NewProjectModal.vue";

export default {
    components: {
        NewProjectModal,
    },
    data(){
        return{
        showModal: false,
        search: '',
        }
    },
        methods: {
        ...mapActions(["getAllUsers", "getProjects", "getLoggedUser"]),

        openModal(){
            this.showModal = true;
        },
        closeModal(){
            this.showModal = false;
        },
    },

    computed: {
        ...mapState(["user", "projects", "allProjects"]),
         filtered(){
            return this.allProjects.filter((project) => project.name.toString().toLowerCase().includes(this.search.toLowerCase()))
        },

        filteredToUser(){
            return this.user.projects.filter((project) => project.name.toString().toLowerCase().includes(this.search.toLowerCase()))
        }
    },

    created(){
        this.getLoggedUser()
        this.getProjects()
    }
};
</script>

<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.2s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
