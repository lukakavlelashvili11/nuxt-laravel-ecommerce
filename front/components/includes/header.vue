<template>
<div class="position-relative">
  <div class="header">
      <div class="header--left">
        <NuxtLink to="/" class="header--left__logo">
            <h3>guitar shop</h3>
        </NuxtLink>
      </div>
      <div class="header--right">
          <ul>
              <li v-if="$auth.loggedIn">
                  {{ $auth.user.name }}
              </li>
              <li v-else>
                  <NuxtLink to="/signin">User</NuxtLink>
              </li>
              <li v-if="$auth.loggedIn && $auth.user.is_admin">
                  <a href="#">Admin</a>
              </li>
              <li>
                  <img width="30" src="~/assets/img/shopping-cart.png"/>
              </li>
          </ul>
      </div>
  </div>
  <ProductFilter />
</div>
</template>

<script>
import ProductFilter from "@/components/ProductFilter.vue"

export default {
    components: {
    ProductFilter
  },
}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap');

.header{
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0px 15px 0px 10px;
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
                padding:10px;
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
