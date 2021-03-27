<template>
  <v-container>
    <v-row>
      <v-col cols="12" class="d-flex align-items-center justify-space-between">
        <h1>Atividades esportivas</h1>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="green accent-3"
              dark
              fab
              small
              v-bind="attrs"
              v-on="on"
              @click="openCreateActivityDialog()"
            >
              <v-icon dark>add</v-icon>
            </v-btn>
          </template>
          <span>Add new sport activity</span>
        </v-tooltip>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: 'CreateSportActivity',
  methods: {
    openCreateActivityDialog() {},
  },
};
</script>

<style>
</style>
