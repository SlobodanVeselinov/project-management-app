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
					class="font-semibold mb-5">Project manager: {{ projectManager.name }}
				</p>
				<p class="font-semibold border-b mb-3">Developers:</p>
				<div 
					v-if="!developers"
					class="text-sm">
					No developers are assigned to this ticket yet!
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
			<h3 class="font-semibold border-b mb-5">Notes:</h3>
			<div class="my-5">
				<strong>David Veselinov</strong> - Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa minima veritatis itaque deserunt, molestiae fugit eum molestias est doloribus, reprehenderit earum, rem culpa eius ipsam voluptatum beatae quis cum perspiciatis.
			</div>

			<div class="my-5">
				<strong>Jovan Veselinov</strong> - Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa minima veritatis itaque deserunt, molestiae fugit eum molestias est doloribus, reprehenderit earum, rem culpa eius ipsam voluptatum beatae quis cum perspiciatis.
			</div>

			<div class="my-5">
				<strong>David Veselinov</strong> - Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa minima veritatis itaque deserunt, molestiae fugit eum molestias est doloribus, reprehenderit earum, rem culpa eius ipsam voluptatum beatae quis cum perspiciatis.
			</div>
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
		}
	},
    methods: {
        ...mapActions(["getTicketWithDetails", "removeDeveloperFromTicket"]),
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
    },

    computed: {
        ...mapState(["ticket", "loading", "user"]),
		developers(){
			return this.ticket.users.find(d => d.role_id == 3)
		},
    },

    mounted() {
        this.getTicketWithDetails(this.$route.params.t_id);
		this.projectManager = this.ticket.users.find(u => u.role_id == 2)
    },
};
</script>

<style></style>
