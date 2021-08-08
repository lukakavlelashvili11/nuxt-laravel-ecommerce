<template>
  <div>
    <ProductFilter />
    <div class="products row w-100 p-4 mt-2">
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 w-100" v-for="(d,i) in data" :key="i">
        <Product class="mx-auto" :valute="gel"/>
      </div>
    </div>
  </div>
</template>

<script>
import ProductFilter from "@/components/ProductFilter.vue"
import Product from '@/components/Product.vue'

export default {
  components: {
    ProductFilter,
    Product
  },
  data(){
    return{
      data:[1,2,3,4,5,6,7,8,9,0],
      gel:0
    }
  },
  methods:{
    async fetchValute(){
      fetch('https://api.exchangerate.host/latest?base=USD')
      .then(resp => resp.json())
      .then(data => {this.gel = data.rates.GEL});
    }
  },
  mounted(){
    this.fetchValute();
    // console.log(valute.then(res => res))
  }
}
</script>

<style>
@media(max-width: 636px){
  .products{
    padding: 0px !important;
  }
}
</style>
