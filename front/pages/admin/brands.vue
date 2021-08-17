<template>
  <div>

      <b-modal v-model="modal" hide-footer centered>
          <div>
              <label>Name:</label>
              <b-form-input v-model="form.name"></b-form-input>
          </div>
          <div>
              <label>Description</label>
              <b-form-textarea v-model="form.description"></b-form-textarea>
          </div>
          <div>
              <input class="d-none" type="file" ref="file" @change="browsePhoto"/>
              <div v-if="form.imageurl" class="w-100 d-flex justify-content-center mt-4 mb-3">
                  <img width="150" :src="form.imageurl"/>
              </div>
              <div class="w-100 d-flex justify-content-center mt-4">
                <b-button variant="outline-info" @click="$refs.file.click()">
                    Choose image
                </b-button>
              </div>
          </div>
          <div class="w-100 d-flex justify-content-end mt-4">
            <b-button variant="outline-success" @click="add" v-if="!editModal">Add +</b-button>
            <b-button variant="outline-info" @click="edit" v-else>Edit</b-button>
          </div>
      </b-modal>

      <b-modal @ok="remove()" v-model="deleteModal" ok-title="delete" ok-variant="outline-danger" ok-only centered>
          Are you sure you want to delete this category?
      </b-modal>

      <b-alert v-model="errors.alert" variant="danger" dismissible>
          {{ errors.name[0] }}
      </b-alert>

      <div class="d-flex justify-content-between align-items-center p-2">
          <h3 class="mb-4">Brands</h3>
          <b-button variant="outline-info" @click="prepAdd">Add +</b-button>
      </div>
      <table class="table max-auto">
          <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Description</th>
              <th>image</th>
              <th>Create date</th>
              <th>Update date</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
          <tr v-for="(brand,i) in brands" :key="i">
              <td>{{ brand.id }}</td>
              <td>{{ brand.name }}</td>
              <td>
                  <div class="table-long-text">
                    {{ brand.description }}
                  </div>
              </td>
              <td>
                  <div>
                      <img width="100" :src="brand.imageurl"/>
                  </div>
              </td>
              <td>{{ $moment(brand.created_at).format('LLL') }}</td>
              <td>{{ $moment(brand.updated_at).format('LLL') }}</td>
              <td>
                  <b-button variant="outline-success" @click="prepEdit(brand)">Edit</b-button>
              </td>
              <td>
                  <b-button variant="outline-danger"
                    @click="()=>{brand_id = brand.id;deleteModal = true;}"
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
    data(){
        return {
            brands: [],
            modal: false,
            deleteModal: false,
            editModal: false,
            brand_id: null,
            errors:{
                name: '',
                alert: false
            },
            form:{
                name: '',
                description: '',
                image: null,
                imageurl: '',
                oldImageUrl: ''
            }
        }
    },
    methods:{
        async getBrands(){
            let response = await this.$axios.get('/admin/brand');
            this.brands = response.data;
        },
        prepAdd(){
            for(let prop in this.form){
                this.form[prop] = '';
            }
            this.modal = true;
            this.editModal = false;
        },
        browsePhoto(e){
            const input = e.target;

            if(input.files && input.files[0]){
                this.form.image = input.files[0];
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.form.imageurl = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        },
        add(){
            let data = new FormData();
            for(let prop in this.form){
                data.append(prop,this.form[prop]);
            }

            this.$axios.post('/admin/brand/save',data,{
                headers:{
                    'content-type': 'multipart/form-data'
                }
            })
            .then(()=>{
                this.getBrands();
                this.modal = false;
            })
            .catch(err => {
                Object.assign(this.errors,errorHandler(err));
                this.errors.alert = true;
                this.modal = false;
            })
        },
        remove(){
            this.$axios.delete('/admin/brand/delete',{
                data:{
                    id: this.brand_id
                }
            })
            .then(() => {
                this.getBrands();
            })
        },
        async prepEdit(data){
            Object.assign(this.form,data);
            this.editModal = true;
            this.modal = true;
            this.brand_id = data.id;
            this.form.oldImageUrl = data.imageurl;
        },
        async edit(){
            let data = new FormData();
            for(let prop in this.form){
                data.append(prop,this.form[prop]);
            }
            data.append('id',this.brand_id);

            this.$axios.post('/admin/brand/edit',data,{
                headers:{
                    'content-type': 'multipart/form-data'
                }
            })
            .then(() => {
                this.getBrands();
                this.modal = false;
            })
            .catch(err => {
                Object.assign(this.errors,errorHandler(err));
                this.errors.alert = true;
                this.modal = false;
            })
        }
    },
    mounted(){
        this.getBrands();
    }
}
</script>

<style>

</style>