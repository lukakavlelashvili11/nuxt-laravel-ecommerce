<template>
  <div class="header">
      <div class="header--left">
        <a href="index.php" class="header--left__logo">
            <h3>guitar shop</h3>
        </a>
      </div>
      <div class="header--right">
          <img width="30" src="~\assets\img\5eoevlvs.bmp"/>
      </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap');
.header{
    display: flex;
    justify-content: center;
    align-items: center;
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
        display: flex;
        justify-content: center;
        align-items: center;
    }
}

</style>
