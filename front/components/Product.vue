<template>
  <div class="product border p-3 mt-3">
      <div class="product__image mx-auto">
          <img src="~/assets/img/161576772956298.jpg"/>
      </div>
      <div class="product__name w-100 mt-2">
          <span class="mx-auto">ibanez magari gitaraa iyidet yvelam gtxoovt</span>
      </div>
      <div class="product__details d-flex justify-content-between align-items-center mt-4">
          <div class="d-flex flex-column">
              <span class="price">137<span v-if="lari"> &#8382;</span><span v-if="!lari"> &#36;</span></span>
            <div class="valute-circles d-flex justify-content-start mt-1">
                <div @click="changeValute" :style="{backgroundColor: lari ? 'pink' : 'transparent'}">&#8382;</div>
                <div @click="changeValute" :style="{backgroundColor: !lari ? 'pink' : 'transparent'}">&#36;</div>
            </div>
          </div>
          <div>
              <img width="25" src="~/assets/img/add-to-basket.png"/>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    props:[
        'valute'
    ],
    data(){
        return{
            lari: true,
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
    mounted(){
        console.log(this.valute);
    }
}
</script>

<style lang="scss" scoped>
.product{
    width: 290px;
    height:350px;
    &__image{
        width: 80%;
        img{
            width: 100%;
        }
    }
    &__name{
        font-weight: bold;
        span{
            width: 275px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            display:block
        }
    }
    &__details{
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
        .price{
            font-weight: 600;
        }
    }
}
</style>