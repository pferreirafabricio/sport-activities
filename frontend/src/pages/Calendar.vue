<template>
  <vue-cal
    active-view="week"
    :disable-views="['years', 'year']"
    :events="events"
  />
</template>

<script>
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'

export default {
  name: 'Calendar',
  components: { VueCal },
  data() {
    return {
      events: [
        {
          start: '2021-03-27 14:30',
          end: '2021-03-27 20:30',
          title: 'Need to go shopping',
          class: 'sport_activity'
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
