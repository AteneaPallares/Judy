<template>
  <div class="p-2 text-center">
    <div class="row">
      <div class="col-lg-12 mb-3">
        <div class="">
          <div>
            <div class="row">
              <div v-if="this.scheduledata != null">
                <el-button
                  type="warning"
                  @click="editschedule()"
                  plain
                  >Cambiar horario</el-button
                >
                <div class="row mt-2">
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
					  <strong>Nombre</strong>
                    <label
                      class="form-control text-left"
                      type="text"
                      name="name"
                    >{{scheduledata.name}}</label>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
					  <strong>Área (Lugar)</strong>
                    <el-select
                      style="width: 100%"
                      v-model="area"
                      filterable
                      placeholder="Seleccione área"
					  :disabled="number==2"
                    >
                      <el-option
                        v-for="item in areas"
                        :key="item.id"
                        :label="item.name+': '+item.place"
                        :value="item.id"
                      >
                      </el-option>
                    </el-select>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
					  <strong>Fecha de inicio</strong>
                    <el-date-picker
                      style="width: 100%"
                      v-model="scheduledata.start_date"
                      type="date"
                      placeholder="Fecha inicio"
                      :readonly="number == 2"
                    >
                    </el-date-picker>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
					  <strong>Fecha de fin</strong>
                    <el-date-picker
                      style="width: 100%"
                      v-model="scheduledata.end_date"
                      type="date"
                      placeholder="Fecha fin"
                      :readonly="number == 2"
                    >
                      >
                    </el-date-picker>
                  </div>
                </div>

                <div class="table-responsive table mt-2" role="grid">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="w-25">Día</th>
                        <th>Horario</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(day, name, index) in schedule"
                        v-bind:key="name"
                      >
                        <td class="w-25">{{ name }}</td>
                        <td>
                          <div class="text-center">
                            <div
                              class="
                                border border-dark
                                rounded
                                text-right
                                col-lg-8
                                ml-auto
                                mr-auto
                                mb-1
                              "
                              v-for="(props, index2) in day"
                              v-bind:key="index2"
                              :style="
                                'background-color:' +
                                getRandomColor(index + index2)
                              "
                            >
                              <label class="text-center">{{ props }}</label
                              ><span
                                class="btn text-right"
                                @click="onClickDelete(name, index2)"
								v-show="number!=2"
                              >
                                <i class="el-icon-close"></i>
                              </span>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>

                    <tbody></tbody>
                    <tfoot>
                      <tr>
                        <th>Día</th>
                        <th>Horario</th>
                      </tr>
                    </tfoot>
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
  props: ["userselected"],
  data() {
    return {
      data: null,
      selected: null,
      users: null,
      schedule: [],
      area: null,
      areas: null,
      number: 2,
      scheduledata: null,
      urlactive: "",
    };
  },
  mounted() {
    axios
      .get("/areas/all")
      .then((res) => {
        this.areas = res.data;
        console.log(this.areas);
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Conexión inválida"
        );
        console.log(error);
      });
    axios
      .get("/horarios/all")
      .then((res) => {
        console.log(res.data);
        this.data = res.data;
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Conexión inválida"
        );
        console.log(error);
       
      });
	   axios
          .get("/empleados/all")
          .then((res) => {
            console.log(res.data);
            this.users = res.data;
			this.updateuser();
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
    update() {
      console.log(this.data);
      var index = this.data.findIndex((i) => i.id === this.selected);
      if (index != -1) {
        this.schedule = JSON.parse(this.data[index].all_schedule);
        this.scheduledata = this.data[index];
        this.area = this.scheduledata.id_area;
		console.log("Entro");
      }
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
    updateuser() {
      var index = this.users.findIndex((i) => i.id === this.userselected);
      if (index != -1) this.selected = this.users[index].id_schedule;
      this.update();
	  console.log("yyyyyyyy");
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
    ret() {
      window.location.href = "/horarios";
    },editschedule(){
		window.location.href = "/horarios/empleados/"+this.userselected;
	}
  },
};
</script>
