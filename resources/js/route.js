import  VueRouter from "vue-router";
import Home from "./Products/Home";
import Product from "./Products/Detail-product";



//backend pages




//vue routes
const routes = [
    {
        path: "/",
        component:Home,
        name: 'home',
    },
    {
        path: "/product/:slug",
        component:Product,
        name: 'product',
    },
    
    
];

 




const router = new VueRouter({
    routes,
    mode: 'history',
  });



export default router;  
 