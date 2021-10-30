<template>
  <div>
      <BrandsCarousel v-for="(brand,i) in brands" :data="brand" :key="i">
        <ProductsCarousel :data="brand.product"/>
      </BrandsCarousel>
  </div>
</template>

<script>
import ProductsCarousel from '@/components/ProductsCarousel.vue'
import BrandsCarousel from '@/components/BrandsCarousel.vue'

export default {
  components: {
    ProductsCarousel,
    BrandsCarousel
  },
  data(){
    return{
      data: [1,2,3,4,5,6],
      gel: 0,
      brands: []
    }
  },
  methods:{
    async fetchValute(){
      fetch('https://api.exchangerate.host/latest?base=USD')
      .then(resp => resp.json())
      .then(data => { this.gel = data.rates.GEL });
    },
    async fetchBrands(){
      let response = await this.$axios.get('/brand?product=1');
      this.brands = response.data;
    }
  },
  mounted(){
    this.fetchValute();
    this.fetchBrands();
  }
}
</script>

<style>
.slider{
  height: 480px;
  overflow: hidden;
}
</style>
