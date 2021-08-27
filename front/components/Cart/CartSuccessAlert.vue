<template>
  <div class="alert mx-auto" v-if="showAlert">
      <b-alert variant="success" show>
          Product has added in cart.
      </b-alert>
  </div>
</template>

<script>
import { mapState,mapMutations } from 'vuex'

export default {
    data(){
        return{
            showAlert: false
        }
    },
    computed:{
        ...mapState('cart',{
            action: state => state.action
        })
    },
    methods:{
        ...mapMutations('cart',['unsetAction'])
    },
    watch:{
        action(val){
            if(val){
                this.showAlert = true;
                setTimeout(()=>{
                    this.showAlert = false;
                    this.unsetAction();
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
    width: 260px;
}
</style>