<template>
  <v-container>
    <CreateSportActivity />
    <vue-cal
      active-view="week"
      :disable-views="['years', 'year']"
      :events="events"
    />
  </v-container>
</template>

<script>
import VueCal from 'vue-cal';
import 'vue-cal/dist/vuecal.css';
import CreateSportActivity from '../components/CreateSportActivity/Index.vue';

export default {
  name: 'Calendar',
  components: { VueCal, CreateSportActivity },
  data() {
    return {
      events: [
        {
          start: '2021-03-27 14:30',
          end: '2021-03-27 20:30',
          title: 'Need to go shopping',
          class: 'sport_activity',
        },
      ],
    };
  },
  methods: {

  },
};
</script>

<style>
.sport_activity {
  background-color: yellow;
}
</style>
