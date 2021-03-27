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
          <span>Criar nova atividade esportiva</span>
        </v-tooltip>
      </v-col>
    </v-row>
    <CreateDialog
      ref="createDialog"
      @newActivityCreated="$emit('newActivityCreated')"
    />
  </v-container>
</template>

<script>
import CreateDialog from "./CreateDialog.vue";

export default {
  name: "CreateSportActivity",
  emits: ["newActivityCreated"],
  components: { CreateDialog },
  methods: {
    openCreateActivityDialog() {
      this.$refs.createDialog.toggleDialogExhibition();
    },
  },
};
</script>

<style>
</style>
