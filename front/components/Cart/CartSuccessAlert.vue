<template>
  <div class="alert mx-auto" v-if="showAlert">
      <b-alert :variant="alertVariant" show>
         {{ alertText }}
      </b-alert>
  </div>
</template>

<script>
import { mapState,mapMutations } from 'vuex'

export default {
    data(){
        return{
            showAlert: false,
            alertText: '',
            alertVariant: ''
        }
    },
    computed:{
        ...mapState('cart',{
            cartStatus: state => state.cartStatus
        })
    },
    methods:{
        ...mapMutations('cart',['unsetCartStatus'])
    },
    watch:{
        cartStatus(val){
            if(val === 'exists' || val === 'added'){
                switch(val){
                    case 'exists':
                        this.alertVariant = 'danger';
                        this.alertText = 'The product alresdy exixts in cart!';
                        break;
                    case 'added':
                        this.alertVariant = 'success';
                        this.alertText = 'The product has added in cart!';
                        break;
                }
                this.showAlert = true;
                setTimeout(()=>{
                    this.showAlert = false;
                    this.unsetCartStatus();
                },2000)
            }
        }
    }
}
</script>

<style scoped>
.alert{
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 290px;
}
</style>