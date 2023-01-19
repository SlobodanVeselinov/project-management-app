<template>
    <div>
        <NewTicketModal 
            v-if="showModal" 
            @closeModal="closeModal" 
        />

        <div class="flex justify-between items-center mb-5">
            <h2 class="font-semibold text-gray-800 mb-5">Active Tickets</h2>
            <button
                v-if="user.role_id == 2 || user.role_id == 1"
                @click="openModal"
                class="py-2 px-3 bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out text-white text-sm rounded"
            >
                Add Ticket
            </button>
        </div>
        <div v-for="ticket in userTickets" :key="ticket.id">
            <Ticket :ticket="ticket" />
        </div>
        <div v-if="!userTickets.length">
            <p class="text-sm font-semibold">No active tickets for this project.</p>
        </div>
    </div>
</template>

<script>
import Ticket from "./Ticket.vue";
import NewTicketModal from "./NewTicketModal.vue";
import { mapState, mapActions } from "vuex";

export default {
    props: ["tickets"],
   
    data() {
        return {
            showModal: false,
            projectTickets: "",
        };
    },
    components: {
        Ticket,
        NewTicketModal
    },
    methods: {
        ...mapActions(["getTickets"]),

        openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
    },
    computed: {
        ...mapState(["user", "userTickets"]),
    },
    mounted() {
        this.getTickets(this.$route.params.id);
    },
};
</script>
