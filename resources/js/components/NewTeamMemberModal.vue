<template>
    <div
        class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full"
    >
        <div
            class="relative top-20 mx-auto p-5 border lg:w-2/4 w-full shadow-lg rounded-md bg-white"
        >
            <!-- MODAL HEADER -->
            <div class="flex justify-between border-b mb-5">
                <h1>Assign new team member</h1>
                <span
                    @click="closeModal"
                    class="cursor-pointer rotate-45 text-3xl"
                    >+</span
                >
            </div>

            <!-- MODAL BODY -->
            <div class="lg:flex gap-5">
              <div class="lg:border-r lg:pr-5">
                <h1 class="font-bold text-gray-700">Project name: {{ project.name.toUpperCase() }}</h1>
                <h3 class="mt-3 mb-3 underline text-gray-700">Who`s working on this project:</h3>
                  <ul>
                      <li
                          v-for="developer in assignedDevelopers"
                          :key="developer.id"
                          class="text-gray-700"
                      >
                          {{ developer.name }} ({{ developer.role_id == 2 ? "Project Menager" : "Developer"  }}) <span v-if="user.id != developer.id" class="cursor-pointer text-sm text-red-500" @click="removeDeveloper(developer.id)"> - Remove from team</span>
                      </li>
                  </ul>
              </div>
              <div>
                <h3 class="mt-12 lg:mt-0 mb-5 underline">Availabe developers:</h3>
                <ul>
                      <li
                          v-for="freeDeveloper in freeDevelopers"
                          :key="freeDeveloper.id"
                          class="text-gray-700"
                      >
                          <div v-if="freeDeveloper.role_id !== 1">
                            {{ freeDeveloper.name }} ({{ freeDeveloper.role_id == 2 ? "Project Menager" : "Developer"  }})
                            <span class="cursor-pointer text-sm text-blue-500" @click="addPayload(freeDeveloper.id)"> - Add to team</span>
                          </div> 
                          
                      </li>
                  </ul>
              </div>
            </div>

            <!-- MODAL FOOTER -->
            <div class="border-t pt-5 mt-5">
                <button
                    class="border rounded text-sm px-3 py-2 hover:bg-gray-300 transition duration-150 ease-in-out"
                    @click="closeModal"
                >
                    OK
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  props: [
    'project'
  ],
  data(){
    return {
        payload: {
            project_id: this.project.id,
            developer_id: null
        }
    }
  },
    methods: {
        ...mapActions(["getAllDevelopers", "getFreeDevelopers", "addToTeam", "removeFromTeam"]),
        closeModal() {
            this.$emit("closeModal");
        },
        addPayload(id){
            this.payload.developer_id = id;
            this.addToTeam(this.payload)
        },
        removeDeveloper(id){
            this.payload.developer_id = id;
            this.removeFromTeam(this.payload)
        },
     

    },
    computed: {
        ...mapState(["user","developers", "assignedDevelopers", "freeDevelopers"]),
    },
    mounted() {
        this.getAllDevelopers();
        this.getFreeDevelopers(this.project.id);
    },
};
</script>

<style></style>
