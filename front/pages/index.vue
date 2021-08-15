<template>
  <div>
    <ProductFilter />
    <ProductsCarousel v-for="(brand,i) in brands" :data="brand" :key="i"/>
  </div>
</template>

<script>
import ProductFilter from "@/components/ProductFilter.vue"
import ProductsCarousel from '@/components/ProductsCarousel.vue'

export default {
  components: {
    ProductFilter,
    ProductsCarousel
  },
  data(){
    return{
      data:[1,2,3,4,5,6],
      gel:0,
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
      let response = await this.$axios.get('/brands');
      this.brands = response.data;
    }
  },
  mounted(){
    this.fetchValute();
    this.fetchBrands();
    // console.log(valute.then(res => res))
  }
}
</script>

<style>
</style>
