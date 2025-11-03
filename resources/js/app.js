import "./bootstrap";

import { createApp } from "vue";
import MovieDisplay from "./components/MovieDisplay.vue";

const app = createApp({});
app.component("movie-display", MovieDisplay);
app.mount("#app");
