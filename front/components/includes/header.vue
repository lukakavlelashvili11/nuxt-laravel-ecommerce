<template>
<div>
  <div class="header">
      <div class="header--left">
        <NuxtLink to="/" class="header--left__logo">
            <h3>guitar shop</h3>
        </NuxtLink>
      </div>
      <div class="header--right">
          <ul>
              <li v-if="$auth.loggedIn">
                  <div @click="logOut = !logOut" role="button">{{ $auth.user.name }}</div>
                  <div class="position-absolute" role="button" v-if="logOut" @click="$auth.logout();logOut = false">Log out</div>
              </li>
              <li v-else>
                  <NuxtLink to="/login">User</NuxtLink>
              </li>
              <li v-if="$auth.loggedIn && $auth.user.is_admin">
                  <a href="/admin">Admin</a>
              </li>
              <li>
                  <CartLogo v-if="$auth.loggedIn"/>
              </li>
          </ul>
      </div>
  </div>
  <div class="d-flex justify-content-start align-items-center ml-3">
    <ProductFilter />
    <Search class="ml-4 mt-1"/>
  </div>
</div>
</template>

<script>
import CartLogo from '@/components/Cart/CartLogo.vue'
import ProductFilter from "@/components/ProductFilter.vue"
import Search from '@/components/Search.vue'

export default {
    components: {
        ProductFilter,
        Search,
        CartLogo
  },
  data(){
      return{
          logOut:false
      }
  }
}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap');

.header{
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 10px 0px 10px;
    height: 55px;
    &--left{
        &__logo{
            color: black;
            text-decoration: none;
            h3{
                font-family: 'Amatic SC', cursive;
            }
        }
    }
    &--right{
        ul{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0px;
            list-style: none;
            li{
                padding: 10px;
                a{
                    color:black;
                    text-decoration: none;
                    font-size: 20px;
                }
            }
        }
    }
}

</style>
