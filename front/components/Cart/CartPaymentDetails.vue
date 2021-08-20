<template>
  <div class="payment w-100 border">
      <div class="payment__details">
          <ul class="w-100 p-2">
              <li v-for="(pd,i) in data" class="d-flex justify-content-between align-items-center w-100">
                  <span><span class="name">{{ pd.product.name }}</span><span style="color:#eb4034;">({{ pd.quantity }})</span></span>
                  <span>{{ pd.quantity*pd.product.price }} &#8382;</span>
              </li>
          </ul>
      </div>
      <div class="w-100 p-2 d-flex justify-content-between align-items-center">
          <span>Sum</span>
          <span>{{ sum }} &#8382;</span>
      </div>
  </div>
</template>

<script>
// import { mapState,mapMutations } from 'vuex'  

export default {
    props: ['data'],
    methods:{
        // ...mapMutations('cart',['setSum'])
    },
    computed:{
        sum(){
            var sum = 0;
            for(let i = 0;i < this.data.length;i++){
                sum += this.data[i].quantity * this.data[i].product.price
            }
            return sum;
        }
        // ...mapState('cart',{
        //     sum: state => state.sum
        // })
    },
    mounted(){
        // this.setSum();
    }
}
</script>

<style lang="scss" scoped>
.payment{
    border-radius: 10px;
    &__details{
        ul{
            list-style: none;
            li{
                width: 100%;
                .name{
                    color: #8a8a8a;
                }
            }
        }
    }
}
</style>