<template>
		<AssignDeveloperToTicketModal 
			v-if="showModal" 
			@closeModal="closeModal" 
        />
	<div class="p-5">
		<div class="p-5 w-full bg-white mb-5 flex justify-between">
			<h3 class="font-semibold">Ticket Details</h3>
			<button v-if="user.role_id == 1 || user.role_id == 2"
                        class="py-2 px-3 bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out text-white text-sm rounded w-full lg:w-auto"
                         @click="openModal"
                    >
                        Assign developer to this ticket
                    </button>
		</div>

		<div class="lg:grid grid-cols-2 gap-5">
			<div class="p-5 w-full bg-white mb-5">
				<h3 class="text-sm font-bold border-b mb-3">{{ ticket.title.toUpperCase() }}</h3>

				<p>{{ ticket.description }}</p>
			</div>

			<div class="p-5 w-full bg-white mb-5">
				<h3 class="text-sm font-bold border-b mb-3">Who is this thicket assigned to?</h3>

				<p 
					v-if="projectManager"
					class="font-semibold mb-8">Project manager: {{ projectManager.name }}
				</p>
				<p 
					v-else
					class="text-sm text-red-600 mb-8">
					No Project Manager is assigned to this project.
				</p>
				<p class="font-semibold border-b mb-3">Developers:</p>
				<div 
					v-if="!developers"
					class="text-sm text-red-600">
					No developers are assigned to this ticket!
				</div>
				<ul v-for="developer in ticket.users" :key="developer.id">
					<li v-if="developer.role_id !== 2 && developer.role_id !== 1">
						{{ developer.name }} 
						<span 
							v-if="user.role_id !== 3"
							@click="removeDeveloper(developer.id)"
							class="text-sm text-red-600 cursor-pointer">
							- Remove
						</span>
					</li>
				</ul>
			</div>
		</div>

		<div class="p-5 w-full bg-white mb-5">
			<h3 class="font-semibold border-b mb-5 text-gray-500 text-sm">Conversation:</h3>
			<div
				v-if="notes.length" 
				class="my-5 max-h-72 overflow-scroll">
				<div 
					v-for="note in notes" 
					:key="note.id"
				>
					<div class="border-b py-3">
						<span class="text-sm text-gray-500">{{ note.created_at }}</span>
						<p><span class="text-blue-700 text-sm">{{ note.user.name }}:</span> {{ note.note }}</p>
					</div>
				</div>
				
						
			</div>
			<div v-else>
				<p class="mb-5 text-sm text-red-600">No conversation for this ticket yet!</p>
			</div>
			<input 
					type="text"
					v-model="note.text"
					class="w-full mb-5 border-gray-400 rounded"
				>
				<button 
					class="px-3 py-2 bg-blue-800 text-sm text-gray-100 rounded"
					@click="saveN"
					>
					
						Send
				</button>	
		</div>

	</div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import AssignDeveloperToTicketModal from '../../components/AssignDeveloperToTicketModal.vue';
export default {
	components: {
		AssignDeveloperToTicketModal,
	},
	data(){
		return {
			showModal: false,
			projectManager: '',
			form: {
                developer_id: "",
                ticket_id: this.$route.params.t_id,
            },

			note: {
				text: "",
				ticket_id: this.$route.params.t_id
			}
		}
	},
    methods: {
        ...mapActions(["getTicketWithDetails", "removeDeveloperFromTicket", "createNote"]),
		removeDeveloper(id){
			this.form.developer_id = id
			this.removeDeveloperFromTicket(this.form)
		},
		 openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },

		saveN(){
			this.createNote(this.note)
			this.note.text = "";
		}
    },

    computed: {
        ...mapState(["ticket", "notes", "loading", "user", "assignedDevelopers"]),
		developers(){
			return this.ticket.users.find(d => d.role_id == 3)
		},
    },

    mounted() {
        this.getTicketWithDetails(this.$route.params.t_id);
		this.projectManager = this.assignedDevelopers.find(u => u.role_id == 2)
    },
};
</script>

<style></style>
