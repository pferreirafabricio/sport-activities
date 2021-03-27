<template>
  <v-dialog v-model="open" max-width="700">
    <v-card>
      <v-card-title class="headline grey lighten-2">
        Criar nova atividade
      </v-card-title>

      <v-card-text>
        <v-form v-model="formIsValid">
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
                      :rules="Rules.date"
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
                      :rules="Rules.startHour"
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
                      :rules="Rules.endHour"
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
          :loading="loading"
          @click="createSportActivity()"
        >
          <span>Criar</span>
          <v-icon class="ml-1">check</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
    <!-- Notification -->
    <v-snackbar
      absolute
      top
      outlined
      right
      v-model="notification.show"
      :color="notification.color"
      :timeout="2000"
    >
      {{ notification.text }}

      <template v-slot:action="{ attrs }">
        <v-btn
          :color="notification.color"
          text
          v-bind="attrs"
          @click="notification.show = false"
        >
          <v-icon>close</v-icon>
        </v-btn>
      </template>
    </v-snackbar>
  </v-dialog>
</template>

<script>
import api from '@/api';

export default {
  name: 'CreateSportActivityDialog',
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
        date: [
          (v) => !!v || "A data é obrigatória",
        ],
        startHour: [
          (v) => !!v || "A hora de ínicio é obrigatória",
        ],
        endHour: [
          (v) => !!v || "A hora de fim é obrigatória",
        ],
      },
      loading: false,
      open: false,
      repeat: false,
      formIsValid: false,
      showDatePicker: false,
      showTimeStartPicker: false,
      showTimeEndPicker: false,
      notification: {
        show: false,
        text: '',
        color: 'success',
      },
    };
  },
  methods: {
    createSportActivity() {
      if (!this.formIsValid) {
        this.notification.show = true;
        this.notification.text = 'Por favor, revise todos os campos';
        this.notification.color = 'warning';
        return;
      }

      this.loading = true;
      api.post('/sports/activity', this.Fields)
        .then(() => {
          this.notification.show = true;
          this.notification.text = 'Atividade criada com sucesso';
          this.notification.color = 'success';

          this.open = false;
          this.cleanData();
        })
        .catch(() => {
          this.notification.show = true;
          this.notification.text = 'Houve um problema ao criar a atividade';
          this.notification.color = 'error';
        })
        .finally(() => {
          this.loading = false;
        });
    },
    toggleDialogExhibition() {
      this.open = !this.open;
    },
    cleanData() {
      Object.keys(this.Fields).forEach(([key]) => {
        this.Fields[key] = '';
      });
    },
  },
};
</script>

<style>
</style>
