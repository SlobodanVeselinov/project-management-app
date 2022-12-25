<template>
	<div class="p-5">
		<div class="p-5 w-full bg-white mb-5">
			<h3 class="font-semibold">Ticket Details</h3>
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
				<ul v-for="user in ticket.users" :key="user.id">
					<li v-if="user.role_id !== 2 && user.role_id !== 1">{{ user.name }}</li>
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

export default {
	data(){
		return {
			projectManager: '',
		}
	},
    methods: {
        ...mapActions(["getTicketWithDetails"]),
    },

    computed: {
        ...mapState(["ticket", "loading"]),
    },

    mounted() {
        this.getTicketWithDetails(this.$route.params.t_id);
        // console.log(this.$route.params.t_id)
		this.projectManager = this.ticket.users.find(u => u.role_id == 2)
    },
};
</script>

<style></style>
