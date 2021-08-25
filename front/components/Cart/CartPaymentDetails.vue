<template>
  <div class="payment w-100 p-3">
      <div class="payment__details">
          <ul class="w-100">
              <li v-for="(pd,i) in data" class="d-flex justify-content-between align-items-center w-100">
                  <span><span class="name">{{ pd.product.name }}</span><span style="color:#ff9378;">({{ pd.quantity }})</span></span>
                  <span>{{ pd.quantity*pd.product.price }} &#8382;</span>
              </li>
          </ul>
      </div>
      <div class="w-100 d-flex justify-content-between align-items-center">
          <span>Sum</span>
          <span>{{ sum }} &#8382;</span>
      </div>
      <div class="d-flex justify-content-center p-3">
          <b-button variant="outline-primary" @click="$router.push('/checkout')">Check out</b-button>
      </div>
  </div>
</template>

<script>

export default {
    props: ['data'],
    computed:{
        sum(){
            var sum = 0;
            for(let i = 0;i < this.data.length;i++){
                sum += this.data[i].quantity * this.data[i].product.price
            }
            return sum;
        }
    }
}
</script>

<style lang="scss" scoped>
.payment{
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgb(216, 213, 213);
    &__details{
        ul{
            list-style: none;
            padding: 0px;
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