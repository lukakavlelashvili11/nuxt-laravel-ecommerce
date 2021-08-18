<template>
  <div>
      <div class="row w-100 mx-auto">
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 w-100" v-for="(product,i) in brands.product" :key="i">
              <Product class="mx-auto" :data="product"/>
          </div>
      </div>
  </div>
</template>

<script>
import Product from '@/components/Product.vue'

export default {
    components:{
        Product
    },
    async asyncData({ $axios,route }){
        let response = await $axios.get(`/brand/${route.params.id}?product=1`);
        let brands = response.data;

        return {
            brands
        }
    }
}
</script>

<style>

</style>