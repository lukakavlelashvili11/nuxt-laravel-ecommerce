<template>
  <div>
      <div class="w-100 d-flex justify-content-center mt-5">
        <h1 class="mx-auto" v-if="!!!products.length">Product does not exist!</h1>
      </div>
      <div class="products row w-100 mx-auto p-2">
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 w-100" v-for="(product,i) in products" :key="i">
              <Product class="mx-auto" :data="product"/>
          </div>
      </div>
  </div>
</template>

<script>
import Product from '@/components/Product.vue'

export default {
    async asyncData({ $axios,route }){
        let response = await $axios.get('/filter-result',{
            params: {
                categories: route.query.c,
                brands: route.query.b,
                price: route.query.p
            }
        })
        let products = response.data;
        
        return {
            products
        }
    },
    watch:{
        '$route.query'(){
            this.$nuxt.refresh();
        }
    }
}
</script>

<style scoped>
@media (max-width: 360px){
    .products{
        padding: 0px !important;
    }
}
</style>