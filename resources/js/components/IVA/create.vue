<template>
  <div class="p-2 text-center">
    <div class="col-sm-4 col-lg-2 text-left m-0 p-0">
      <button class="btn btn-info form-button m-3" type="button" @click="ret()">
        <i class="el-icon-s-fold"></i>
      </button>
      <br />
    </div>
    <div class="d-flex flex-column" id="content-wrapper">
      <div class="table">
        <div class="row">
          <div class="col-lg-12 mb-3">
            <div class="card shadow h-100">
              <div class="card-header">
                <h5
                  v-if="number == 0"
                  class="text-primary m-0 font-weight-bold"
                >
                  Registro de iva
                </h5>
                <h5
                  v-if="number == 1"
                  class="text-primary m-0 font-weight-bold"
                >
                  Editar iva
                </h5>
                <h5
                  v-if="number == 2"
                  class="text-primary m-0 font-weight-bold"
                >
                  Detalles de iva
                </h5>
              </div>
              <div class="m-2" v-show="number != 2">
                <el-button
                  v-if="number != 0"
                  type="success"
                  @click="edit()"
                  plain
                  >Guardar todo</el-button
                >
                <el-button v-else type="success" @click="edit()" plain
                  >Registrar iva</el-button
                >
              </div>
              <div class="m-2" v-show="number == 2">
                <el-button type="warning" @click="editLink()" plain
                  >Editar</el-button
                >
              </div>
              <div class="card-body">
                <div class="col-lg-12">
                  <div class="col-lg-12">
                    <div class="text-center">
                      <img id="pic" height="200px" />
                    </div>
                  </div>
                </div>

                <form>
                  <hr />
                  <h5 class="text-primary m-0 font-weight-bold">
                    Información personal
                  </h5>
                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Porcentaje</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="number"
                          name="name"
                          v-model="iva.porcentage"
                          placeholder="Nombre(s) Apellido(s)"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="block">
                        <strong>Fecha de inicio</strong
                        ><label class="text-danger" v-if="number != 2">
                          *</label
                        >
                        <div>
                          <el-date-picker
                            style="width: 100%"
                            v-model="iva.start"
                            type="date"
                            placeholder="Seleccionar"
                            :readonly="number == 2"
                          >
                          </el-date-picker>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["number", "detailsid"],
  data() {
    return {
      showId: [],
      response: [],
      editAvailable: false,
      editid: this.detailsid,
      iva: {
        id: null,
        start: null,
        porcentage: null,
      },
    };
  },
  mounted() {
    document.getElementById("pic").src = "../../../../storage/iva.jpg";
    if (this.number != 0) {
      axios.get(`/iva/detalleone/${this.editid}`).then((response) => {
        this.iva = response.data;
      });
    }
  },
  methods: {
    validate() {
      if (
        !(
          this.iva.start != null &&
          this.iva.start != "" &&
          this.iva.porcentage != null &&
          this.iva.porcentage != ""
        )
      ) {
        this.showErrorNotification(
          "Agregando ivao",
          "Complete la información de los campos requeridos"
        );
        return false;
      }
      return true;
    },
    edit() {
      console.log(this.iva);
      if (this.validate()) {
        axios.post("/iva", this.iva).then((response) => {
          if (_.isNumber(response.data.response)) {
            this.editid = response.data.response;
            this.showSuccessNotification(
              "Agregando iva",
              "Información guardada con éxito"
            );
            if (this.number == 0) {
              this.iva = {
                id: null,
                start: null,
                porcentage: null,
              };
            }
          } else {
            this.showErrorNotification("Agregando iva", response.data);
            return;
          }
        });
      }
    },
    showSuccessNotification(title, text) {
      this.$notify({
        title: title,
        message: text,
        type: "success",
      });
    },
    showErrorNotification(title, text) {
      this.$notify({
        title: title,
        message: text,
        type: "error",
      });
    },
    editLink() {
      window.location = "/iva/editar/" + this.editid;
    },
    ret() {
      window.location = "/iva";
    },
    addShow() {
      this.show = true;
    },
    showchange() {
      console.log(this.patient);
    },
  },
};
</script>
<style scoped>
.lbl {
  border: 0;
  outline: 0;
  width: 100%;
  border-bottom: 1px solid black;
}
.dragging {
  opacity: 0.3;
}
label.label input[type="file"] {
  position: absolute;
  top: -1000px;
}
label.label input[type="button"] {
  position: absolute;
  top: -1000px;
}
.label {
  cursor: pointer;
  border: 1px solid #cccccc;
  border-radius: 5px;
  padding: 5px 15px;
  background: white;
  display: inline-block;
}
.label:hover {
  background: rgb(202, 201, 201);
}
.label:active {
  background: #9fa1a0;
}
.label:invalid + span {
  color: #000000;
}
.label:valid + span {
  color: #ffffff;
}
</style>
