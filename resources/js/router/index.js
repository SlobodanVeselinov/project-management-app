import * as VueRouter from "vue-router";

import HomePage from "../pages/HomePage.vue";
import LoginPage from "../pages/LoginPage.vue";
import Dashboard from "../pages/Dashboard.vue";
import RegisterPage from "../pages/RegisterPage.vue";
import Projects from "../pages/sub-pages/Projects.vue";
import Project from "../pages/sub-pages/Projects/Project.vue";
import TicketView from "../pages/sub-pages/TicketView.vue";
import Developers from "../pages/sub-pages/Developers.vue";
import ToDo from "../pages/sub-pages/ToDo.vue";
import Notes from "../pages/sub-pages/Notes.vue";
import NotFound from "../pages/NotFound.vue";

import axios from "axios";
import config from "../axios/config";

const routes = [
    {
        path: "/",
        component: HomePage,
        name: "home",
    },
    {
        path: "/login",
        component: LoginPage,
        name: "login",
        // beforeEnter: (to, from, next) => {
        //     axios
        //         .get(`${config.apiUrl}/authenticated`)
        //         .then(() => {
        //             return next({ name: "dashboard" });
        //         })
        //         .catch(() => {
        //             next();
        //         });
        // },
    },
    {
        path: "/register",
        component: RegisterPage,
        name: "register",
        // beforeEnter: (to, from, next) => {
        //     axios
        //         .get(`${config.apiUrl}/authenticated`)
        //         .then(() => {
        //             return next({ name: "dashboard" });
        //         })
        //         .catch(() => {
        //             next();
        //         });
        // },
    },
    {
        path: "/dashboard",
        component: Dashboard,
        name: "dashboard",
        redirect: "/projects",
        children: [
            {
                path: "/projects",
                component: Projects,
                name: "projects",
            },
            {
                path: "/projects/:id",
                component: Project,
                name: "project",
                params: true,
            },
            {
                path: "/projects/:p_id/ticket/:t_id",
                component: TicketView,
                name: "ticketView",
                params: true,
            },
            {
                path: "/developers",
                component: Developers,
                name: "developers",
            },
            {
                path: "/to-do",
                component: ToDo,
                name: "to-do",
            },
            {
                path: "/notes",
                component: Notes,
                name: "notes",
            },
        ],
        beforeEnter: (to, from, next) => {
            axios
                .get(`${config.apiUrl}/authenticated`)
                .then(() => {
                    next();
                })
                .catch(() => {
                    return next({ name: "login" });
                });
        },
    },
    {
        path: "/:pathMatch(.*)*",
        component: NotFound,
        name: "notFound",
    },
];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
});

export default router;
