<template>
    <div v-if="ticket.isActive" class="flex w-full mb-5 border border-gray-100 rounded">
        <div class="block p-6 rounded shadow bg-white w-full">
            <div class="flex justify-between">
                <h5 
                    class="text-gray-900 leading-tight font-medium mb-2">
                    {{ ticket.title.toUpperCase() }}
                </h5>
                <span class="mb-5 text-sm">
                    Status: 
                    <span 
                        :class="activeClass"
                        >{{ isActive }}</span>
                </span>

            </div>
            <div>
                <p class="text-gray-700 text-base mb-4">
                    {{ ticket.description.substring(0,50) + '...' }}
                </p>
                 <router-link
                            :to="{ name: 'ticketView', params: { p_id:this.$route.params.id, t_id:ticket.id} }" 
                            active-class="border rounded border-blue-900"
                            class="text-lg font-semibold mb-2"
                            >
                                <button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Details</button>
                            </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["ticket"],
    
    computed: {
        isActive(){
            if(this.ticket.isActive){
                return "Active"
            } else {
                return "Closed"
            }
        },

        activeClass(){
            if(this.ticket.isActive){
                return "text-green-500"
            } else {
                return "text-red-500"
            }
        },

    },
    
};
</script>

<style></style>
