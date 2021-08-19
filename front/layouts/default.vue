<template>
  <div>
      <Header/>
      <Nuxt/>
      <CartSuccessAlert/>
  </div>
</template>

<script>
import Header from '@/components/Includes/Header.vue'
import CartSuccessAlert from '@/components/Cart/CartSuccessAlert.vue'

export default {
    components:{
        Header,
        CartSuccessAlert
    }
}
</script>

<style>

</style>