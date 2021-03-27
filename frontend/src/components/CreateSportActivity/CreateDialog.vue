<template>
  <v-dialog v-model="open" max-width="700">
    <v-card>
      <v-card-title class="headline grey lighten-2">
        Criar nova atividade
      </v-card-title>

      <v-card-text>
        <v-form>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="Fields.name"
                  :rules="Rules.name"
                  :counter="60"
                  label="Nome"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-textarea
                  clearable
                  auto-grow
                  rows="3"
                  label="Descrição (opcional)"
                  v-model="Fields.description"
                  :rules="Rules.description"
                  :counter="255"
                ></v-textarea>
              </v-col>

              <!-- Select date -->
              <v-col cols="12">
                <v-dialog
                  persistent
                  width="290px"
                  ref="datePicker"
                  v-model="showDatePicker"
                  :return-value.sync="Fields.date"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      readonly
                      label="Data da atividade"
                      prepend-icon="mdi-calendar"
                      v-model="Fields.date"
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="Fields.date" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="showDatePicker = false">
                      Cancelar
                    </v-btn>
                    <v-btn
                      text
                      color="primary"
                      @click="$refs.datePicker.save(Fields.date)"
                    >
                      Ok
                    </v-btn>
                  </v-date-picker>
                </v-dialog>
              </v-col>

              <!-- Select start time -->
              <v-col cols="12" sm="6">
                <v-dialog
                  ref="timeStartPicker"
                  v-model="showTimeStartPicker"
                  :return-value.sync="Fields.startHour"
                  persistent
                  width="290px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="Fields.startHour"
                      label="Ínicio"
                      prepend-icon="mdi-clock-time-four-outline"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-time-picker
                    full-width
                    format="24hr"
                    v-if="showTimeStartPicker"
                    v-model="Fields.startHour"
                  >
                    <v-spacer></v-spacer>
                    <v-btn
                      text
                      color="primary"
                      @click="showTimeStartPicker = false"
                    >
                      Fechar
                    </v-btn>
                    <v-btn
                      text
                      color="primary"
                      @click="$refs.timeStartPicker.save(Fields.startHour)"
                    >
                      Ok
                    </v-btn>
                  </v-time-picker>
                </v-dialog>
              </v-col>

              <!-- Select end time -->
              <v-col cols="12" sm="6">
                <v-dialog
                  ref="timeEndPicker"
                  v-model="showTimeEndPicker"
                  :return-value.sync="Fields.endHour"
                  persistent
                  width="290px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="Fields.endHour"
                      label="Termino"
                      prepend-icon="mdi-clock-time-four-outline"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-time-picker
                    full-width
                    format="24hr"
                    v-if="showTimeEndPicker"
                    v-model="Fields.endHour"
                  >
                    <v-spacer></v-spacer>
                    <v-btn
                      text
                      color="primary"
                      @click="showTimeEndPicker = false"
                    >
                      Fechar
                    </v-btn>
                    <v-btn
                      text
                      color="primary"
                      @click="$refs.timeEndPicker.save(Fields.endHour)"
                    >
                      Ok
                    </v-btn>
                  </v-time-picker>
                </v-dialog>
              </v-col>

              <!-- Repeat? -->
              <v-col cols="12" sm="12" md="2">
                <v-checkbox v-model="repeat" label="Repetir"></v-checkbox>
              </v-col>

              <v-col cols="12" sm="12" md="12" v-if="repeat">
                <v-slider
                  label="Intervalo de semanas"
                  thumb-color="yellow"
                  thumb-label="always"
                  :max="1"
                  :min="52"
                  value=""
                  v-model="Fields.recurrence"
                ></v-slider>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
      </v-card-text>

      <v-divider></v-divider>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="error" text @click="open = false"> Fechar </v-btn>
        <v-btn
          dark
          color="green accent-3"
          class="d-flex align-items-center"
          @click="createSportActivity()"
        >
          <span>Criar</span>
          <v-icon class="ml-1">check</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data() {
    return {
      Fields: {
        name: "",
        description: "",
        date: "",
        startHour: "",
        endHour: "",
        recurrence: 0,
      },
      Rules: {
        name: [
          (v) => !!v || "Nome é obrigatório",
          (v) => v.length <= 60 || "O nome deve ter no máximo 60 caracteres",
        ],
        description: [
          (v) => v.length <= 255 || "A descrição deve ter no máximo 255 caracteres",
        ],
      },
      open: false,
      repeat: false,
      showDatePicker: false,
      showTimeStartPicker: false,
      showTimeEndPicker: false,
    };
  },
  methods: {
    createSportActivity() {},
    toggleDialogExhibition() {
      this.open = !this.open;
    },
  },
};
</script>

<style>
</style>
