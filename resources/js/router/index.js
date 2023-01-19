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
import NoProjectFound from "../pages/NoProjectFound.vue";


import axios from "axios";
import config from "../axios/config";
import store from "../store/store";

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
        beforeEnter: (to, from, next) => {
            axios
                .get(`${config.apiUrl}/authenticated`)
                .then(() => {
                    return next({ name: "dashboard" });
                })
                .catch(() => {
                    next();
                });
        },
    },
    {
        path: "/register",
        component: RegisterPage,
        name: "register",
        beforeEnter: (to, from, next) => {
            axios
                .get(`${config.apiUrl}/authenticated`)
                .then(() => {
                    return next({ name: "dashboard" });
                })
                .catch(() => {
                    next();
                });
        },
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
                beforeEnter: (to, from, next) => {
                    const project = store.state.user.projects.find(
                        (project) => project.id == to.params.id
                    );
                    if (store.state.user.role_id == 1) {
                        return next();
                    } else if (!project) {
                        return next({ name: "notAllowed" });    
                    } else {
                        return next();
                    }
                },
            },
            {
                path: "/projects/:p_id/ticket/:t_id",
                component: TicketView,
                name: "ticketView",
                params: true,
                beforeEnter: (to, from, next) => {
                    store.dispatch("getTicketWithDetails", to.params.t_id);
                    const ticket = store.state.user.tickets.find(
                        (ticket) => ticket.id == to.params.t_id
                    );
                    const project = store.state.user.projects.find(
                        (project) => project.id == to.params.p_id
                    );
                    if (store.state.user.role_id == 1) {
                        return next();
                    } else if (!ticket || !project) {
                        return next({ name: "notAllowed" });
                    } else {
                        next();
                    }
                },
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
        path: "/not-allowed",
        component: NoProjectFound,
        name: "notAllowed",
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
