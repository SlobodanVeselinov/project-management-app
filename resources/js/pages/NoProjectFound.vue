<template>
  <div class="w-full text-center">
    <div class="mx-auto mt-24 mb-24 w-full text-center font-semibold text-xl text-red-600">
      You are trying to access a project or a ticket you are NOT assigned to. <br />
      Please contact your Project Manager!</div>
    <router-link
      :to="{ name: 'projects' }" 
      class="font-semibold mb-2 text-blue-500 mx-auto w-full"
      > Go Back to your projects
    </router-link>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>