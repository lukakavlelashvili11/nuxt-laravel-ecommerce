<template>
  <div class="filter">
      <img width="20" src="~/assets/img/filter.png" role="button" @click="filterOptions = !filterOptions">
      <div class="filter-options mt-2">
        <div class="filter-options__top">
          <span>product</span>
          <span>brand</span>
          <img class="refresh-products" src="~/assets/img/refresh.png"/>
        </div>
        <div class="filter-options__middle w-100">
          <div class="products w-50">
            <ul>
              <li v-for="product in products" class="p-1 pl-3" @click="filter">{{ product }}</li>
            </ul>
          </div>
          <div class="brands w-50">
            <ul>
              <li v-for="brand in brands" class="p-1 pl-3">{{ brand }}</li>
            </ul>
          </div>
        </div>
        <div class="w-100 p-4">
          <div class="w-100 mb-3">
            <span class="text-left">Filter price:</span>
          </div>
          <client-only>
            <vue-slider 
            v-model="priceRange"
            :min="0"
            :max="5000"
            />
          </client-only>
          <div class="w-100 d-flex justify-content-center">
            <b-button variant="primary" class="mt-3">Filter</b-button>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      priceRange:[0,5000],
      products:['guitars','picks','amp','ac.guitar'],
      brands:['ibanez','fender','jackson','dunlop'],
      filterOptions:false
    }
  }
}
</script>

<style lang="scss" scoped>
.filter{
    position: absolute;
    left:20px;
    &-options{
      width: 400px;
      box-shadow: 0px 0px 5px gray;
      &__top{
        display: flex;
        justify-content: space-around;
        position: relative;
        .refresh-products{
          position: absolute;
          right: 5px;
          width: 13px;
          top: 50%;
          transform: translateY(-50%);
        }
      }
      &__middle{
        display: flex;
        justify-content: space-between;
        height: 300px;
        border-bottom: 1px solid rgb(230, 227, 227);
        padding-bottom:10px;
        .products,.brands{
          overflow-y: scroll;
        }
        ul{
          padding: 0px;
          list-style: none;
          li{
            cursor: pointer;
          }
        }
      }
    }
}
</style>