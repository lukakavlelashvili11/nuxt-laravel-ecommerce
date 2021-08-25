<template>
  <div>
      <div class="row w-100 p-5">
        <div class="payment-details col-4 p-4">
            <ul class="w-100 p-0">
                <li v-for="(data,i) in cartData" class="d-flex justify-content-between align-items-center w-100">
                    <span><span class="name">{{ data.product.name }}</span><span style="color:#ff9378;">({{ data.quantity }})</span></span>
                    <span>{{ data.quantity*data.product.price }} &#8382;</span>
                </li>
            </ul>
            <div class="w-100 d-flex justify-content-between align-items-center">
                <span>Sum</span>
                <span>{{ sum }} &#8382;</span>
            </div>
        </div>
        <div class="col-8">
            <div class="w-75 mx-auto">
                <div class="row">
                    <div class="col-6">
                        <b-form-input placeholder="name"/>
                    </div>
                    <div class="col-6">
                        <b-form-input placeholder="lastname"/>
                    </div>
                </div>
                <b-form-input placeholder="phone number" class="mt-3"/>
                <b-form-input placeholder="address" class="mt-3"/>
                <b-form-input placeholder="aditional details about address" class="mt-3"/>
            </div>
            <div class="d-flex justify-content-center w-100 mt-5">
                <div id="paypal-button-container"></div>
            </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
    async asyncData({ $axios }){
        let response = await $axios.get('/cart');
        let cartData = response.data;

        return {
            cartData
        }
    },
    computed:{
        sum(){
            var sum = 0;
            for(let i = 0;i < this.cartData.length;i++){
                sum += this.cartData[i].quantity * this.cartData[i].product.price
            }
            return sum;
        }
    },
    mounted(){
        paypal.Buttons({
            style: {
                layout: 'vertical',
                // color: 'blue',
                shape: 'pill',
                label: 'paypal'
            }
        })
        .render('#paypal-button-container');
    }
}
</script>

<style lang="scss" scoped>
.payment-details{
    box-shadow: 0px 0px 10px rgb(216, 213, 213);
    .name{
        color: #8a8a8a;
    }
}
</style>