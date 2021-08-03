<template>
  <div class="header">
      <div class="header--left">
        <a href="index.php" class="header--left__logo">
            <h3>guitar shop</h3>
        </a>
      </div>
      <div class="header--right">
          <ul>
              <li>
                  <a href="#">register</a>
              </li>
              <li>
                  <a href="#">admin</a>
              </li>
              <li>
                  <img width="30" src="~/assets/img/shopping-cart.png"/>
              </li>
          </ul>
      </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap');
.header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0px 15px 0px 15px;
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
