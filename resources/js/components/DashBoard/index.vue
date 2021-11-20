<template>
  <div>
    <div class="d-sm-flex justify-content-between align-items-center mb-3">
      <h3 class="text-dark mb-0">Dashboard</h3>
      <a
        class="btn btn-primary btn-sm d-none d-sm-inline-block"
        role="button"
        @click="print"
        href="#"
        ><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generar
        reporte</a
      >
    </div>
    <div>
      <div v-if="this.content != null" class="row col-lg-12">
        <cardinfo-component
          v-for="(props, index) in this.content"
          v-bind:key="index"
          v-bind:id="index"
          v-bind:text="props.text"
          v-bind:url="props.url"
          v-bind:number="props.number"
          v-bind:bg="props.bg"
          v-bind:icon="props.icon"
        />
      </div>
      <div class="row col-lg-12 ">
        <div class="col-xl-4 col-lg-6 mb-3 ml-auto mr-auto">
          <div class="pl-2 pr-0 pb-0 pt-0 text-left card h-100">
            <div class="d-inline card-body text-center p-0">
              <div class="chart-container p-0 m-0">
                <canvas id="myChart4"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 col-lg-12 mb-3 ml-auto mr-auto">
          <div class="pl-2 pr-0 pb-0 pt-0 text-left card h-100">
            <div class="d-inline card-body text-center">
              <div class="chart-container p-0 m-0">
                <canvas id="line"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 col-lg-12 mb-3  ml-auto mr-auto">
          <div class="pl-2 pr-0 pb-0 pt-0 card text-left">
            <div class="card-body text-center">
              <div class="chart-container p-0 m-0">
                <canvas id="line2"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-3 ml-auto mr-auto">
          <div class="pl-2 pr-0 pb-0 pt-0 text-left card h-100">
            <div class="d-inline card-body text-center p-0">
              <div class="chart-container p-0 m-0">
                <canvas id="myChart9"></canvas>
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
  props: ["route"],
  data() {
    return {
      backgroundColor: [],
      borderColor: [],
      course: null,
      users: null,
      content: null,
    };
  },
  mounted() {
    axios.get("/dashboard/all").then((response) => {
      this.course = response.data;

      this.content = [
        {
          text: "Empleados",
          number: this.course.all.user,
          icon: "el-icon-user-solid",
          bg: "#5F0318",
          url: "empleados",
        },
        {
          text: "Clientes",
          number: this.course.all.client,
          icon: "el-icon-s-claim",
          bg: "#991D2E",
          url: "clientes",
        },
        {
          text: "Pedidos",
          number: this.course.all.order,
          icon: "el-icon-s-claim",
          bg: "#5F0318",
          url: "pedidos",
        },
        {
          text: "Ventas",
          number: this.course.all.sale,
          icon: "el-icon-s-order",
          bg: "#991D2E",
          url: "ventas",
        },
        {
          text: "Proveedores",
          number: this.course.all.supplier,
          icon: "el-icon-office-building",
          bg: "#5F0318",
          url: "proveedores",
        },
        {
          text: "Productos",
          number: this.course.all.product,
          icon: "el-icon-user",
          bg: "#991D2E",
          url: "productos",
        },
      ];
      var items = [];
      var xy = [];
      // var data = [];
      // var labels = [];
      // var data2 = [];
      // var labels2 = [];
      // Object.keys(this.course.patient).forEach((key) => {
      //   data.push(this.course.patient[key]);
      //   labels.push(key);
      // });
      // Object.keys(this.course.date).forEach((key) => {
      //   data2.push(this.course.date[key]);
      //   labels2.push(key);
      // });
      // var data3 = [];
      // var labels3 = [];
      // Object.keys(this.course.weight).forEach((key) => {
      //   data3.push(this.course.weight[key]);
      //   labels3.push(key);
      // });
      console.log(this.course);

      var data4 = [];
      var labels4 = [];
      Object.keys(this.course.users).forEach((key) => {
        data4.push(this.course.users[key]);
        labels4.push(key);
      });
      var data=[];
      var labels=[];

       Object.keys(this.course.usersd).forEach((key) => {
        data.push(this.course.usersd[key]);
        labels.push(key);
      });
      this.pie(data, labels, "Estado de los usuarios", "myChart9","bottom");
     this.pie(data4, labels4, "Tipos de usuarios", "myChart4", "bottom");
      var items = [];
      var xy = [];
      this.course.register.forEach((value, index) => {
        var dateObj = new Date(value.date);
        var month = dateObj.getUTCMonth() + 1; //months from 1-12
        var day = dateObj.getUTCDate();
        var year = dateObj.getUTCFullYear();
        var newdate = day + "/" + month + "/" + year;
        items.push(newdate);
        xy.push({ x: index * 2, y: value.num });
      });
      var ctx2 = document.getElementById("line").getContext("2d");
      var stackedLine = new Chart(ctx2, {
        type: "line",
        data: {
          labels: items,
          datasets: [
            {
              label: "N. Ventas",
              backgroundColor: this.getRandomColor(),
              borderColor: this.getRandomColor(),
              data: xy,
              fill: false,
            },
          ],
        },
        options: {
          responsive: true,
          title: {
            display: true,
            text: "Reporte de ventas",
          },
          tooltips: {
            mode: "index",
            intersect: false,
          },
          hover: {
            mode: "nearest",
            intersect: true,
          },
          scales: {
            x: {
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Month",
              },
            },
            y: {
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Value",
              },
            },
          },
        },
      });
      items=[];
      xy=[];
      this.course.register2.forEach((value, index) => {
        var dateObj = new Date(value.date);
        var month = dateObj.getUTCMonth() + 1; //months from 1-12
        var day = dateObj.getUTCDate();
        var year = dateObj.getUTCFullYear();
        var newdate = day + "/" + month + "/" + year;
        items.push(newdate);
        xy.push({ x: index * 2, y: value.num });
      });
      var ctx2 = document.getElementById("line2").getContext("2d");
      var stackedLine = new Chart(ctx2, {
        type: "line",
        data: {
          labels: items,
          datasets: [
            {
              label: "N. Pedidos",
              backgroundColor: this.getRandomColor(),
              borderColor: this.getRandomColor(),
              data: xy,
              fill: false,
            },
          ],
        },
        options: {
          responsive: true,
          title: {
            display: true,
            text: "Reporte de pedidos",
          },
          tooltips: {
            mode: "index",
            intersect: false,
          },
          hover: {
            mode: "nearest",
            intersect: true,
          },
          scales: {
            x: {
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Month",
              },
            },
            y: {
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Value",
              },
            },
          },
        },
      });
    });
  },
  methods: {
    getRandomColor() {
      var letters = "0123456789ABCDEF";
      var color = "#";
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    },

    pie($data, $label, $title, $id, $pos = "left") {
      var backgroundColor1 = [];
      var borderColor1 = [];
      for (var i = 0; i < $data.length; i++) {
        backgroundColor1.push(this.getRandomColor());
        borderColor1.push(this.getRandomColor());
      }
      var ctx = document.getElementById($id).getContext("2d");
      var myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          datasets: [
            {
              data: $data,
              backgroundColor: backgroundColor1,
              borderColor: borderColor1,
              borderWidth: 1,
            },
          ],
          labels: $label,
        },
        options: {
          aspectRatio: 1.5,
          title: {
            display: true,
            text: $title,
          },
          responsive: true,
          legend: {
            display: true,
            position: $pos,
          },
        },
      });
    },
    onClickDetails($idy) {},
    print() {
      window.location.href = "/dashboard/print/";
    },
  },
};
</script>
<style scoped>
.img2 {
  height: 30px;
  border-radius: 30%;
}
.my-custom-scrollbar {
  position: relative;
  max-height: 300px;
  overflow: auto;
}
.table-wrapper-scroll-y {
  display: block;
}
</style>
