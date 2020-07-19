import Vue from "vue";
import VueRouter from "vue-router";

import PageHome from "./pages/Products";
import PageCategories from "./pages/Categories";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            component: PageHome
        },
        {
            path: "/categories",
            component: PageCategories
        }
    ]
});

export default router;
