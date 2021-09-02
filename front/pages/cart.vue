<template>
  <div>
      <div class="cart w-100 p-4">
        <div class="cart-items mr-4 p-3">
            <CartItem v-for="(product,i) in products" :key="i" :data="product"/>
        </div>
        <div class="cart-payments mx-auto">
            <CartPaymentDetails :data="products"/>
        </div>
      </div>
  </div>
</template>

<script>
import CartItem from '@/components/Cart/CartItem.vue'
import CartPaymentDetails from '@/components/Cart/CartPaymentDetails.vue'
import { mapMutations,mapState } from 'vuex'

export default {
    middleware: ['auth'],
    components:{
        CartItem,
        CartPaymentDetails
    },
    async asyncData({ $axios }){
        let response = await $axios.get('/cart');
        let products = response.data;

        return {
            products
        }
    },
    computed:{
        ...mapState('cart',['action'])
    },
    methods:{
        ...mapMutations('cart',['unsetAction'])
    },
    watch:{
        action(val){
            if(val){
                this.$nuxt.refresh();
                this.unsetAction();
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.cart{
    display: flex;
    justify-content: space-between;
    &-items{
        width: 65%;
        border-top:1px solid #b9ceee;
        border-bottom:1px solid #b9ceee;
        border-radius:10px;
    }
    &-payments{
        width: 35%;
    }
}
@media (max-width: 991px){
    .cart{
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        padding: 2px !important;
        &-items{
            width: 100%;
            padding: 0px !important;
            border: none;
            .product-name,.product-price{
                font-size: 13px !important;
            }
        }
        &-payments{
            margin-top: 20px;
            width: 100%;
        }
    }
}
</style>