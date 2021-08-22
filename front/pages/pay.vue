<template>
  <div>
      <div id="paypal-button-container"></div>
  </div>
</template>

<script>
export default {
//     head() {
//     return {
//         script: [{
//             src: 'https://www.paypal.com/sdk/js?client-id=AfK2HSEPZfEbwBoeu3J1cWyeq7XpjwNHcULFhn6SEv0qODBp7FOd8sBe2au2XgnIJo8BBmNF-em5Gvqj'
//         }],
//     }
// },

    mounted(){
        paypal.Buttons().render('#paypal-button-container');
    }
}
</script>

<style>

</style>