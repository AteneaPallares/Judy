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
                  Registro de proveedor
                </h5>
                <h5
                  v-if="number == 1"
                  class="text-primary m-0 font-weight-bold"
                >
                  Editar proveedor
                </h5>
                <h5
                  v-if="number == 2"
                  class="text-primary m-0 font-weight-bold"
                >
                  Detalles de proveedor
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
                  >Registrar proveedor</el-button
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
                      <img
                        @dragenter="OnDragEnter"
                        @dragleave="OnDragLeave"
                        @dragover.prevent
                        @drop="onDrop"
                        id="pic"
                        class="rounded-circle shadow"
                        height="200"
                        width="200"
                        :class="{ dragging: isDragging }"
                      />
                      <br /><br />
                      <div class="col-md-3 col-lg-3 m-auto">
                        <label id="deleteImg" class="label">
                          <input type="button" @click="this.deleteImg" /><span
                            >Eliminar</span
                          ></label
                        >
                      </div>

                      <div
                        class="col-md-3 col-lg-3 m-auto"
                        v-show="number != 2"
                      >
                        <label class="label">
                          <input
                            type="file"
                            enctype="multipart/form-data"
                            @change="onInputChange"
                            class="col-lg-3"
                            id="customFile"
                          />
                          <span>Upload</span>
                        </label>
                      </div>
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
                        <strong>Nombre</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="name"
                          v-model="user.name"
                          placeholder="Nombre(s) Apellido(s)"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Empresa</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="address"
                          placeholder="Ingrese compañia"
                          v-model="user.enterprise"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Teléfono</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="phone"
                          placeholder="Ejem. (+52) 3345234532"
                          v-model="user.phone"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Correo</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="email"
                          placeholder="Ejem. example@examp.com"
                          v-model="user.email"
                          :readonly="number == 2"
                        />
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
      urlactive: "",
      roles: [],
      editid: this.detailsid,
      array: [],
      isDragging: false,
      dragCount: 0,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      images: [],
      nuevo: [],
      show: false,
      user: {
        id: null,
        name: null,
        email: null,
        img: null,
        phone: null,
        enterprise: null,
      },
      radio1: "Hombre",
      confirmationp: null,
      value: "",
    };
  },
  mounted() {
    axios.get("/roles").then((res) => {
      this.roles = res.data;
      console.log(this.roles);
    });

    if (this.number != 0) {
      axios.get(`/proveedores/detalleone/${this.editid}`).then((response) => {
        console.log(response.data);

        this.user = response.data;
        this.nuevo = this.user.id_role;
        if (this.user.gender == 1) {
          this.user.gender = "1";
        } else {
          this.user.gender = "0";
        }
        if (this.user.img == null) {
          document.getElementById("pic").src = "../../../../storage/drop.png";
          document.getElementById("deleteImg").style.visibility = "hidden";
        } else {
          document.getElementById("pic").src =
            "../../../../storage/" + this.user.img;
          if (this.number != 2) {
            document.getElementById("deleteImg").style.visibility = "visible";
          }
        }
      });
    }
    if (this.user.img == null) {
      document.getElementById("pic").src = "../../../../storage/drop.png";
      document.getElementById("deleteImg").style.visibility = "hidden";
    }
  },
  methods: {
    validate() {
      if (
        !(
          this.user.name != null &&
          this.user.name != "" &&
          this.user.enterprise != null &&
          this.user.enterprise != "" &&
          this.user.phone != null &&
          this.user.phone != "" &&
          this.user.email != null &&
          this.user.email != ""
        )
      ) {
        this.showErrorNotification(
          "Agregando proveedor",
          "Complete la información de los campos requeridos"
        );
        return false;
      }

      return true;
    },
    edit() {
      console.log(this.user);
      this.user._token = this.csrf;
      if (this.validate()) {
        axios.post("/proveedores", this.user).then((response) => {
          if (_.isNumber(response.data.response)) {
            this.editid = response.data.response;
            this.showSuccessNotification(
              "Agregando proveedor",
              "Información guardada con éxito"
            );
            if (this.number == 0) {
              this.user = {
                id: null,
                name: null,
                email: null,
                img: null,
                phone: null,
                enterprise: null,
              };
            }
          } else if (response.data.errors) {
            console.log(response.data.errors);
            let exampleObj = response.data.errors;
            let errors = "";
            for (let key in exampleObj) {
              if (exampleObj.hasOwnProperty(key)) {
                let value = exampleObj[key];
                console.log(key, value[0]);
                errors += "*";
                errors += value[0];
                errors += "\n\n";
              }
            }
            console.log(errors);
            this.showErrorNotification("Validación", errors);
            return;
          } else {
            this.showErrorNotification("Error", response.data.response);
            return;
          }
          console.log(this.editid);
          const params = new FormData();
          let img = document.getElementById("pic");
          if (
            document.getElementById("deleteImg").style.visibility === "visible"
          ) {
            let canvas = document.createElement("canvas");
            canvas.width = img.naturalWidth;
            canvas.height = img.naturalHeight;
            let context = canvas.getContext("2d");
            context.drawImage(img, 0, 0);
            var url = canvas.toDataURL();
            var blobBin = atob(url.split(",")[1]);
            var array = [];
            for (var i = 0; i < blobBin.length; i++) {
              array.push(blobBin.charCodeAt(i));
            }
            var file2 = new Blob([new Uint8Array(array)], {
              type: "image/png",
            });
            params.append("imagen", file2);
            params.append("editImage", this.editid);
          } else if (this.editid != null) {
            params.append("deleteImage", this.editid);
          }
          console.log(params);
          axios.post("/proveedores", params).then((response) => {
            console.log(response);
            if (_.isNumber(response.data)) {
              this.showSuccessNotification(
                "Agregando proveedor",
                "Imagen guardada con éxito"
              );
              if(this.number==0){
                this.deleteImg();
              }
            }
          });
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
    OnDragEnter(e) {
      e.preventDefault();
      this.dragCount++;
      this.isDragging = true;
    },
    OnDragLeave(e) {
      e.preventDefault();
      this.dragCount--;
      if (this.dragCount <= 0) {
        this.isDragging = false;
      }
    },
    onDrop(e) {
      e.preventDefault();
      e.stopPropagation();
      this.dragCount = 0;
      this.isDragging = false;
      const files = e.dataTransfer.files;
      Array.from(files).forEach((file) => this.addImage(file));
    },
    onInputChange(e) {
      const files = e.target.files;
      Array.from(files).forEach((file) => this.addImage(file));
    },
    addImage(file) {
      if (!file.type.match("image.*")) {
        this.showErrorNotification("Añadir Imagen", "No es una imagen");
        return;
      }
      document.getElementById("deleteImg").style.visibility = "visible";
      var im = document.getElementById("pic");
      document.getElementById("pic").style.visibility = "visible";
      const img = new Image(),
        reader = new FileReader();
      reader.onload = (e) => (im.src = e.target.result);
      reader.readAsDataURL(file);
    },
    deleteImg() {
      document.getElementById("deleteImg").style.visibility = "hidden";
      document.getElementById("pic").src = "../../../../storage/drop.png";
    },
    editLink() {
      window.location = "/proveedores/editar/" + this.editid;
    },
    ret() {
      window.location = "/proveedores";
    },
    addShow() {
      this.show = true;
    },
    showchange() {
      console.log(this.user);
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
input[readonly],
input[readonly="readonly"] {
  background-color: rgb(248, 247, 247);
}
textarea[readonly="readonly"],
textarea[readonly] {
  background-color: rgb(248, 247, 247);
}
.label:valid + span {
  color: #ffffff;
}
</style>
