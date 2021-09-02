<template>
  <div>
      <div class="register mx-auto mt-5 mb-5 p-3">
        <div class="pick w-100 d-flex justify-content-center">
          <img class="position-absolute" width="100" src="~/assets/img/pick.png"/>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <h4>Sign in</h4>
          <NuxtLink to="/signup">Create account</NuxtLink>
        </div>
        <div class="mt-3">
          <div v-if="errors.wrong" class="w-100 d-flex justify-content-center">
            <span class="text-danger">{{ errors.wrong }}</span>
          </div>
          <div class="d-flex justify-content-center flex-column">
            <span class="font-weight-bold mb-1">Email:</span>
            <b-form-input class="input" v-model="form.email"/>
          </div>

          <span class="text-danger" 
          v-if="errors.email.length" 
          v-for="err in errors.email">{{ err }}</span>

          <div class="d-flex justify-content-center mt-4 flex-column">
            <span class="font-weight-bold mb-1">Password:</span>
            <b-form-input class="input" type="password" v-model="form.password"/>
          </div>

          <span class="text-danger" 
          v-if="errors.password.length" 
          v-for="err in errors.password">{{ err }}</span>

          <div class="w-100 mt-4 d-flex justify-content-between align-items-center">
              <div class="d-flex justify-content-start">
                <b-form-checkbox switch v-model="form.remember"/>
                <span class="ml-1 text-secondary">Remember me</span>
              </div>
              <a href="#">Forgot Password?</a>
          </div>
        </div>
        <button class="register__button w-100 mt-4" @click="signIn">Sign in</button>
        <div class="w-100 d-flex justify-content-center mt-3">
          <span class="text-secondary">or</span>
        </div>
        <div @click="loginWithGoogle" class="google-button position-relative w-100 d-flex justify-content-center align-items-center mt-3">
          <div class="google-logo">
            <img src="~/assets/img/google-logo.png"/>
          </div>
          <span class="text-white font-weight-bold">Sign in with Google</span>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      form:{
        email: '',
        password: '',
        remember: false
      },
      errors:{
        email:[],
        password:[],
        wrong: ''
      }
    }
  },
  methods:{
    async signIn(){
      try{
        await this.$auth.loginWith('laravelSanctum',{
          data:{
            email: this.form.email,
            password: this.form.password,
            remember: this.form.remember
          }
        })
      }catch(e){
        if(e.response && e.response.status == 422){
          Object.assign(this.errors,e.response.data.errors);
          this.form.password = '';
        }
        if(e.response && e.response.status == 401){
          this.errors.wrong = 'Email or password is invalid!'
          this.form.password = '';
        }
      }
    },
    loginWithGoogle(){
      this.$auth.loginWith('google')

    }
  }
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
@media (max-width: 420px){
  .register{
    width: 100%;
  }
}
</style>