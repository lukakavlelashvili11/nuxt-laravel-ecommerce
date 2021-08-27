<template>
  <div class="product border rounded mt-3 pt-3">
      <NuxtLink :to="`/product/${data.id}`">
        <div class="product__image mx-auto pl-3 pr-3">
            <img :src="data.imageurl" class="mx-auto"/>
        </div>
      </NuxtLink>
      <div class="product__name w-100 mt-2 pl-3 pr-3">
          <span class="text-center">{{ data.name }}</span>
      </div>
      <div class="product__details d-flex justify-content-between align-items-center p-3">
          <div class="d-flex flex-column">
              <span class="price">{{ data.price }}<span> &#8382;</span></span>
          </div>
          <div>
              <img @click="addToCart" role="button" width="25" src="~/assets/img/add-to-basket.png"/>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    props:[
        'data'
    ],
    methods:{
        addToCart(){
            this.$store.dispatch('cart/storeCart',{
                product_id: this.data.id,
                quantity: 1
            });
        }
    }
}
</script>

<style lang="scss" scoped>
.product{
    width: 290px;
    height:350px;
    position: relative;
    &__image{
        height: 70%;
        width: 100%;
        display: flex;
        justify-content: center;
        img{
            height: 100%;
        }
    }
    &__name{
        font-weight: bold;
        span{
            width: 275px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            display:block
        }
    }
    &__details{
        position: absolute;
        bottom: 0px;
        width: 100%;
        height: 60px;
        transition: 0.3s;
        transition-timing-function: linear;
        .price{
            font-weight: 600;
        }
    }
    &:hover{
        .product__details{
            background: #fae1d3;
        }
    }
}
</style>