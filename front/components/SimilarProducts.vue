<template>
  <div class="mb-5">
    <h3 class="mt-5 ml-3">Similar products</h3>
    <ProductsCarousel :data="similars" class="mt-4"/>
  </div>
</template>

<script>
import ProductsCarousel from '@/components/ProductsCarousel.vue'

export default {
  components:{
    ProductsCarousel
  },
  props:['data'],
  data(){
    return{
      similars: []
    }
  },
  methods:{
    async getSimilarProducts(){
      let response = await this.$axios.get(`/product/similar/${this.data.brand_id}?except=${this.data.id}`);
      this.similars = response.data;
    }
  },
  mounted(){
    this.getSimilarProducts();
  }
}
</script>

<style>

</style>