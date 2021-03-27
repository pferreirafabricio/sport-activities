<template>
  <v-container>
    <CreateSportActivity @newActivityCreated="getAllEvents()"/>
    <vue-cal
      active-view="week"
      locale="pt-br"
      :disable-views="['years', 'year']"
      :events="events"
    />
  </v-container>
</template>

<script>
import VueCal from "vue-cal";
import "vue-cal/dist/vuecal.css";

import api from "@/api";

import CreateSportActivity from "../components/CreateSportActivity/Index.vue";

export default {
  name: "Calendar",
  components: { VueCal, CreateSportActivity },
  data() {
    return {
      events: [],
      loading: false,
    };
  },
  created() {
    this.getAllEvents();
  },
  methods: {
    getAllEvents() {
      this.loading = true;
      api
        .get("/sports/activies")
        .then((response) => {
          this.events = response.data.data;

          // Add the yellow background
          this.events.forEach((event) => {
            event["class"] = "sport_activity";

            if (!event["content"]) {
              event["content"] =
                '<span class="material-icons">fitness_center</span>';
            }
          });
        })
        .catch(() => {})
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>

<style>
.sport_activity {
  background-color: #ffeb3b;
}
</style>
