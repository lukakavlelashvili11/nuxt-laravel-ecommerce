<template>
  <div class="product__payment d-flex justify-content-between align-items-center">
        <div class="product__price">
            <div class="d-flex flex-column">
                <h5 class="price">{{ price }}<span v-if="lari"> &#8382;</span><span v-if="!lari"> &#36;</span></h5>
                <div class="valute-circles d-flex justify-content-start mt-1 mx-auto">
                    <div @click="changeValute" :style="{backgroundColor: lari ? 'pink' : 'transparent'}">&#8382;</div>
                    <div @click="changeValute" :style="{backgroundColor: !lari ? 'pink' : 'transparent'}">&#36;</div>
                </div>
            </div>
        </div>
        <img @click="addToCart" role="button" width="25" src="~/assets/img/add-to-basket.png"/>
    </div>
</template>

<script>
export default {
    props:['data'],
    data(){
        return{
            valute: 0,
            lari: true
        }
    },
    methods:{
        async getValute(){
            this.valute = (await this.$axios.get('https://api.exchangerate.host/latest?base=USD')).data.rates.GEL;
        },
        changeValute(){
            if(this.lari){
                this.lari = false;
            }else{
                this.lari = true;
            }
        },
        addToCart(){
            this.$store.dispatch('cart/storeCart',{
                product_id: this.$route.params.id,
                quantity: 1
            });
        }
    },
    computed:{
        price(){
            return this.lari ? this.data.price : Math.round(this.data.price / this.valute)
        }
    },
    mounted(){
        this.getValute();
    }
}
</script>

<style lang="scss">
.product__payment{
    position: absolute;
    bottom: 0px;
    width: 90%;
    .product__price{
        .valute-circles{
            div{
                height: 22px;
                width: 22px;
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
@media (max-width: 768px){
    .product__payment{
        position: inherit;
    }
}
</style>