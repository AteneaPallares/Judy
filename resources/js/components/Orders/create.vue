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
                  Registro de Pedido
                </h5>
                <h5
                  v-if="number == 1"
                  class="text-primary m-0 font-weight-bold"
                >
                  Editar Pedido
                </h5>
                <h5
                  v-if="number == 2"
                  class="text-primary m-0 font-weight-bold"
                >
                  Detalles de Pedido
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
                      v-model="order.id_employee"
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
                    <strong>Proveedor</strong>
                     <label class="text-danger" v-if="number != 2"> *</label>
                   
                    <el-select
                      style="width: 100%"
                      v-model="order.id_supplier"
                      filterable
                      placeholder="Seleccione producto"
                      :disabled="number == 2"
                    >
                      <el-option
                        v-for="item in suppliers"
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
                      <strong>Cantidad</strong
                      ><input
                        class="form-control"
                        type="number"
                        name="name"
                        v-model="auxq"
                        :readonly="number == 2"
                      />
                    </div>
                  </div>
                  <div
                    v-if="number != 2"
                    class="d-inline col-lg-6 col-md-6 col-xs-12"
                  >
                    <div class="form-group">
                      <strong>Precio</strong
                      ><input
                        class="form-control"
                        type="number"
                        name="name"
                        v-model="auxprice"
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
                        v-for="(val, index) in actualorders"
                        v-bind:key="index"
                      >
                        <td role="button" @click="onClickDelete(index)">
                          <label>X </label>
                        </td>
                        <td>{{ val.id }}</td>
                        <td>{{ val.quantity }}</td>
                        <td role="button" @click="goOut(val.id)">
                          {{ val.name }}
                        </td>
                        <td>$ {{ val.price }}</td>
                        <td>$ {{ getR(val.price * val.quantity) }}</td>
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
                        <td>${{ getR(getTotal()) }}</td>
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
      orderd: null,
      orderdos: null,
      employees: null,
      suppliers: null,
      orders: null,
      name: null,
      auxp: null,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      auxq: null,
      response: [],
      auxprice: null,
      day_selected: null,
      products: null,
      iva: null,
      actualorders: [],
      order: {
        id: null,
        id_employee: null,
        id_supplier: null,
        updated_at: new Date(),
        saveproducts: null,
      },
      editAvailable: false,
      editid: this.detailsid,
      schedule: {
        Lunes: [],
        Martes: [],
      },
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
      .get("/proveedores/all")
      .then((res) => {
        this.suppliers = res.data;
        console.log(this.orders);
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Conexión inválida"
        );
        console.log(error);
      });
    if (this.number != 0) {
      axios.get(`/pedidos/detalleone/${this.editid}`).then((response) => {
        this.order = response.data;
        this.order.details_orders.forEach((value, index) => {
          this.actualorders.push({
            id: value.id_product,
            quantity: parseInt(value.quantity),
            name: this.products[
              this.products.findIndex((i) => i.id === value.id_product)
            ].name,
            price: value.price,
          });
        });
        axios
          .get("/iva/actual")
          .then((res) => {
            this.iva = 0;
            res.data.forEach((value, index) => {
              if (value.start < this.order.updated_at) {
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
        console.log(this.order);
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
      if (this.order.id_employee == null || this.order.id_supplier == null) {
        this.showErrorNotification("Agregar Pedido", "Ingrese todos los campos");
        return;
      }
      this.order._token = this.csrf;
      this.order.saveproducts = this.actualorders;
      axios.post("/pedidos", this.order).then((response) => {
        if (_.isNumber(response.data.response)) {
          this.editid = response.data.response;
          this.showSuccessNotification(
            "Agregando Pedido",
            "Información guardada con éxito"
          );
          if (this.number == 0) {
            this.order = {
              id: null,
              id_employee: null,
              id_supplier: null,
              updated_at: new Date(),
              saveproducts: null,
            };
            this.actualorders=[];
            this.auxq=null;
            this.auxprice=null;
            this.auxp=null;
          }
        } else {
          this.showErrorNotification("Agregando Pedido", response.data);
          return;
        }
      });
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
    showSuccessNotification(title, text) {
      this.$notify({
        title: title,
        message: text,
        type: "success",
      });
    },
    onClickDelete(index) {
      this.actualorders.splice(index, 1);
    },
    showErrorNotification(title, text) {
      this.$notify({
        title: title,
        message: text,
        type: "error",
      });
    },
    goOut(id) {
      window.open("/productos/" + id + "/", "_blank");
    },
    getR(r) {
      if (r == null) return 0.0;
      console.log(r);
      return r.toFixed(2);
    },
    updateP() {
      var index = this.products.findIndex((i) => i.id === this.auxp);
      this.auxprice = this.products[index].cost;
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
      window.location = "/pedidos/editar/" + this.editid;
    },
    ret() {
      window.location = "/pedidos";
    },
    addShow() {
      this.show = true;
    },
    showchange() {
      console.log(this.patient);
    },
    addProduct() {
      if (this.auxp == null || this.auxq == null) {
        this.showErrorNotification("Agregando", "Faltan datos");
        return;
      }
      if (this.auxq < 0) {
        this.showErrorNotification("Agregando", "El valor debe ser mayor a 0");
        return;
      }
      var index2 = this.actualorders.findIndex((i) => i.id === this.auxp);
      if (index2 != -1) {
        this.actualorders[index2].quantity += parseInt(this.auxq);
        this.actualorders[index2].price = this.auxprice;
        return;
      }
      var index = this.products.findIndex((i) => i.id === this.auxp);
      this.actualorders.push({
        id: this.auxp,
        quantity: parseInt(this.auxq),
        name: this.products[index].name,
        price: this.auxprice,
      });
      console.log(this.actualorders);
    },
    getSubtotal() {
      let sum = 0;
      this.actualorders.forEach((value, index) => {
        sum += value.price * value.quantity;
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
      console.log("hol");
      this.endTime = null;
    },
  },
};
</script>
