<template>
  <div>
      <div class="w-50 d-flex justify-content-between flex-wrap mx-auto mt-5">
          <div class="admin-category border" v-for="(page,i) in pages" :key="i">
              <NuxtLink :to="page.href">
                  {{ page.name }}
              </NuxtLink>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    layout:'admin',
    data(){
        return{
            pages: [
                {name: 'brands',href: '/admin/brands'},
                {name: 'categories',href: '/admin/categories'},
                {name: 'products',href: '/admin/products'}
            ]
        }
    }
}
</script>

<style scoped>
.admin-category{
    width: 200px;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>