import Vue from "vue";
import Router from "vue-router";
import home from "./components/pages/home";
import tags from "./components/pages/tags";
import firstPage from "./components/pages/myFirstVuePage";
import newRoutePage from "./components/pages/newRoutePage";
import hooksPage from "./components/pages/basic/hooks";
import methodsPage from "./components/pages/basic/methods";

Vue.use(Router);

const routes = [
    {
        path: "/",
        component: home
    },
    {
        path: "/tags",
        component: tags
    },
    // basic tutorials routes
    {
        path: "/my-name-vie-route",
        component: firstPage
    },
    {
        path: "/new-route",
        component: newRoutePage
    },
    {
        path: "/hooks",
        component: hooksPage
    },
    {
        path: "/methods",
        component: methodsPage
    }
];

export default new Router({
    mode: "history",
    routes
});
