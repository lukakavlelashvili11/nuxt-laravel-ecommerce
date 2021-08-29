<template>
  <div class="mt-5">
      <div class="product w-100">
          <div class="product__image">
              <img :src="product.imageurl"/>
          </div>
          <div class="product__description position-relative">
              <ProductPayments :data="product" class="mobile-payments d-none"/>
              <div>
                <h3 class="text-center">{{ product.name }}</h3>
                <p>{{ product.description }}</p>
              </div>
              <ProductPayments :data="product" class="desktop-payments"/>
          </div>
      </div>
      <div>
          <SimilarProducts :data="product"/>
      </div>
  </div>
</template>

<script>
import SimilarProducts from '@/components/SimilarProducts.vue'
import ProductPayments from '@/components/Product-inner/ProductPayments.vue'

export default {
    components:{
        SimilarProducts,
        ProductPayments
    },
    async asyncData({ $axios,route }){
        let response = await $axios.get(`/product/${route.params.id}`);
        let product = response.data;

        return {
            product,
        }
    }

}
</script>

<style lang="scss" scoped>
.product{
    display: flex;
    justify-content: center;
    &__image{
        display: flex;
        justify-content: center;
        width: 40%;
        img{
            height: 400px;
        }
    }
    &__description{
        width: 55%;
    }
}
@media (max-width: 768px){
    .product{
        flex-direction: column;
        border:1px solid black;
        // div{
        //     width: 100%;
        // }
        &__description{
            display: flex;
            flex-direction: column-reverse;
        }
        .desktop-payments{
            display: none !important;
        }
        .mobile-payments{
            display: block !important;
        }
    }
}
</style>