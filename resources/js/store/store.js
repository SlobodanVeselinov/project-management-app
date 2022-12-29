import { createStore } from "vuex";
import router from "../router";
import createPersistedState from "vuex-persistedstate";
import config from "../axios/config";

const store = createStore({
    plugins: [createPersistedState()],
    state() {
        return {
            user: null,
            allUsers: null,
            developers: null,
            roles: null,
            assignedDevelopers: null,
            freeDevelopers: null,
            isLoggedIn: false,
            allProjects: null,
            loading: false,
            errors: null,
            userTickets: null,
            ticket: null,
        };
    },

    mutations: {
        setLoggedUser(state, payload) {
            state.user = payload;
            state.isLoggedIn = true;
        },

        setDevelopers(state, payload) {
            state.developers = payload;
        },

        setUsers(state, payload) {
            state.allUsers = payload;
        },

        setRoles(state, payload) {
            state.roles = payload;
        },

        setAssignedDevelopers(state, payload) {
            state.assignedDevelopers = payload;
        },

        setFreeDevelopers(state, payload) {
            state.freeDevelopers = payload;
        },

        unsetUser(state) {
            // state.user = null;
            state.isLoggedIn = false;
        },

        setProjects(state, payload) {
            state.allProjects = payload;
        },

        setLoading(state, payload) {
            state.loading = payload;
        },

        setErrors(state, payload) {
            state.errors = payload;
        },

        setTickets(state, payload) {
            state.userTickets = payload;
        },
        setTicket(state, payload) {
            state.ticket = payload;
        },
    },

    actions: {
        getLoggedUser(context) {
            axios
                .get(`${config.apiUrl}/user`)
                .then((response) => {
                    context.commit("setLoggedUser", response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getAllDevelopers(context) {
            axios
                .get(`${config.apiUrl}/getAllDevelopers`)
                .then((response) => {
                    context.commit("setDevelopers", response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getAllUsers(context) {
            axios
                .get(`${config.apiUrl}/getAllUsers`)
                .then((response) => {
                    context.commit("setUsers", response.data);
                    this.commit("setLoading", false);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getDevelopers(context, id) {
            axios
                .get(`${config.apiUrl}/getAssignedDevelopers/` + id)
                .then((response) => {
                    context.commit("setAssignedDevelopers", response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getFreeDevelopers(context, id) {
            axios
                .get(`${config.apiUrl}/freeDevelopers/` + id)
                .then((response) => {
                    context.commit("setFreeDevelopers", response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getRoles(context) {
            axios
                .get(`${config.apiUrl}/getRoles`)
                .then((response) => {
                    context.commit("setRoles", response.data);
                    // console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getTickets(context, project_id) {
            axios
                .get(
                    `${config.apiUrl}/projects/` +
                        project_id +
                        `/tickets/` +
                        this.state.user.id
                )
                .then((response) => {
                    context.commit("setTickets", response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getTicketWithDetails(context, ticket_id) {
            axios
                .get(`${config.apiUrl}/projects/tickets/` + ticket_id)
                .then((response) => {
                    context.commit("setTicket", response.data);
                    // console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getProjects(context) {
            axios
                .get(`${config.apiUrl}/projects`)
                .then((response) => {
                    context.commit("setProjects", response.data);
                    // console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        createProject({ dispatch }, payload) {
            this.commit("setLoading", true);
            axios
                .post(`${config.apiUrl}/createProject`, payload)
                .then(() => {
                    dispatch("getProjects");
                    this.commit("setLoading", false);
                    // console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        assignDeveloper({ dispatch }, payload) {
            this.commit("setLoading", true);
            axios
                .post(`${config.apiUrl}/assign-developer-to-ticket`, payload)
                .then(() => {
                    dispatch("getTicketWithDetails", payload.ticket_id);
                    this.commit("setLoading", false);
                    // console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        createTicket({ dispatch }, payload) {
            this.commit("setLoading", true);
            axios
                .post(`${config.apiUrl}/createTicket`, payload)
                .then((response) => {
                    dispatch("getTickets", response.data.project_id);
                    this.commit("setLoading", false);
                    // console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        createUser({ dispatch }, payload) {
            this.commit("setLoading", true);
            axios
                .post(`${config.apiUrl}/createUser`, payload)
                .then(() => {
                    dispatch("getAllUsers");
                    this.commit("setLoading", false);
                    // console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        addToTeam({ dispatch }, payload) {
            axios
                .post(`${config.apiUrl}/addTeamMember`, payload)
                .then(() => {
                    dispatch("getDevelopers", payload.project_id);
                    dispatch("getFreeDevelopers", payload.project_id);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        removeFromTeam({ dispatch }, payload) {
            axios
                .post(`${config.apiUrl}/removeTeamMember`, payload)
                .then(() => {
                    dispatch("getDevelopers", payload.project_id);
                    dispatch("getFreeDevelopers", payload.project_id);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        updateChanges({ dispatch }, payload) {
            axios
                .post(`${config.apiUrl}/updateUser`, payload)
                .then((response) => {
                    dispatch("getAllUsers");
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        registerUser({ dispatch }, form) {
            axios
                .post("/api/register", form)
                .then(() => {
                    this.state.errors = null;
                    this.$router.push({ name: "login" });
                })
                .catch((error) => {
                    this.commit("setErrors", error.response.data.errors);
                });
        },

        loginUser({ dispatch }, formData) {
            axios.get(`${config.apiUrl}/sanctum/csrf-cookie`).then(() => {
                // Login...
                axios
                    .post(`${config.apiUrl}/login`, formData)
                    .then(() => {
                        dispatch("getLoggedUser");
                        dispatch("getProjects");
                        this.state.errors = null;
                        router.push({ name: "dashboard" });
                    })
                    .catch((error) => {
                        this.commit("setErrors", error.response.data.errors);
                        // console.log(error);
                    });
            });
        },

        removeUser({ dispatch }, payload) {
            this.commit("setLoading", true);
            axios
                .post(`${config.apiUrl}/deleteUser`, payload)
                .then((response) => {
                    dispatch("getAllUsers");
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        logout(context) {
            axios
                .post(`${config.apiUrl}/logout`)
                .then(() => {
                    router.push({ name: "home" });
                    context.commit("unsetUser");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    getters: {},
});

export default store;
