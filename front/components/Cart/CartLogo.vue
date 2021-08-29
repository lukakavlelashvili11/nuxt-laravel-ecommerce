<template>
  <div class="position-relative">
      <NuxtLink to="/cart">
        <img width="30" src="~/assets/img/shopping-cart.png"/>
      </NuxtLink>
      <div class="quantity">{{ quantity }}</div>
  </div>
</template>

<script>
import { mapGetters,mapMutations } from 'vuex'
export default {
    data(){
        return{
            quantity: 0
        }
    },
    computed:{
        ...mapGetters('cart',['getAction'])
    },
    methods:{
        ...mapMutations('cart',['unsetAction']),
        getCartCount(){
            this.$axios.get('/cart/count')
            .then(res => {
                this.quantity = res.data;
            });
        }
    },
    watch:{
        getAction(val){
            if(val){
                this.getCartCount();
                if(this.$route.fullPath != '/cart')
                    this.unsetAction();
            }   
        }
    },
    mounted(){
        this.getCartCount();
    }
}
</script>

<style lang="scss" scoped>
.quantity{
    position: absolute;
    bottom: -5px;
    right: -5px;
    width: 18px;
    height: 18px;
    background: #63e04a;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 14px;
    color: white;
}
</style>