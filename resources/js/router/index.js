import { createRouter, createWebHistory } from "vue-router";

import Welcome from "../components/Welcome.vue";
import NotFound from "../components/NotFound.vue";

import Employees from "../components/Employees/index.vue";
import CreateEmployee from "../components/Employees/create.vue";

import ShowSingleEmployee from "../components/Employees/show.vue";

const routes = [
    {
        name: "home",
        path: "/",
        component: Welcome,
    },
    {
        name: "create",
        path: "/employees/create",
        component: CreateEmployee,
    },
    {
        name: "employees",
        path: "/employees",
        component: Employees,
    },
    {
        path: "/employees/show/:id",
        component: ShowSingleEmployee,
        props: true,
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
