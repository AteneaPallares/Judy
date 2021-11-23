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
              <div class="card-header mb-3">
                <h5
                  v-if="number == 0"
                  class="text-primary m-0 font-weight-bold"
                >
                  Registro de Venta
                </h5>
                <h5
                  v-if="number == 1"
                  class="text-primary m-0 font-weight-bold"
                >
                  Editar Venta
                </h5>
                <h5
                  v-if="number == 2"
                  class="text-primary m-0 font-weight-bold"
                >
                  Detalles de Venta
                </h5>
              </div>
              <div class="card-body">
                <div class="col-lg-6 col-xs-8 m-auto" v-show="number != 2">
                  <el-button type="success" @click="edit" plain
                    >Guardar</el-button
                  >
                </div>
                <div v-show="number == 2" class="col-lg-6 col-xs-8 m-auto">
                  <el-button type="warning" @click="editLink" plain
                    >Editar</el-button
                  >
                </div>
                <div class="row mt-5">
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
                    <strong>Empleado</strong>
                    <label class="text-danger" v-if="number != 2"> *</label>
                    <el-select
                      style="width: 100%"
                      v-model="sale.id_employee"
                      filterable
                      placeholder="Seleccione producto"
                      :disabled="number == 2"
                    >
                      <el-option
                        v-for="item in employees"
                        :key="item.id"
                        :label="item.id + ': ' + item.name"
                        :value="item.id"
                      >
                      </el-option>
                    </el-select>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
                    <strong>Cliente</strong>
                    <label class="text-danger" v-if="number != 2"> *</label>
                    <el-select
                      style="width: 100%"
                      v-model="sale.id_client"
                      filterable
                      placeholder="Seleccione producto"
                      :disabled="number == 2"
                    >
                      <el-option
                        v-for="item in clients"
                        :key="item.id"
                        :label="item.id + ': ' + item.name"
                        :value="item.id"
                      >
                      </el-option>
                    </el-select>
                  </div>
                  <div
                    v-if="number != 2"
                    class="col-lg-6 col-md-6 col-xs-8 mb-2"
                  >
                    <strong>Producto</strong>
                    <el-select
                      @change="updateP"
                      style="width: 100%"
                      v-model="auxp"
                      filterable
                      placeholder="Seleccione producto"
                      :disabled="number == 2"
                    >
                      <el-option
                        v-for="item in products"
                        :key="item.id"
                        :label="item.id + ': ' + item.name"
                        :value="item.id"
                      >
                      </el-option>
                    </el-select>
                  </div>
                  <div
                    v-if="number != 2"
                    class="d-inline col-lg-6 col-md-6 col-xs-12"
                  >
                    <div class="form-group">
                      <strong v-if="this.auxsto != null && this.auxsto > 0"
                        >Cantidad 1-{{ this.auxsto }}</strong
                      >
                      <strong v-else>Cantidad (No se puede agregar)</strong>

                      <input
                        class="form-control"
                        type="number"
                        name="name"
                        v-model="auxq"
                        :readonly="number == 2"
                      />
                    </div>
                  </div>
                </div>
                <div
                  v-if="number != 2"
                  class="mt-3 mb-3 row"
                  v-show="number != 2"
                ></div>
                <el-button
                  v-show="number != 2"
                  class="mb-2"
                  type="primary"
                  plain
                  @click="addProduct()"
                  >Agregar</el-button
                >

                <div class="table-responsive table mt-2" role="grid">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>X</th>
                        <th>Id</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Precio unitario</th>
                        <th>Monto</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(val, index) in actualproducts"
                        v-bind:key="index"
                      >
                        <td role="button" @click="onClickDelete(index)">
                          <label>X </label>
                        </td>
                        <td>{{ val.id }}</td>
                        <td>{{ val.quantity }}</td>
                        <td role="button" @click="goOut(val.id)">{{ val.name }}</td>
                        <td>$ {{ val.cost }}</td>
                        <td>$ {{ getR(val.cost * val.quantity) }}</td>
                      </tr>
                      <tr>
                        <td colspan="5" align="right">Subtotal</td>
                        <td>${{ getR(getSubtotal()) }}</td>
                      </tr>
                      <tr>
                        <td colspan="5" align="right">
                          +{{ getR(getIVA()) }}% de IVA
                        </td>
                        <td>${{ getR(getTotalIVA()) }}</td>
                      </tr>
                      <tr>
                        <td colspan="5" align="right">Monto Total</td>
                        <td>${{getR( getTotal()) }}</td>
                      </tr>
                    </tbody>

                    <tbody></tbody>
                  </table>
                </div>
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
      startTime: null,
      endTime: null,
      sale: null,
      saled: null,
      saledos: null,
      employees: null,
      clients: null,
      sales: null,
      name: null,
      auxp: null,
      auxq: null,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      auxsto: null,
      response: [],
      day_selected: null,
      products: null,
      iva: null,
      actualproducts: [],
      sale: {
        id: null,
        id_employee: null,
        id_client: null,
        updated_at: new Date(),
        saveproducts: null,
      },
      editAvailable: false,
      editid: this.detailsid,
    };
  },
  mounted() {
    axios
      .get("/empleados/all")
      .then((res) => {
        this.employees = res.data;
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Conexión inválida"
        );
        console.log(error);
      });

    axios
      .get("/productos/all")
      .then((res) => {
        this.products = res.data;
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Conexión inválida"
        );
        console.log(error);
      });
    axios
      .get("/clientes/all")
      .then((res) => {
        this.clients = res.data;
        console.log(this.sales);
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Conexión inválida"
        );
        console.log(error);
      });
    if (this.number != 0) {
      axios.get(`/ventas/detalleone/${this.editid}`).then((response) => {
        this.sale = response.data;
        this.sale.details_sales.forEach((value, index) => {
          this.actualproducts.push({
            id: value.id_product,
            quantity: parseInt(value.quantiy),
            name: this.products[
              this.products.findIndex((i) => i.id === value.id_product)
            ].name,
            cost: value.cost,
          });
        });
        axios
          .get("/iva/actual")
          .then((res) => {
            this.iva = 0;
            res.data.forEach((value, index) => {
              if (value.start < this.sale.updated_at) {
                this.iva = value.porcentage;
              }
            });
            console.log(this.iva);
          })
          .catch((error) => {
            this.showErrorNotification(
              "Error al cargar datos",
              "Conexión inválida"
            );
            console.log(error);
          });
        console.log(this.sale);
      });
    } else {
      axios
        .get("/iva/actual")
        .then((res) => {
          this.iva = 0;
          let x = new Date();
          res.data.forEach((value, index) => {
            let date = new Date(value.start);
            if (date < x) {
              this.iva = value.porcentage;
            }
          });
          console.log(this.iva);
        })
        .catch((error) => {
          this.showErrorNotification(
            "Error al cargar datos",
            "Conexión inválida"
          );
          console.log(error);
        });
    }
  },
  methods: {
    edit() {
      if (this.sale.id_employee == null || this.sale.id_client == null) {
        this.showErrorNotification("Agregar Venta", "Ingrese todos los campos");
        return;
      }
      this.sale._token = this.csrf;
      this.sale.saveproducts = this.actualproducts;
      axios.post("/ventas", this.sale).then((response) => {
        if (_.isNumber(response.data.response)) {
          if (response.data.errors != null) {
            this.showErrorNotification(
              "Error",
              "Lo cantidad solicitada de siguientes id de productos no estan disponibles: " +
                response.data.errors
            );
            return;
          }
          this.editid = response.data.response;
          this.showSuccessNotification(
            "Agregando Venta",
            "Información guardada con éxito"
          );
          if (this.number == 0) {
            this.sale.id_employee = null;
            this.sale.id_client = null;
            this.auxp = null;
            this.auxq = null;
            this.auxsto = null;
            this.actualproducts = [];
          }
        } else {
          this.showErrorNotification("Agregando Venta", response.data);
          return;
        }
      });
    },
    getR(r){
      if(r==null)return 0.00;
      console.log(r);
      return (r).toFixed(2);
    },
    getRandomColor(indx) {
      indx = (indx + indx * 3) * (indx + 5 * indx * indx * indx) * indx + indx;
      var letters = "0123456789ABCDEF";
      var color = "#";
      var x = String.fromCharCode(65 + (indx % 6));
      var d = x + indx.toString();
      color += d;
      for (var i = 0; i < 6 - d.length; i++) {
        color += String.fromCharCode(
          65 + ((i * i * i * +i * 20 * 7 + indx * indx + 34 * indx * indx) % 6)
        );
      }
      color = color.slice(0, 7);
      return color + 30;
    },
    goOut(id){
      window.open("/productos/"+id+"/","_blank");
    },
    updateP() {
      var index = this.products.findIndex((i) => i.id === this.auxp);
      this.auxsto = this.products[index].stock;
    },
    showSuccessNotification(title, text) {
      this.$notify({
        title: title,
        message: text,
        type: "success",
      });
    },
    onClickDelete(index2) {
      var index = this.products.findIndex(
        (i) => i.id === this.actualproducts[index2].id
      );
      this.products[index].stock += this.actualproducts[index2].quantity;
      if (this.auxp == this.products[index].id) {
        this.auxsto = this.products[index].stock;
      }
      this.actualproducts.splice(index2, 1);
    },
    showErrorNotification(title, text) {
      this.$notify({
        title: title,
        message: text,
        type: "error",
      });
    },
    getDateO(dat) {
      var d = new Date(dat);
      var datestring =
        d.getFullYear() +
        ("0" + (d.getMonth() + 1)).slice(-2) +
        "/" +
        ("0" + d.getDate()).slice(-2) +
        "/";
      return datestring;
    },
    editLink() {
      window.location = "/ventas/editar/" + this.editid;
    },
    ret() {
      window.location = "/ventas";
    },
    addShow() {
      this.show = true;
    },
    showchange() {
      console.log(this.patient);
    },
    addProduct() {
      if (this.auxp == null || this.auxq == null) {
        this.showErrorNotification(
          "Agregando",
          "Seleccione cantidad y producto"
        );
        return;
      }
      if (this.auxq <= 0 || this.auxq > this.auxsto) {
        this.showErrorNotification("Agregando", "Cantidad fuera de rango");
        return;
      }
      var index2 = this.actualproducts.findIndex((i) => i.id === this.auxp);
      var index = this.products.findIndex((i) => i.id === this.auxp);

      if (index2 != -1) {
        this.actualproducts[index2].quantity += parseInt(this.auxq);
        this.products[index].stock -= parseInt(this.auxq);
        this.auxsto = this.products[index].stock;
        return;
      }
      this.actualproducts.push({
        id: this.auxp,
        quantity: parseInt(this.auxq),
        name: this.products[index].name,
        cost: this.products[index].cost,
      });
      this.products[index].stock -= parseInt(this.auxq);
      this.auxsto = this.products[index].stock;
      this.auxq = null;
      console.log(this.actualproducts);
    },
    getSubtotal() {
      let sum = 0;
      this.actualproducts.forEach((value, index) => {
        sum += value.cost * value.quantity;
      });
      return sum;
    },
    getIVA() {
      return this.iva;
    },
    getTotalIVA() {
      let r = this.getSubtotal();
      let i = this.getIVA();
      let x = (r * i) / 100.0;
      return x;
    },
    getTotal() {
      return this.getSubtotal() + this.getTotalIVA();
    },
    changed() {
      this.endTime = null;
    },
  },
};
</script>
