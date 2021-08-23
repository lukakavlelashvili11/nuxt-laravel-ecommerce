<template>
  <Nuxt/>
</template>

<script>
export default {
  middleware({ $auth,error }){
    if($auth.loggedIn){
      if(!$auth.user.is_admin){
        return error({ statusCode: 404, message: 'Page not found' });
      }
    }else{
      return error({ statusCode: 404, message: 'Page not found' });
    }
  }
}
</script>

<style>

</style>