<template>
  <div>

      <b-modal v-model="modal" hide-footer centered>
          <div>
              <label>Name:</label>
              <b-form-input v-model="form.name"></b-form-input>
          </div>
          <div>
              <label>Price:</label>
              <b-form-input v-model="form.price"></b-form-input>
          </div>
          <div>
              <label>Description</label>
              <b-form-textarea v-model="form.description"></b-form-textarea>
          </div>
          <div class="d-flex justify-content-center align-items-center mt-4">
              <b-form-select>
                  <b-form-select-option :value="brand.id" v-for="(brand,i) in brands" :key="i" @click="form.brand_id = brand.id">{{ brand.name }}</b-form-select-option>
              </b-form-select>
              <b-form-select class="ml-3">
                  <b-form-select-option :value="category.id" v-for="(category,i) in categories" :key="i" @click="form.category_id = category.id">{{ category.name }}</b-form-select-option>
              </b-form-select>
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
          <h3 class="mb-4">Products</h3>
          <b-button variant="outline-info" @click="prepAdd">Add +</b-button>
      </div>
      <table class="table max-auto">
          <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Category</th>
              <th>Brand</th>
              <th>Image</th>
              <th>Create date</th>
              <th>Update date</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>
          <tr v-for="(product,i) in products" :key="i">
              <td>{{ product.id }}</td>
              <td>{{ product.name }}</td>
              <td>
                  <div class="table-long-text">
                    {{ product.description }}
                  </div>
              </td>
              <td>{{ product.price }}</td>
              <td>{{ product.category.name }}</td>
              <td>{{ product.brand.name }}</td>
              <td>
                  <div>
                      <img width="100" :src="product.imageurl"/>
                  </div>
              </td>
              <td>{{ $moment(product.created_at).format('LLL') }}</td>
              <td>{{ $moment(product.updated_at).format('LLL') }}</td>
              <td>
                  <b-button variant="outline-success" @click="prepEdit(product)">Edit</b-button>
              </td>
              <td>
                  <b-button variant="outline-danger"
                    @click="()=>{product_id = product.id;deleteModal = true;}"
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
            products: [],
            modal: false,
            deleteModal: false,
            editModal: false,
            product_id: null,
            brands: [],
            categories: [],
            errors:{
                name: '',
                alert: false
            },
            form:{
                name: '',
                description: '',
                image: null,
                imageurl: '',
                oldImageUrl: '',
                price: '',
                brand_id: 0,
                category_id: 0
            }
        }
    },
    methods:{
        async getProducts(){
            let response = await this.$axios.get('/admin/product');
            this.products = response.data;
        },
        async prepAdd(){
            for(let prop in this.form){
                this.form[prop] = '';
            }
            this.modal = true;
            this.editModal = false;
            this.brands = (await this.$axios.get('/admin/brand')).data;
            this.categories = (await this.$axios.get('/admin/category')).data;
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
            this.$axios.post('/admin/product/save',data,{
                headers:{
                    'content-type': 'multipart/form-data'
                }
            })
            .then(()=>{
                this.getProducts();
                this.modal = false;
            })
            .catch(err => {
                Object.assign(this.errors,errorHandler(err));
                this.errors.alert = true;
                this.modal = false;
            })
        },
        remove(){
            this.$axios.delete('/admin/product/delete',{
                data:{
                    id: this.product_id
                }
            })
            .then(() => {
                this.getProducts();
            })
        },
        async prepEdit(data){
            Object.assign(this.form,data);
            this.editModal = true;
            this.modal = true;
            this.product_id = data.id;
            this.form.oldImageUrl = data.imageurl;
        },
        async edit(){
            let data = new FormData();
            for(let prop in this.form){
                data.append(prop,this.form[prop]);
            }
            data.append('id',this.product_id);

            this.$axios.post('/admin/product/edit',data,{
                headers:{
                    'content-type': 'multipart/form-data'
                }
            })
            .then(() => {
                this.getProducts();
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
        this.getProducts();
    }
}
</script>

<style>

</style>