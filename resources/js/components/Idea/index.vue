<template>
  <div>
    <br />
    <br />
    <div v-if="videos.length > 0" class="row">
      <div
        class="
          col-lg-3
          mb-3
          col-md-4 col-sm-6 col-xs-12
          d-flex
          align-items-stretch
        "
        v-for="(props, index) in videos"
        v-bind:key="index"
      >
        <div
          class="image-flip h-100 w-100 cardcustom p-2"
          ontouchstart="this.classList.toggle('hover');"
        >
          <div class="mainflip h-100 w-100">
            <div class="frontside h-100 w-100">
              <div class="card h-100 w-100 d-flex align-items-stretch">
                <img
                  class="card-img-top h-50"
                  :src="props.thumbnails.default.url"
                  alt="card image"
                />
                <div class="card-body h-100 w-100">
                  <strong class="card-title customfont text-center det">{{
                    props.title
                  }}</strong>
                </div>
              </div>
            </div>
            <div class="backside h-100 w-100">
              <div class="card h-100 w-100 d-flex align-items-stretch">
                <div class="card-header text-center font-weight-bold h5">
                  {{ props.name }}
                </div>
                <div class="card-body">
                  <p class="card-text scroll">
                    {{ props.description }}
                  </p>
                </div>
                <a
                  class="card-footer text-white view small z-1"
                  href="#"
                  @click="send(props)"
                >
                  <span class="float-left det">Ver video</span>
                  <span class="float-right det">
                    <i class="el-icon-arrow-right"></i>
                  </span>
                </a>
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
  props: {},
  data() {
    return {
      allproducts: [],
      items: null,
      videos: [],
      api: null,
    };
  },
  mounted() {
    this.api = "AIzaSyDKo7S_6p28ty9VKvwtH1vt51vqq7x3_CU";
    axios
      .get(
        "https://www.googleapis.com/youtube/v3/search?&q=papel+de+oficina+fotograficos&key=" +
          this.api +
          "&chart=mostPopular"
      )
      .then((res) => {
        this.items = res.data;
        this.items.items.forEach((value, index) => {
          let id = value.id.videoId;
          axios
            .get(
              "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" +
                id +
                "&key=" +
                this.api +
                ""
            )
            .then((res2) => {
              res2.data.items[0].snippet.id = id;
              this.videos.push(res2.data.items[0].snippet);
              
            });
        });
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Se sobrepaso el numero de consultas"
        );
      });
    axios
      .get(
        "https://www.googleapis.com/youtube/v3/search?&q=manualidades&key=" +
          this.api +
          "&chart=mostPopular"
      )
      .then((res) => {
        this.items = res.data;
        this.items.items.forEach((value, index) => {
          let id = value.id.videoId;
          axios
            .get(
              "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" +
                id +
                "&key=" +
                this.api +
                ""
            )
            .then((res2) => {
              res2.data.items[0].snippet.id = id;
              this.videos.push(res2.data.items[0].snippet);
            
            });
        });
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Se sobrepaso el numero de consultas"
        );
      });
    axios
      .get(
        "https://www.googleapis.com/youtube/v3/search?&q=tipos+de+papeles+chino+foami&key=" +
          this.api +
          "&chart=mostPopular"
      )
      .then((res) => {
        this.items = res.data;
        this.items.items.forEach((value, index) => {
          let id = value.id.videoId;
          axios
            .get(
              "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" +
                id +
                "&key=" +
                this.api
            )
            .then((res2) => {
              res2.data.items[0].snippet.id = id;
              this.videos.push(res2.data.items[0].snippet);
              
            });
        });
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Se sobrepaso el numero de consultas"
        );
        console.log(error);
      });
  },
  methods: {
    getVal(prop) {
      if (prop.img == null) {
        return "../../../../storage/prod.jpg";
      }
      return "../../../../storage/" + prop.img;
    },
    send(prop) {
      window.open("https://www.youtube.com/watch?v=" + prop.id, "_blank");
    },
  },
};
</script>
<style scoped>
.customfont {
  font-family: "Lucida Sans";
}
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
.det {
  color: blue;
}
.cd:hover .ico {
  font-size: 60px;
  transition-duration: 500ms;
  cursor: default;
}
.view:hover {
  background-color: black;
  color: white;
  transition-duration: 1000ms;
  cursor: pointer;
}
.cardcustom {
  min-height: 150px;
  max-width: 20rem;
}
.view:hover .det {
  color: white;
  transition-duration: 500ms;
}
.awesome {
  color: deeppink;
}
.scroll {
  width: auto;
  max-height: 150px;
  overflow-x: hidden;
  overflow-y: auto;
  text-align: center;
  padding: 0;
}
</style>