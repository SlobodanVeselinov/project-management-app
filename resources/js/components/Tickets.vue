<template>
    <div>
        <div class="flex justify-between items-center mb-5">
            <h2 class="font-semibold text-gray-800 mb-5">Active Tickets</h2>
            <button 
                v-if="user.role_id == 2 || user.role_id == 1"
                class="py-2 px-3 bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out text-white text-sm rounded"    
                    >Add Ticket</button>
        </div>
        <div v-if="tickets">
            <div v-for="ticket in userTickets" :key="ticket.id">
                <Ticket
                    :ticket="ticket"

                 />
            </div>
        </div>
        
        
    </div>
</template>

<script>
import Ticket from "./Ticket.vue";
import { mapState, mapActions } from 'vuex'

export default {
    props: ["tickets"],
    data(){
        return {
            projectTickets: '',
        }
    },
    components: {
        Ticket,
    },
    methods: {
        ...mapActions(["getTickets"])
    },
    computed: {
        ...mapState(["user", "userTickets"])
    },
    mounted(){
        this.getTickets(this.$route.params.id)

    }
};
</script>

<style></style>
