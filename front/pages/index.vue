<template>
  <div>
    <!-- <client-only>
    <Carousel
    :perPage="1"
    :pagination-enabled="false"
    >
      <Slide>
        <div class="slider w-100 p-5">
          <img class="w-100" src="@/assets/img/test2.jpg"/>
        </div>
      </Slide>
      <Slide>
        <div class="slider w-100 p-5">
          <img class="w-100" src="@/assets/img/testslide.jpg"/>
        </div>
      </Slide>
      <Slide>
        <div class="slider w-100 p-5">
          <img class="w-100" src="@/assets/img/test5.jpg"/>
        </div>
      </Slide>
      <Slide>
        <div class="slider w-100 p-5">
          <img class="w-100" src="@/assets/img/105.jpg"/>
        </div>
      </Slide>
      <Slide>
        <div class="slider w-100 p-5">
          <img class="w-100" src="@/assets/img/fendertest.jpg"/>
        </div>
      </Slide>
    </Carousel>
    </client-only> -->
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
    // console.log(valute.then(res => res))
  }
}
</script>

<style>
.slider{
  height: 480px;
  overflow: hidden;
}
</style>
