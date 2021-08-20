<template>
  <div class="filter">
      <img width="20" src="~/assets/img/filter.png" role="button" @click="filterOptions = !filterOptions">
      <div class="filter-options mt-3" v-if="filterOptions">
        <div class="filter-options__top mb-1">
          <span>category</span>
          <span>brand</span>
          <img @click="clearFilter" class="refresh-products" role="button" src="~/assets/img/refresh.png"/>
        </div>
        <div class="filter-options__middle w-100">
          <div class="products w-50">
            <ul>
              <li 
                v-for="(category,i) in categories" 
                class="p-2 pl-4" 
                :key="i"
                @click="addCategoryFilters(category.id)"
                :style="{background: (categoryFilters.indexOf(category.id) !== -1 ? '#6da0f2' : 'transparent')} "
                >
                  {{ category.name }}
              </li>
            </ul>
          </div>
          <div class="brands w-50">
            <ul>
              <li 
                v-for="(brand,i) in brands" 
                class="p-2 pl-4" :key="i"
                @click="addBrandFilters(brand.id)"
                :style="{background: (brandFilters.indexOf(brand.id) !== -1 ? '#6da0f2' : 'transparent')} "
              >
                  {{ brand.name }}
              </li>
            </ul>
          </div>
        </div>
        <div class="w-100 p-4">
          <div class="w-100 mb-3">
            <span class="text-left font-weight-bold">Filter price:</span>
          </div>
          <client-only>
            <VueSlider 
            v-model="priceRange"
            :min="0"
            :max="5000"
            :interval="5"
            />
          </client-only>
          <div class="w-75 row mx-auto mt-1">
            <div class="col-6">
              <b-form-input v-model="priceRange[0]"/>
            </div>
            <div class="col-6">
              <b-form-input v-model="priceRange[1]"/>
            </div>
          </div>
          <div class="w-100 d-flex justify-content-center">
            <b-button variant="primary" class="mt-3" @click="filter">Filter</b-button>
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
      categories: [],
      brands: [],
      filterOptions:false,
      categoryFilters: [],
      brandFilters: []
    }
  },
  methods:{
    addCategoryFilters(id){
      if(this.categoryFilters.indexOf(id) === -1){
        this.categoryFilters.push(id);
      }else{
        let idIndex = this.categoryFilters.indexOf(id);
        this.categoryFilters.splice(idIndex,1);
      }
    },
    addBrandFilters(id){
      if(this.brandFilters.indexOf(id) === -1){
        this.brandFilters.push(id);
      }else{
        let idIndex = this.brandFilters.indexOf(id);
        this.brandFilters.splice(idIndex,1);
      }
    },
    async getFilterOptions(){
      let response = await this.$axios.get('/filter');
      this.brands = response.data[0];
      this.categories = response.data[1];
    },
    filter(){
      if(this.categoryFilters || this.brandFilters){
        this.$router.push({
          path: '/filter-result',
          query: { 
            c: this.categoryFilters,
            b: this.brandFilters,
            p: this.priceRange
          }
        });
      }
    },
    clearFilter(){
      this.categoryFilters = [];
      this.brandFilters = [];
      this.priceRange = [0,5000];
    }
  },
  mounted(){
    this.getFilterOptions();
  }
}
</script>

<style lang="scss" scoped>
.test{
  background: black;
}
.filter{
    position: relative;
    // left:20px;
    margin-left: 20px;
    width: 300px;
    &-options{
      width: 400px;
      box-shadow: 0px 0px 5px rgb(106, 117, 209);
      position: absolute;
      z-index: 100;
      background: whitesmoke;
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
            border-radius: 5px;
            margin-top: 1px;
            &:hover{
              background: rgb(241, 239, 241);
            }
          }
        }
      }
    }
}
</style>