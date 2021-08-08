<template>
  <div>

      <b-modal @ok="add" id="add-category" ok-title="add +" ok-variant="outline-success" ok-only centered>
          <div>
              <label>Category name:</label>
              <b-form-input v-model="name"></b-form-input>
          </div>
      </b-modal>

      <div class="d-flex justify-content-between align-items-center p-2">
          <h3 class="mb-4">Categories</h3>
          <b-button variant="outline-info" @click="$bvModal.show('add-category')">Add +</b-button>
      </div>
      <table class="table max-auto">
          <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Create date</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
          <tr v-for="(category,i) in categories" :key="i">
              <td>{{ category.id }}</td>
              <td>{{ category.name }}</td>
              <td>{{ category.created_at }}</td>
              <td>
                  <b-button variant="outline-success">Edit</b-button>
              </td>
              <td>
                  <b-button variant="outline-danger">Delete</b-button>
              </td>
          </tr>
      </table>
  </div>
</template>

<script>
export default {
    layout:'admin',
    async asyncData({ $axios }){
        let response = await $axios.get('/category');
        let categories = response.data;

        return{
            categories,
            name:''
        }
    },
    methods:{
        add(){
            this.$axios.post('/category/save',{
                name: this.name
            })
            .then(()=>{
                this.$bvModal.hide('add-category');
            })
            .catch(err => {
                console.log(err.response.data);
            })
        }
    }
}
</script>

<style>

</style>