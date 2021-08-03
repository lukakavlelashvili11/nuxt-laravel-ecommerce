<template>
  <div>
      <div class="register mx-auto mt-5 p-3">
        <div class="pick w-100 d-flex justify-content-center">
          <img class="position-absolute" width="100" src="~/assets/img/pick.png"/>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <h4>Sign up</h4>
          <NuxtLink to="/signIn">Sign in</NuxtLink>
        </div>
        <div class="mt-3">
          <div class="d-flex justify-content-center flex-column">
            <span class="font-weight-bold mb-1">Email:</span>
            <b-form-input class="input"/>
          </div>
          <div class="d-flex justify-content-center mt-4 flex-column">
            <span class="font-weight-bold mb-1">Username:</span>
            <b-form-input class="input"/>
          </div>
          <div class="d-flex justify-content-center mt-4 flex-column">
            <span class="font-weight-bold mb-1">Password:</span>
            <b-form-input class="input"/>
          </div>
          <div class="w-100 mt-4 d-flex justify-content-between align-items-center">
              <div class="d-flex justify-content-start">
                <b-form-checkbox switch/>
                <span class="ml-1 text-secondary">Remember me</span>
              </div>
              <a href="#">Forgot Password?</a>
          </div>
        </div>
        <button class="register__button w-100 mt-4">Sign in</button>
        <div class="w-100 d-flex justify-content-center mt-3">
          <span class="text-secondary">or</span>
        </div>
        <div class="google-button position-relative w-100 d-flex justify-content-center align-items-center mt-3">
          <div class="google-logo">
            <img src="~/assets/img/google-logo.png"/>
          </div>
          <span class="text-white font-weight-bold">Sign in wth Google</span>
        </div>
      </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.register{
    width: 400px;
    box-shadow: 0px 0px 5px #564ec0;
    position: relative;
    z-index: 100;
    &__button{
      border: none;
      height: 45px;
      background: #564ec0;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      &:hover{
        background: #4e46c0;
      }
    }
    .google-button{
      height:45px;
      border-radius: 5px;
      cursor: pointer;
      background: #007bff;
      &:hover{
        background: #0171e9;
      }
      .google-logo{
        position: absolute;
        left:-2px;
        height: 95%;
        background: white;
        width:50px;
        margin:3px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        img{
          width:50%;
        }
      }
    }
    .pick{
      position:relative;
      top:-60px;
      z-index:-30;
    }
}
</style>