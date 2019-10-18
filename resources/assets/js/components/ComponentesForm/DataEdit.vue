<template>
  <div class="container">
    <!-- <el-row :gutter="20">
      <el-col :span="18" > -->
        
        <el-card :body-style="{ margin:'10px'}" >
          <div slot="header" class="clearfix">
            <span>Sala de Chat</span>
          </div>
          <div class="text item">
            <el-row :gutter="20">
              <el-col :span="16">
                <el-form label-width="120px" >
                  <el-form-item label="Mensajes:">
                    <div class="chat" >
                      <div class="chatbox" v-for="(chat, ch) of Message" :key="ch"  >
                          <!-- <ul class="list-unstyled" v-for="(chat, ch) of Message" :key="ch">
                            <li v-if="chat.user_id ===  user" class="p-2 mine messages">{{ chat.message }}</li>
                          </ul> -->
                            <div v-if="chat.user_id ===  user" class="mine messages">
                              <div class="message last"><span class="userData_last">{{ chat.name }}</span>{{ chat.message}}</div>
                            </div>
                            <div v-else class="yours messages">
                              <div class="message"><span class="userData">{{ chat.name }}</span>{{ chat.message}}</div>
                            </div>
                      </div>
                    </div>
                  </el-form-item>
                  <el-form-item >
                    <el-input type="textarea" name="anotacion" v-model="textarea"></el-input>
                  </el-form-item>
                  <el-form-item>
                    <el-button type="primary" @click="onSubmit"><i class="el-icon-s-promotion"></i></el-button>
                    <!-- <el-button>Cancel</el-button> -->
                  </el-form-item>
                </el-form>
              </el-col>
              <el-col :span="8">
                  <div class="card card-default">
                    <div class="card-header">
                      Usuarios Conectados:
                    </div>
                    <div class="card-body">
                      <ul>
                        <li class="py-2" v-for="(user, index) in users" :key="index">
                            {{ user.name }}
                        </li>
                      </ul>
                    </div>
                  </div>
              </el-col>
            </el-row>
              
          </div>
        </el-card>
        
      <!-- </el-col>

    </el-row> -->
  </div>
</template>

<style>
.el-row {
  margin-bottom: 20px;
  margin-left: 20px;
}

.chatbox {
  width: 100%;
}

.userData, .userData_last{
  font-size: 13px;
  color:red;
  display: block;
}

.userData{
  margin-bottom: -20px !important;
}
.userData_last{
  text-align: right;
  margin-bottom: -20px !important;
}

.entrante {
  list-style: none;
  background-color: beige;
  border-radius: 10px;
  padding-left: 20px;
  width: 75%;
}

.messages {
  margin-top: 5px;
  display: flex;
  flex-direction: column;
}
.chat {
  width: 100%;
  border: solid 1px #eee;
  display: flex;
  flex-direction: column;
  padding: 10px;
  height:420px;
  overflow-y:scroll
}

.message {
  border-radius: 20px;
  padding: 4px 15px;
  margin-top: 5px;
  margin-bottom: 5px;
  display: inline-block;
}

.yours {
  align-items: flex-start;
}

.yours .message {
  margin-right: 25%;
  /* background-color: #eee; */
  background-color: #ece5dd;
  position: relative;
}

.yours .message.last:before {
  content: "";
  position: absolute;
  z-index: 0;
  bottom: 0;
  left: -7px;
  height: 20px;
  width: 20px;
  background: #eee;
  border-bottom-right-radius: 15px;
}
.yours .message.last:after {
  content: "";
  position: absolute;
  z-index: 1;
  bottom: 0;
  left: -10px;
  width: 10px;
  height: 20px;
  background: white;
  border-bottom-right-radius: 10px;
}

.mine {
  align-items: flex-end;
}

.mine .message {
  color: #000;
  margin-left: 25%;
  background: #dcf8c6;
  /*background: linear-gradient(to bottom, #00D0EA 0%, #0085D1 100%);*/
  background-attachment: fixed;
  position: relative;
}

.mine .message.last:before {
  content: "";
  position: absolute;
  z-index: 0;
  bottom: 0;
  right: -8px;
  height: 20px;
  width: 20px;
  background: #dcf8c6;
  /*background: linear-gradient(to bottom, #00D0EA 0%, #0085D1 100%);*/
  background-attachment: fixed;
  border-bottom-left-radius: 15px;
}

.mine .message.last:after {
  content: "";
  position: absolute;
  z-index: 1;
  bottom: 0;
  right: -10px;
  width: 10px;
  height: 20px;
  background: white;
  border-bottom-left-radius: 10px;
}
</style>

<script>
export default {
  
  props: {user:{type:Number},csrf:{
                type: String
            }},
  data() {
    return {
      form: {
        name: "12",
        region: "",
        date1: "",
        date2: "",
        delivery: false,
        type: [],
        resource: "",
        desc: ""
      },
      form2: {},
      fileList: [
        
      ],
      DataResult: {
        created_at: ""
      },
      Responsables: [],
      Message: [],
      textarea: "",
      anotacion: "",
      message: "",
      id_user: "",
      id_evento: "",
      id_enviado:1,
      users:[]
    };
  },
  // mounted() {
  //    this.getChat();
  //   setInterval(() => {
  //     this.getChat();
  //   }, 1000);
  // },
  created(){
    this.getChat();

    Echo.join('chat')
            .listen('MessageSent', (event) => {
              console.log(event.message);
                this.Message.push(event.message);
            });

            Echo.join('chat')
                .here(user => {
                    this.users = user;
                })
                .joining(user => {
                    this.users.push(user);
                })
                .leaving(user => {
                    this.users = this.users.filter(u => u.id != user.id);
                })
                .listen('MessageSent',(event) => {
                    this.Message.push(event.message);
                })
                // .listenForWhisper('typing', user => {
                //    this.activeUser = user;
                //     if(this.typingTimer) {
                //         clearTimeout(this.typingTimer);
                //     }
                //    this.typingTimer = setTimeout(() => {
                //        this.activeUser = false;
                //    }, 3000);
                // })
  },
  methods: {
    // llenado: function() {
    //   axios
    //     .get("/searchEvento/" + this.id)
    //     .then(response => {
    //       this.DataResult = response.data;
    //     })
    //     .catch(function(error) {
    //       // handle error
    //       console.log(error);
    //     })
    //     .finally(function() {
    //       // always executed
    //     });
    // },
    // getResponsables: function() {
    //   axios
    //     .get("/getDataRes")
    //     .then(response => {
    //       this.Responsables = response.data;
    //       //console.log(response.data);
    //     })
    //     .catch(function(error) {
    //       console.log(error);
    //     });
    // },
    getChat:  function() {
      axios
        .get("/getChat")
        .then(response => {
          this.Message = response.data;
          //console.log(response.data);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getFile: function(){
      axios.get('/fileList/'+ this.id)
      .then(response =>{
      //console.log("dentro");
          this.fileList = response.data;
          
      }).catch(function(error) {
          console.log(error);
        });
    }
    ,
     onSubmit() {

       this.Message.push({
         message: this.textarea 
       });
      var url = "/addMessages";
       axios
        .post(url, {
          message: this.textarea
        })
        .then(response => {
             this.getChat();
            this.textarea = "";
          // console.log("guardado");
        })
        .catch(error => {
          console.log(error.message);
        });
    },
    handleRemove(file, fileList) {
      let vm = this
        axios.delete('/upload/' + file.uid)
            .then(function () {
                let index = _.findIndex(vm.fileList, ['uid', file.uid])
                vm.$delete(vm.fileList, index)
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    handlePreview(file) {
      console.log(file);
    },
    handleExceed(files, fileList) {
      this.$message.warning(
        `El límite es 3, haz seleccionado ${
          files.length
        } archivos esta vez, añade hasta ${files.length + fileList.length}`
      );
    },
    cargaSuccess(response, file, fileList) {
      let id_fila = ''
      var vm = this
        _.map(response, function (data) {
            file['uid'] = data
            
        })
        vm.fileList = fileList;
      
      var url = "/Uploadfile";
      axios
        .post(url, {
          id_evento: this.id,
          id_file: file.uid
        })
        .then(response => {
          this.$message.success(`Documento Cargado`);
        })
        .catch(error => {
          console.log(error.message);
        });
    },
    submitForm2 () { 
      this.loading = true 
      if(this.$refs.upload._data.uploadFiles.length !== 0){ 
        return this.$refs.upload.submit() 
      } 
        return axios.post('/api/v1/news/store',this.form)
          .then((response) =>{ 
              this.$emit('news-data',response.data.data) 
              this.loading = false 
              this.closeNewsForm() 
              this.resetForm() 
          })
          .catch((error) =>{ 
              this.form.errors = error.response.data.errors 
              this.loading = false 
              console.log(error.response.data) 
          }) 
    }
  }
};
</script>
