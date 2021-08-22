<template>
  <div class="search"> 
      <div class="w-100 d-flex justify-content-between align-items-center">
        <img width="20" src="@/assets/img/loupe.svg" @click="search = !search;input =''"/>
        <div v-if="search" class="search-box position-absolute">
            <b-form-input class="input" placeholder="Search something" v-model="input"/>
            <div class="search-results">
                <div v-for="(result,i) in searchResults" :key="i" class="w-50">
                        <NuxtLink :to="`/product/${result.id}`" class="w-100">
                            <div class="w-100 p-2 mt-2 w-50 d-flex justify-content-start align-items-center">
                                <img height="70" :src="result.imageurl"/>
                                <span class="ml-3">{{ result.name }}</span>
                            </div>
                        </NuxtLink>
                </div>
            </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            search: false,
            input: '',
            searchResults: []
        }
    },
    watch:{
        input(){
            if(this.input != '')
            this.$axios.post('/search',{
                q: this.input
            })
            .then(res => {
                this.searchResults = res.data;
            });
        },
        $route(){
            this.search = false;
            this.input = '';
        }
    }
}
</script>

<style lang="scss" scoped>
.search{
    &-box{
        margin-left: 35px;
        .input{
            width: 250px;
        }
        &-results{
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            width:650px;
            max-height: 400px;
            overflow-y: auto;
            position:absolute;
            z-index: 10;
            background:white;
            box-shadow: 0px 0px 5px gray;
            a{
                color: black;
                text-decoration: none;
            }
        }
    }
}
</style>