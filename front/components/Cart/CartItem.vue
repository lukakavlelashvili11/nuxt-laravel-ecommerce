<template>
  <div class="cart-item d-flex justify-content-between align-items-center p-2"> 
    <div class="cart-item--left d-flex justify-content-start align-items-center">
      <div class="cart-item__image">
        <img :src="data.product.imageurl"/>
      </div>
      <div class="cart-item__title ml-3 d-flex flex-column">
        <span class="product-name">
          {{ data.product.name }}
        </span>
        <span class="product-price">
          {{ data.product.price }} &#8382;
        </span>
      </div>
    </div>
    <div class="cart-item--right d-flex justify-content-start align-items-center">
      <div class="quantity-buttons d-flex justify-content-between align-items-center">
        <div role="button" @click="reduce"> 
          <img width="11" src="@/assets/img/minus.svg"/>
        </div>
        <div>{{ data.quantity }}</div>
        <div role="button" @click="increase">
          <img width="11" src="@/assets/img/plus.svg"/>
        </div>
      </div>
      <img role="button" class="remove ml-4" width="30" src="@/assets/img/close.svg" @click="remove"/>
    </div>
  </div>
</template>

<script>

export default {
  props:['data'],
  methods:{
    remove(){
      this.$store.dispatch('cart/remove',{
        product_id: this.data.product.id
      });
    },
    increase(){
      this.$store.dispatch('cart/updateQuantity',{
        product_id: this.data.product.id,
        quantity: this.data.quantity+1
      });
    },
    reduce(){
      if(this.data.quantity>1){
        this.$store.dispatch('cart/updateQuantity',{
          product_id: this.data.product.id,
          quantity: this.data.quantity-1
        });
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.cart-item{
  width: 100%;
  border-radius: 10px;
  margin-top: 5px;
  box-shadow: 0px 0px 10px rgb(216, 213, 213);
  transition: .2s;
  &__image{
    img{
      height: 85px;
    }
  }
  &--right{
    .quantity-buttons{
      height: 30px;
      width: 75px;
      padding: 10px;
      background: rgb(245, 242, 242);
      border-radius: 10px;
    }
  }
  &:hover{
    box-shadow: 0px 0px 5px rgb(236, 234, 234);
  }
}
@media (max-width: 400px){
    .product-name,.product-price{
        font-size: 13px !important;
    }
    .product-name{
      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;
      width: 80px;
    }
    .remove{
      margin-left: 10px !important;
    }
}
</style>