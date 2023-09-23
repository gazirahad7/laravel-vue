import { createRouter, createWebHistory } from "vue-router";

import Welcome from "../components/Welcome.vue";
import NotFound from "../components/NotFound.vue";

import Employees from "../components/Employees/index.vue";

const routes = [
    {
        name: "home",
        path: "/",
        component: Welcome,
    },
    {
        name: "employees",
        path: "/employees",
        component: Employees,
    },
    {
        path: "/:pathMatch(.*)*",
        component: NotFound,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
