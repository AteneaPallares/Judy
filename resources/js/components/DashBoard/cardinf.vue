<template>
  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 float-left">
    <div class="mb-3 m-0 cd">
      <div :id="this.id+'conten'">
        <div class="card-body  align-middle">
          <div class="card-body-icon">
            <i :id="this.id+'customicon'"></i>
          </div>
          <div class="media-body text-right">
            <h3 :id="this.id+'number'">278</h3>
            <span :id="this.id+'showt'">New Posts</span>
          </div>
        </div>
        <a class="card-footer text-white view small z-1" href="#" @click="send()">
          <span class="float-left det">Ver detalles</span>
          <span class="float-right det">
            <i class="el-icon-arrow-right"></i>
          </span>
        </a>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["text", "number", "icon", "url", "bg","id"],
  data() {
    return {};
  },
  mounted() {
    document.getElementById(this.id+"showt").innerHTML = this.text;
    document.getElementById(this.id+"number").innerHTML = this.number;
    var aux2 = "card text-white m-0 o-hidden h-60";
    aux2 += this.ico + " " + this.bg;
    let x=document.getElementById(this.id+"conten").className = aux2;
    document.getElementById(this.id+"conten").style.backgroundColor = this.bg;
    var aux = "ico float-left ";
    aux += this.icon;
    document.getElementById(this.id+"customicon").className = aux;
  },
  methods: {
    send(){
      window.location="/"+this.url+"/";
    }
  },
};
</script>
<style scoped>
.ico {
  font-size: 50px;
  transition-duration: 500ms;
}
.hd {
  font-size: 14px;
  clear: right;
}
.dv {
  height: 60px;
}
.bd {
  display: inline-block;
  vertical-align: top;
}
.cd:hover .ico {
  font-size: 60px;
  transition-duration: 500ms;
  cursor: default;
}
.view:hover {
  background-color: white;
  transition-duration: 1000ms;
  cursor: pointer;
}
.view:hover .det {
  color: black;
  transition-duration: 500ms;
}
</style>