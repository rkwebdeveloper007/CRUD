<template>

    <div class="content-wrapper">
      <!-- /.content-header -->
      <!-- Main content -->
      <div class="content">
        <div class="container mt-2">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Products</h3>
                  <div class="card-tools">
                    <button class="btn btn-success" @click="newModel">Add new
                    <i class="fas fa-user-plus fa-fw"></i>
                    </button>
                  </div>
                </div>
             

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container pt-5">
           <div class="row">
                <div v-for="(product,index) in products" :key="product.id" class="col-4">
                         <span class="badge badge-secondary" style="display:none;"> {{ index + 1 }}</span>
                        <div class="card" style="width: 18rem;">
                        <img class="card-img-top" :src="'uploads/'+product.image" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{product.title}}</h5>
                            <p class="card-text">{{product.desc}}</p>
                            <h5>Rs.{{product.price}}</h5>
                            <router-link :to="'product/'+product.slug">Buy
                            </router-link>   
                        </div>
                        </div>

                </div>
            </div>
     </div>
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-show="!editmode"  id="addNewLabel">Add New product</h5>
        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Upadte product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form @submit.prevent="createProduct()" enctype='multipart/form-data'>
      <div class="modal-body">
        <div class="form-group">
              <label>Title</label>
              <input v-model="form.title" type="text" name="title" placeholder="title"
                class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
              <has-error :form="form" field="title"></has-error>
            </div>
             <div class="form-group">
              <label>Price</label>
              <input v-model="form.price" type="text" name="price" placeholder="price"
                class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
              <has-error :form="form" field="price"></has-error>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" v-model="form.desc"  name="desc"
                 :class="{ 'is-invalid': form.errors.has('desc') }"></textarea>
              <has-error :form="form" field="desc"></has-error>
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" @change="uploadImage" name="image"
                class="form-control" :class="{ 'is-invalid': form.errors.has('image') }">
              <has-error :form="form" field="image"></has-error>
             </div>
            <div class="image" v-show="editmode">
                  <img :src="'uploads/'+form.image"  style="width:50px; height:50px;" class="img-circle elevation-2" alt="User Image">
            </div>
            
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
       </form>
    </div>
  </div>
</div> 
    </div>
</template>
<script>
export default {
    props: { title: String, price: String,desc: String, image: String,slug: String, id: Number },
    data() {
        return {
            products: {},
            editmode: false,
            form: new Form({
                id:'',
                title: '',
                price:'',
                image: '',
                desc: '',
                
            }),
        }
    },
    methods: {
        newModel() {
            $('#addNew').modal('show');
        },
        uploadImage(e) {
            let file = e.target.files[0];
            //console.log(file);
            let reader = new FileReader();
            if (file['size'] < 2111775) {
                reader.onloadend = (file) => {
                    //console.log('RESULT', reader.result)
                    this.form.image = reader.result;
                }
                reader.readAsDataURL(file);

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'File size is too long max(1MB)'
                })
            }
        },
        loadProducts() {
            axios.get('/api/product').then(({
                data
            }) => (this.products = data.data));

        },
        createProduct() {
            this.form.post('api/product')
                .then(() => {
                    Fire.$emit('AfterFinished');
                    $('#addNew').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Uploaded successfully'
                    });
                    
                })
                .catch(() => {
                    return "data failed";
                })
        },
        newModel(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
    },
    created() {
        this.loadProducts();
        console.log()
        Fire.$on('AfterFinished', () => {
            this.loadProducts();
        });
    }



}
</script>