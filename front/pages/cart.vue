<template>
  <div>
      <div class="row w-100 p-4">
        <div class="col-8 p-3" style="border-top:1px solid #b9ceee;border-bottom:1px solid #b9ceee;border-radius:10px;">
            <CartItem v-for="(product,i) in products" :key="i" :data="product"/>
        </div>
        <div class="col-4">
            <CartPaymentDetails :data="products"/>
        </div>
      </div>
  </div>
</template>

<script>
import CartItem from '@/components/Cart/CartItem.vue'
import CartPaymentDetails from '@/components/Cart/CartPaymentDetails.vue'

export default {
    components:{
        CartItem,
        CartPaymentDetails
    },
    async asyncData({ $axios }){
        let response = await $axios.get('/cart');
        let products = response.data;

        return {
            products
        }
    }
}
</script>

<style>

</style>