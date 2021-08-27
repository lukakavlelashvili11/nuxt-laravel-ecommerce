<template>
  <div>
      <div style="background: #ccf2b6;border-radius: 10px;" class="mt-4 mb-3 p-5 d-flex justify-content-start align-items-center">
          <img width="150" :src="brand.imageurl"/>
          <span class="ml-5" style="font-size: 17px;">{{ brand.description }}</span>
      </div>
      <div class="row w-100 mx-auto">
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 w-100" v-for="(product,i) in brand.product" :key="i">
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
        let brand = response.data;

        return {
            brand
        }
    }
}
</script>

<style>

</style>