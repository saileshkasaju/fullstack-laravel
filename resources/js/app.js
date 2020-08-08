require("./bootstrap");

window.Vue = require("vue");

import ViewUI from "view-design";
import "view-design/dist/styles/iview.css";
import router from "./router";
import common from "./common";

Vue.use(ViewUI);
Vue.mixin(common);

Vue.component("mainapp", require("./components/mainapp.vue").default);
const app = new Vue({
    el: "#app",
    router
});
