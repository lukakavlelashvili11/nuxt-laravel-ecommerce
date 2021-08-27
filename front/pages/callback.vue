<template>
  <h1>sdf</h1>
</template>

<script>
export default {
    data(){
        return{
            token: this.$route.query.token ? this.$route.query.token : null
        }
    },
    mounted(){
        // this.$auth.login({
        //     data: {
        //         token: this.token
        //     }
        // })
        // .catch(err => {
        //     console.log(err);
        // })
        console.log(this.$auth);
    }
}
</script>

<style>

</style>