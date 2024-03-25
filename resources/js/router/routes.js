// Pages
import Index from "../pages/Index.vue";
import Products from "../pages/Products.vue";
import Checkout from "../pages/Checkout.vue";
import Categories from "../pages/Categories.vue";
import Success from "../pages/Success.vue";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
// Components
import SingleProduct from "../components/Products/SingleProduct.vue";

const routes = [
    { path: "/", component: Index },
    { path: "/products", component: Products },
    {
        name: "single.product",
        path: "/product/:slug",
        component: SingleProduct,
        props: true,
    },
    { path: "/checkout", component: Checkout },
    { path: "/categories", component: Categories },
    { path: "/success", component: Success },
    { path: "/login", component: Login },
    { path: "/register", component: Register },
];

export default routes;
