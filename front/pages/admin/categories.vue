<template>
  <div>

      <b-modal v-model="modal" hide-footer centered>
          <div>
              <label>Category name:</label>
              <b-form-input v-model="form.name"></b-form-input>
          </div>
          <div class="w-100 d-flex justify-content-end mt-4">
            <b-button variant="outline-success" @click="addCategory" v-if="!editModal">Add +</b-button>
            <b-button variant="outline-info" @click="edit" v-else>Edit</b-button>
          </div>
      </b-modal>

      <b-modal @ok="deleteCategory()" v-model="deleteModal" ok-title="delete" ok-variant="outline-danger" ok-only centered>
          Are you sure you want to delete this category?
      </b-modal>

      <b-alert v-model="errors.alert" variant="danger" dismissible>
          {{ errors.name[0] }}
      </b-alert>

      <div class="d-flex justify-content-between align-items-center p-2">
          <h3 class="mb-4">Categories</h3>
          <b-button variant="outline-info" @click="prepAdd">Add +</b-button>
      </div>
      <table class="table max-auto">
          <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Create date</th>
              <th>Update date</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
          <tr v-for="(category,i) in categories" :key="i">
              <td>{{ category.id }}</td>
              <td>{{ category.name }}</td>
              <td>{{ $moment(category.created_at).format('LLL') }}</td>
              <td>{{ $moment(category.updated_at).format('LLL') }}</td>
              <td>
                  <b-button variant="outline-success" @click="prepEdit(category)">Edit</b-button>
              </td>
              <td>
                  <b-button variant="outline-danger"
                    @click="()=>{category_id = category.id;deleteModal = true;}"
                    >Delete</b-button>
              </td>
          </tr>
      </table>
  </div>
</template>

<script>
import { errorHandler } from '@/helpers/Admin/errorHandler'  

export default {
    layout:'admin',
    async asyncData({ $axios }){
        let response = await $axios.get('/admin/category');
        this.categories = response.data;

        return {
            categories: [],
            modal: false,
            deleteModal: false,
            editModal: false,
            category_id: null,
            errors:{
                name: '',
                alert: false
            },
            form:{
                name: ''
            }
        }
    },
    methods:{
        prepAdd(){
            for(let prop in this.form){
                this.form[prop] = '';
            }
            this.modal = true;
            this.editModal = false;
        },
        addCategory(){
            this.$axios.post('/admin/category/save',{
                name: this.form.name
            })
            .then(()=>{
                this.$nuxt.reload();
                this.modal = false;
            })
            .catch(err => {
                Object.assign(this.errors,errorHandler(err));
                this.errors.alert = true;
                this.modal = false;
            })
        },
        deleteCategory(){
            this.$axios.delete('/admin/category/delete',{
                data:{
                    id: this.category_id
                }
            })
            .then(() => {
                this.$nuxt.reload();
            })
        },
        async prepEdit(data){
            Object.assign(this.form,data);
            this.editModal = true;
            this.modal = true;
            this.category_id = data.id;
        },
        async edit(){
            this.$axios.post('/admin/category/edit',{
                id: this.category_id,
                name: this.form.name
            })
            .then(() => {
                this.modal = false;
                this.$nuxt.reload();
            })
            .catch(err => {
                Object.assign(this.errors,errorHandler(err));
                this.errors.alert = true;
                this.modal = false;
            })
        }
    }
}
</script>

<style>

</style>