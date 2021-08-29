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

                <slot></slot>

        </div>
    </div>
</template>

<script>
export default {
    props:['data'],
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