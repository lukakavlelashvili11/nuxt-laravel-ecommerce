<template>
  <div class="cart-item d-flex justify-content-between align-items-center p-2"> 
    <div class="cart-item--left d-flex justify-content-start align-items-center">
      <div class="cart-item__image">
        <img :src="data.product.imageurl"/>
      </div>
      <div class="cart-item__title ml-2 d-flex flex-column">
        <span>
          {{ data.product.name }}
        </span>
        <span>
          {{ data.product.price }} &#8382;
        </span>
      </div>
    </div>
    <div class="cart-item--right d-flex justify-content-start align-items-center">
      <div class="quantity-buttons d-flex justify-content-between align-items-center">
        <div>
          <img width="11" src="@/assets/img/minus.svg"/>
        </div>
        <div>{{ data.quantity }}</div>
        <div>
          <img width="11" src="@/assets/img/plus.svg"/>
        </div>
      </div>
      <img class="ml-4" width="30" src="@/assets/img/close.svg" @click="increase"/>
    </div>
  </div>
</template>

<script>
export default {
  props:['data'],
  methods:{
    increase(){}
  }
}
</script>

<style lang="scss" scoped>
.cart-item{
  width: 100%;
  border: 1px solid #b9ceee;
  border-radius: 10px;
  margin-top: 1px;
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
}
</style>