<template>
     <div class="container pt-5">
           <div class="row">
                <div  class="col-4">
                         <span></span>
                        <div class="card" style="width: 18rem;">
                        <img class="card-img-top" :src="'/uploads/'+this.products.image" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{this.products.title}}</h5>
                            <h5>{{this.products.price}}</h5>
                            <p class="card-text">{{this.products.desc}}</p>
                            <a href="#" class="btn btn-primary">Buy</a>
                        </div>
                        </div>
                </div>
            </div>
     </div>
</template>
<script>
export default {
    data(){
        return{
            products: [],
        };
    },
    created(){
     
        axios.get(`/api/product/${this.$route.params.slug}`).then(response =>(this.products = response.data));
    }
};
</script>
