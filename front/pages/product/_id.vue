<template>
  <div class="mt-5">
      <div class="product row w-100">
          <div class="product__image col-5">
              <img :src="product.imageurl"/>
          </div>
          <div class="product__description col-7 position-relative">
              <h3 class="text-center">{{ product.name }}</h3>
              <p>{{ product.description }}</p>
              <div class="product__price">
                    <div class="d-flex flex-column">
                        <h5 class="price">{{ price }}<span v-if="lari"> &#8382;</span><span v-if="!lari"> &#36;</span></h5>
                        <div class="valute-circles d-flex justify-content-start mt-1">
                            <div @click="changeValute" :style="{backgroundColor: lari ? 'pink' : 'transparent'}">&#8382;</div>
                            <div class="ml-1" @click="changeValute" :style="{backgroundColor: !lari ? 'pink' : 'transparent'}">&#36;</div>
                        </div>
                    </div>
                </div>
          </div>
      </div>
      <div></div>
  </div>
</template>

<script lang="ts">
export default {
    async asyncData({ $axios,route }){
        let response = await $axios.get(`/product/${route.params.id}`);
        let product = response.data;
        let valute = (await $axios.get('https://api.exchangerate.host/latest?base=USD')).data.rates.GEL;

        return {
            product,
            valute,
            lari: true
        }
    },
    methods:{
        changeValute(){
            if(this.lari){
                this.lari = false;
            }else{
                this.lari = true;
            }
        }
    },
    computed:{
        price(){
            return this.lari ? this.product.price : Math.round(this.product.price / this.valute)
        }
    }
}
</script>

<style lang="scss" scoped>
.product{
    &__image{
        display: flex;
        justify-content: center;
        img{
            height: 400px;
        }
    }
    &__price{
        position: absolute;
        left: 30px;
        bottom: 0px;
        .valute-circles{
            div{
                height: 20px;
                width: 20px;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                font-size: 14px;
                &:hover{
                    border: 1px solid pink;
                }
            }
        }
    }
}
</style>