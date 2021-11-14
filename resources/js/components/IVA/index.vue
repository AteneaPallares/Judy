<template>
  <div class="container-fluid">
    <h2 class="text-dark m-4">IVA</h2>
    <div id="" class="card shadow">
      <div class="m-19">
        <div class="card-header py-3">
          <h5 class="text-primary font-weight-bold">Listado</h5>
        </div>
        <div class="card-body">
          <div class="row col-12 m-0 p-0">
            <div class="text-left col-sm-3 col-lg-2 col-xl-1 m-0 p-0">
              <button
                class="btn btn-success col-12 m-0 pl-0 pr-0"
                @click="add()"
              >
                <i class="el-icon-plus"></i>Añadir
              </button>
            </div>
            <div class="text-right col-sm-9 col-lg-10 col-xl-11 m-0 p-0">
              <input
                type="text"
                class="form-control col-lg-4 col-sm-8 d-inline m-0 mt-1 mb-1"
                placeholder="Buscar"
                v-model="search"
                v-on:keyup="searchFunction"
              />
            </div>
          </div>
          <div class="table-responsive table mt-2" role="grid">
            <table class="table my-0">
              <thead>
                <tr class="text-center">
                  <th @click="sort(1)">
                    Id

                    <i
                      v-if="this.searchfield == 1 && this.asc == false"
                      class="text-success el-icon-caret-top"
                    />
                    <i
                      v-if="this.searchfield == 1 && this.asc == true"
                      class="text-primary el-icon-caret-bottom"
                    />
                  </th>
                  <th @click="sort(2)" class="w-25">
                    Porcentaje
                    <i
                      v-show="this.searchfield == 2 && this.asc == false"
                      class="text-success el-icon-caret-top"
                    />
                    <i
                      v-show="this.searchfield == 2 && this.asc == true"
                      class="text-primary el-icon-caret-bottom"
                    />
                  </th>
                  <th @click="sort(3)">
                    Fecha de Inicio
                    <i
                      v-if="this.searchfield == 3 && this.asc == false"
                      class="text-success el-icon-caret-top"
                    />
                    <i
                      v-if="this.searchfield == 3 && this.asc == true"
                      class="text-primary el-icon-caret-bottom"
                    />
                  </th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(props, index) in data"
                  v-bind:key="props.id"
                  class="text-center"
                >
                  <td>
                    {{ props.id }}
                  </td>
                  <td>
                    {{ props.porcentage }}
                  </td>
                  <td>
                    {{ getDate(props.start) }}
                  </td>
                  <td class="m-0 p-0 w-10">
                    <div class="col-12 m-0">
                      <button
                        class="btn btn-info m-1 col-xl-3 col-xs-12"
                        @click="onClickDetails(props.id)"
                      >
                        <i class="el-icon-view"></i>
                      </button>

                      <button
                        class="
                          btn btn-secondary
                          m-1
                          col-xl-3 col-xs-12
                          border-dark
                        "
                        @click="onClickEdit(props.id)"
                      >
                        <i class="el-icon-edit"></i>
                      </button>

                      <button
                        class="btn btn-danger m-1 col-xl-3 col-xs-12"
                        @click="onClickDelete(props.id, index, props)"
                      >
                        <i class="el-icon-delete"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <tr v-if="data.length == 0">
                  <td colspan="5">
                    <h3 class="bg-red" v-if="data.length == 0">
                      NO SE ENCONTRARON REGISTROS!!!
                    </h3>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="text-center">
                  <th @click="sort(1)">
                    Id

                    <i
                      v-if="this.searchfield == 1 && this.asc == false"
                      class="text-success el-icon-caret-top"
                    />
                    <i
                      v-if="this.searchfield == 1 && this.asc == true"
                      class="text-primary el-icon-caret-bottom"
                    />
                  </th>
                  <th @click="sort(2)" class="w-25">
                    Nombre
                    <i
                      v-show="this.searchfield == 2 && this.asc == false"
                      class="text-success el-icon-caret-top"
                    />
                    <i
                      v-show="this.searchfield == 2 && this.asc == true"
                      class="text-primary el-icon-caret-bottom"
                    />
                  </th>
                  <th @click="sort(3)">
                    Fecha de Inicio
                    <i
                      v-if="this.searchfield == 3 && this.asc == false"
                      class="text-success el-icon-caret-top"
                    />
                    <i
                      v-if="this.searchfield == 3 && this.asc == true"
                      class="text-primary el-icon-caret-bottom"
                    />
                  </th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="pagination col-12 p-0">
            <div class="text-left col-8">
              <span class="text-black"
                >Mostrando {{ data.length }} de {{ this.aux.length }}</span
              >
            </div>
            <div class="text-right col-4 p-0">
              <!-- <button class="btn btn-default p-0 mr-1" @click="Prev(-1)" :disabled="actual==0"><i class="el-icon-arrow-left"></i></button>
                            <span class="">{{actual+1}} de {{max}}</span>
                            <button class="btn btn-default p-0 ml-1" @click="Prev(1)" :disabled="actual+1==max"><i class="el-icon-arrow-right"></i></button> -->
              <nav
                class="
                  d-lg-flex
                  justify-content-lg-end
                  dataTables_paginate
                  paging_simple_numbers
                "
              >
                <ul class="pagination">
                  <li class="page-item" v-if="actual + 1 > 1">
                    <a class="page-link" @click="Prev(-1)" aria-label="Previous"
                      ><span aria-hidden="true">«</span></a
                    >
                  </li>
                  <li class="page-item disabled" v-else>
                    <a class="page-link" @click="Prev(-1)" aria-label="Previous"
                      ><span aria-hidden="true">«</span></a
                    >
                  </li>
                  <li class="page-item" v-if="actual + 1 == max && actual >= 2">
                    <a class="page-link" @click="Prev(-2)">{{ actual - 1 }}</a>
                  </li>
                  <li class="page-item" v-if="actual + 1 > 1">
                    <a class="page-link" @click="Prev(-1)">{{ actual }}</a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">{{ actual + 1 }}</a>
                  </li>
                  <li class="page-item" v-if="max > actual + 1">
                    <a class="page-link" @click="Prev(1)">{{ actual + 2 }}</a>
                  </li>
                  <li class="page-item" v-if="actual == 0 && max >= actual + 3">
                    <a class="page-link" @click="Prev(2)">{{ actual + 3 }}</a>
                  </li>
                  <li class="page-item" v-if="actual + 1 < max">
                    <a class="page-link" @click="Prev(1)" aria-label="Next"
                      ><span aria-hidden="true">»</span></a
                    >
                  </li>
                  <li class="page-item disabled" v-else>
                    <a class="page-link" @click="Prev(1)" aria-label="Next"
                      ><span aria-hidden="true">»</span></a
                    >
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      data: [],
      search: "",
      asc: false,
      content: [],
      min: 0,
      actual: 0,
      max: 0,
      pagesize: 10,
      aux: [],
      urlactive: "",
      searchfield: 1,
    };
  },
  mounted() {
    axios
      .get("/iva/all")
      .then((res) => {
        console.log(res.data);
        this.content = res.data;
        this.aux = this.content;
        this.max = Math.ceil(this.content.length / this.pagesize);
        this.actual = 0;
        this.update();
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Conexión inválida"
        );
        console.log(error);
      });
  },
  methods: {
    onClickEdit($idy) {
      const ediId = $idy;
      window.location.href = "/iva/editar/" + ediId + "/";
      //this.$emit("edit", ediId);
    },
    onClickDetails($idy) {
      const ediId = $idy;
      window.location.href = "/iva/detalle/" + ediId + "/";
      //this.$emit("details", ediId);
    },
    foundIt(strword2, word2) {
      var strword = strword2 == null ? "" : strword2.toString();
      var word = word2 == null ? "" : word2.toString();
      return strword.toLowerCase().indexOf(word.toLowerCase().trim()) > -1;
    },
    searchFunction() {
      const params = {
        search: this.search,
      };
      if (this.search == "") {
        this.aux = this.content;
        this.max = Math.ceil(this.aux.length / this.pagesize);
        this.actual = 0;
        this.update();
      } else {
        this.aux = [];
        this.content.forEach((value, index) => {
          if (this.foundIt(value.porcentage, this.search)) {
            this.aux.push(value);
          } else if (this.foundIt(value.id, this.search)) {
            this.aux.push(value);
          } else if (this.foundIt(this.getDate(value.start), this.search)) {
            this.aux.push(value);
          } 
        });
        this.max = Math.ceil(this.aux.length / this.pagesize);
        this.actual = 0;
        this.update();
      }
    },
    sortaux(str) {
      if (this.asc) {
        this.aux.sort((a, b) =>
          a[str] < b[str] ? -1 : Number(a[str] > b[str])
        );
      } else {
        this.aux.sort((a, b) =>
          a[str] > b[str] ? -1 : Number(a[str] < b[str])
        );
      }
    },
    sort($op) {
      this.searchfield = $op;
      if ($op == 1) {
        this.sortaux("id");
      } else if ($op == 2) {
        this.sortaux("porcentage");
      } else if ($op == 3) {
        let str='start';
         if (this.asc) {
        this.aux.sort((a, b) =>
          this.getDateO(a[str]) < this.getDateO(b[str]) ? -1 : Number(this.getDateO(a[str]) > this.getDateO(b[str]))
        );
      } else {
        this.aux.sort((a, b) =>
          this.getDateO(a[str]) > this.getDateO(b[str]) ? -1 : Number(this.getDateO(a[str]) < this.getDateO(b[str]))
        );
      }
      } 
      this.asc = !this.asc;
      this.actual = 0;
      this.update();
    },

    Prev($k) {
      if (this.actual + $k < 0 || this.actual + $k > this.max) return 0;
      this.actual = this.actual + $k;
      this.update();
    },
    Next() {
      if (this.aux.length > this.actual * this.pagesize + this.pagesize)
        this.actual++;
      this.update();
    },
    update() {
      if (this.actual >= this.max) this.actual--;
      this.data = this.aux.slice(
        this.actual * this.pagesize,
        this.actual * this.pagesize + this.pagesize
      );
    },
    onClickDelete($idc, $iddel, $ivad) {
      this.$confirm(
        "Realmente desea eliminar al iva " + $ivad.porcentage,
        "Alerta",
        {
          confirmButtonText: "Continuar",
          cancelButtonText: "Cancelar",
          type: "warning",
        }
      )
        .then(() => {
          axios
            .delete(`/iva/${$idc}/`)
            .then((response) => {
              if (response.data != 1) {
                this.showErrorNotification(
                  "Error al eliminar",
                  "El iva se encuentra asignado"
                );
              } else {
                this.showSuccessNotification(
                  "Eliminar",
                  "iva eliminado"
                );
                var index = this.aux.findIndex((i) => i.id === $idc);
                if (index != -1) this.aux.splice(index, 1);
                axios.get("/iva/all").then((res) => {
                  this.content = res.data;
                  this.aux = this.content;
                  this.max = Math.ceil(this.content.length / this.pagesize);
                  this.actual = 0;
                  this.update();
                });
              }
            })
            .catch((error) => {
              this.showErrorNotification(
                "Error al eliminar",
                "Conexión inválida"
              );
              console.log(error);
            });
        })
        .catch(() => {
          this.$notify({
            type: "info",
            title: "Eliminación cancelada",
            message: "La eliminación ha sido cancelada",
          });
        });
    },
    getDate(dat) {
      var d = new Date(dat);
      console.log(d);
      var datestring =
        ("0" + d.getDate()).slice(-2) +
        "/" +
        ("0" + (d.getMonth() + 1)).slice(-2) +
        "/" +d.getFullYear();
      console.log(d.getDay());
      console.log(datestring);
      return datestring;
    },
    getDateO(dat) {
      var d = new Date(dat);
      var datestring =
      d.getFullYear()+
        ("0" + (d.getMonth() + 1)).slice(-2) +
        "/" +
        ("0" + d.getDate()).slice(-2) +
        "/" ;
      return datestring;
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
    add() {
      window.location.href = "/iva/agregar";
    },
  },
};
</script>
