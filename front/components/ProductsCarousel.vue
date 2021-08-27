<template>
    <div class="products w-100 mt-3">
        <div class="w-100 p-3 mx-auto d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-start align-items-center">
                <div class="brand-logo">
                    <img width="50" :src="data.imageurl"/>
                </div>
                    <div class="font-weight-bold ml-3">
                        <h3>{{ data.name }}</h3>
                    </div>
                </div>
                <NuxtLink :to="`/brand/${data.id}`">show all</NuxtLink>
            </div>
            <div class="w-100 d-flex justify-content-between align-items-center position-relative">
                <div @click="next" class="nav d-flex align-items-center" style="left:0px;"><img style="transform:rotate(180deg)" height="35" src="@/assets/img/play.svg"/></div>
                <div @click="prev" class="nav d-flex align-items-center" style="right:0px;"><img height="35" src="@/assets/img/play.svg"/></div>
                <Carousel 
                :perPage="1"
                :loop="true"
                :paginationEnabled="false"
                :perPageCustom="[[658,2],[930,3],[1230,4],[1530,5],[1880,6],[2200,7],[1540,8]]"
                class="w-100 mx-auto"
                :centerMode="true"
                ref="carousel"
                >
                    <Slide v-for="(product,i) in data.product" :key="i">
                        <Product class="ml-3 mx-auto" :data="product"/>
                    </Slide>
                </Carousel>
            </div>
        </div>
    </div>
</template>

<script>
import Product from '@/components/Product.vue'
export default {
    props:['data'],
    components:{
        Product
    },
    methods:{
        next(){
            this.$refs.carousel.goToPage(this.$refs.carousel.getNextPage());
        },
        prev(){
            this.$refs.carousel.goToPage(this.$refs.carousel.getPreviousPage());
        }
    }
}
</script>

<style scoped>
.brand-logo{
    display:flex;
    justify-content:center;
    align-items:center;
    border:1px solid #564ec0;
    border-radius: 16px;
    width:70px;
    height:70px;
}
.nav{
    position:absolute;
    height: 30px;
    cursor: pointer;
    z-index: 10;
}
a{
    color: black;
    text-decoration: none;
}
</style>