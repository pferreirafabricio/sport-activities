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
    <CreateDialog ref="createDialog" />
  </v-container>
</template>

<script>
import CreateDialog from './CreateDialog.vue';

export default {
  components: { CreateDialog },
  name: 'CreateSportActivity',
  methods: {
    openCreateActivityDialog() {
      this.$refs.createDialog.toggleDialogExhibition();
    },
  },
};
</script>

<style>
</style>
