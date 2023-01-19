<template>
    <div class="md:flex gap-5 p-5">
        <Transition>
            <NewTeamMemberModal
                v-if="showModal"
                @closeModal="closeModal"
                :project="project"
            />
        </Transition>
        <Transition>
            <ConfirmProjectDeleteModal
                v-if="showConfirmationModal"
                @closeConfirmationModal="closeConfirmationModal"
                :project="project"
            />
        </Transition>
        <div class="w-full md:w-2/4">
            <div v-if="project">
                <h2 class="font-semibold text-gray-800 mb-5">
                    Project Name:
                    <span class="text-2xl">{{ project.name }}</span>
                </h2>
                <div
                    v-if="user.role_id == 1"
                    class="mb-5 w-full border border-red-500 text-red-500 py-2 rounded text-center cursor-pointer"
                    @click="openConfirmationModal"
                >
                    Delete Project
                </div>
                <div class="flex gap-10 mb-5">
                    <div>
                        <h2 class="font-semibold text-gray-800 mb-5">
                            Start Date:
                        </h2>
                        <span>{{ project.start_date }}</span>
                    </div>
                    <div class="border border-red-500 px-5 rounded">
                        <h2 class="font-semibold text-gray-800 mb-5">
                            Dead Line:
                        </h2>
                        <span>{{ project.end_date }}</span>
                    </div>
                </div>
                <div class="border shadow-md p-3 mb-5 bg-white rounded">
                    <h3 class="font-semibold mb-3">Assigned Team:</h3>
                    <ul class="mb-12">
                        <li
                            v-for="developer in assignedDevelopers"
                            :key="developer.id"
                        >
                            <span v-if="developer.role_id != 1"
                                >{{ developer.name }} -
                            </span>
                            <span v-if="developer.role_id === 2"
                                >Project Manager</span
                            ><span v-else-if="developer.role_id === 3"
                                >Developer</span
                            >
                        </li>
                    </ul>
                    <button
                        v-if="user.role_id == 2 || user.role_id == 1"
                        class="py-2 px-3 bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out text-white text-sm rounded"
                        @click="openModal"
                    >
                        Assign Team Member
                    </button>
                </div>
                <div
                    class="border border-gray-300 rounded p-3 bg-white mb-5 lg:mb-0"
                >
                    <div class="flex justify-between">
                        <h2 class="font-semibold text-gray-800 mb-5">
                            Project Description
                        </h2>
                        <i
                            @click="showDescription = !showDescription"
                            class="fa-solid fa-ellipsis cursor-pointer"
                        ></i>
                    </div>
                    <p
                        v-if="showDescription"
                        class="transition duration-150 ease-in-out"
                    >
                        {{ project.description }}
                    </p>
                </div>
            </div>
            <div v-else class="text-center">
                Sorry, we couldn't find the project you are looking for.
            </div>
        </div>
        <div class="w-full md:w-2/4 lg:border-l lg:pl-5 lg:border-gray-300">
            <Tickets :tickets="project.tickets" />
        </div>
    </div>
</template>

<script>
import Tickets from "../../../components/Tickets.vue";
import NewTeamMemberModal from "../../../components/NewTeamMemberModal.vue";
import ConfirmProjectDeleteModal from "../../../components/ConfirmProjectDeleteModal.vue";

import { mapState, mapActions } from "vuex";
export default {
    components: {
        Tickets,
        NewTeamMemberModal,
        ConfirmProjectDeleteModal,
    },
    data() {
        return {
            project: {},
            showDescription: false,
            showModal: false,
            showConfirmationModal: false,
        };
    },
    computed: {
        ...mapState(["user", "assignedDevelopers", "allProjects"]),
    },
    methods: {
        ...mapActions(["getDevelopers", "deleteProject"]),
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
        deleteP() {
            this.deleteProject(this.project.id);
        },
    },
    mounted() {
        this.project = this.allProjects.find(
            (project) => project.id == this.$route.params.id
        );
        this.getDevelopers(this.project.id);
    },
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
