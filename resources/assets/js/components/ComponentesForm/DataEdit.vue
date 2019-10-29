<template>
  <div class="container">
            <!-- <el-form :model="formConnect" ref="formConnect" label-width="120px" :rules="rules">
                <el-row :gutter="20">
                  <el-col :span="12">
                    <el-form-item label="Port:" prop="port">
                        <el-input v-model="formConnect.port" ></el-input>
                        
                    </el-form-item>
                  </el-col>
                  <el-col :span="12">
                      <el-form-item label="IP:" prop="ip">
                          <el-input v-model="formConnect.ip"></el-input>
                      </el-form-item>
                  </el-col>
              </el-row>
              <el-form-item>
                <button v-if="! connected" type="submit" @click.prevent="connect" class="mr-2 btn btn-sm btn-primary">
                    Connect
                </button>
              </el-form-item>
            </el-form> -->
        
        <el-card :body-style="{ margin:'10px'}" >
          <div slot="header" class="clearfix">
            <span>Sala de Chat</span>
          </div>
          <div class="text item">

            <el-row :gutter="20">
              <el-col :span="16">
                <el-form label-width="120px" >
                  <el-form-item label="Mensajes:">
                    <div class="chat scrollbar scrollbar-warning" >
                      <!-- {{ Menssage }} -->
                      
                      <div class="chatbox" v-for="(chat, ch) of Message" :key="ch"  >
                          <!-- <ul class="list-unstyled" v-for="(chat, ch) of Message" :key="ch">
                            <li v-if="chat.user_id ===  user" class="p-2 mine messages">{{ chat.message }}</li>
                          </ul> -->
                            <div v-if="chat.user.id ===  user.id" class="mine messages">
                              <div class="message last"><span class="userData_last">{{ chat.user.name }}</span>{{ chat.message}}</div>
                            </div>
                            <div v-else class="yours messages">
                              <div class="message"><span class="userData">{{ chat.user.name }}</span>{{ chat.message}}</div>
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

    }

    /* Tamaño del scroll */
    /* .chat::-webkit-scrollbar , chat::{
      width: 8px;
      height: 8px;
    } */

    /* Estilos barra (thumb) de scroll */
    /* .chat::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 4px;
    } */
    /* 
    .chat::-webkit-scrollbar-thumb:active {
      background-color: #999999;
    }

    .chat::-webkit-scrollbar-thumb:hover {
      background: #b3b3b3;
      box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
    } */

    /* Estilos track de scroll */
    /* .chat::-webkit-scrollbar-track {
      background: #e1e1e1;
      border-radius: 4px;
    }

    .chat::-webkit-scrollbar-track:hover, 
    .chat::-webkit-scrollbar-track:active {
      background: #d4d4d4;
    } */

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

    .scrollbar {
    margin-left: 30px;
    float: left;


    background: #fff;
    overflow-y: scroll;
    margin-bottom: 25px;
    }
    .force-overflow {
    min-height: 450px;
    }

    .scrollbar-primary::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5; }

    .scrollbar-primary::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #4285F4; }

    .scrollbar-danger::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #F5F5F5;
    border-radius: 10px; }

    .scrollbar-danger::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5; }

    .scrollbar-danger::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #ff3547; }

    .scrollbar-warning::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #F5F5F5;
    border-radius: 10px; }

    .scrollbar-warning::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5; }

    .scrollbar-warning::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #FF8800; }

    .scrollbar-success::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #F5F5F5;
    border-radius: 10px; }

    .scrollbar-success::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5; }

    .scrollbar-success::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #00C851; }

    .scrollbar-info::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #F5F5F5;
    border-radius: 10px; }

    .scrollbar-info::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5; }

    .scrollbar-info::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #33b5e5; }

    .scrollbar-default::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #F5F5F5;
    border-radius: 10px; }

    .scrollbar-default::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5; }

    .scrollbar-default::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #2BBBAD; }

    .scrollbar-secondary::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #F5F5F5;
    border-radius: 10px; }

    .scrollbar-secondary::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5; }

    .scrollbar-secondary::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
    background-color: #aa66cc; }
</style>

<script>
  import CryptoJS from 'crypto-js';
  import Pusher from 'pusher-js';
  const KEY = 'jj';
  const IV = '1234567890123456';
export default {

  // props: {user:{type:Number},csrf:{type: String}, Message:{type: String}},
  props: ["user","Messages"],
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
        desc: "",
      },
      formConnect:{
        port:"",
        ip:""
      },
      connected: false,
      pusher: null,
      app: {
        'id' :  'anyID',
        'key':  'anyKey',
        'secret':  'anySecret',
        'capacity':  null,
        'enable_client_messages':  false,
        'enable_statistics': true,
      },
      logs: [],
      
      rules: {
        port: [
          {
            required: true,
            message: "ingrese dato valido",
            trigger: "blur"
          }
        ],
        ip: [
          {
            required: true,
            message: "ingrese dato valido",
            trigger: "blur"
          }
        ]        
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
      users:[],
      encrypted:"",
      byte:"",
      encrypteds:"",
      ColeccionNormal:[],
      eventoC:[]
    };
  },
  mounted() {
     this.ScrollToEnd();
  },
  created(){
    // this.getChat();
    // console.log(this.Messages);
    // this.ScrollToEnd();
    this.convertir();
    
    this.Message = this.ColeccionNormal;
   

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
                    this.Message.push({
                        id: event.message['id'],
                        message: this.getDAES(event.message['message'] ),
                        user_id: event.message['user_id'],
                        user: event.message['user']
                    })
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
    convertir(){
            for (let i = 0; i <= this.Messages.length-1; i++) {
                    this.ColeccionNormal.push({
                        id: this.Messages[i].id,
                        message: this.getDAES(this.Messages[i].message ),
                        user_id: this.Messages[i].user_id,
                        user: this.Messages[i].user
                    })
            }
    },
    getAesString(data, key, iv){
      var key_hash = CryptoJS.MD5(key).toString();
      var key = CryptoJS.enc.Utf8.parse(key_hash);  
      var iv = CryptoJS.enc.Utf8.parse(iv);
      var encrypted = CryptoJS.AES.encrypt(data, key,
          {
              iv: iv,
              mode: CryptoJS.mode.CBC,
              padding: CryptoJS.pad.Pkcs7
          });
      return encrypted.toString();
    },
    getDAesString(encrypted, key, iv){
        var key_hash = CryptoJS.MD5(key).toString();
        var key = CryptoJS.enc.Utf8.parse(key_hash);
        var iv = CryptoJS.enc.Utf8.parse(iv);
        var decrypted = CryptoJS.AES.decrypt(encrypted, key,
            {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7
            });
        return decrypted.toString(CryptoJS.enc.Utf8);
    },
    getEAES(data){
      var encrypted = this.getAesString(data, KEY, IV);
      return encrypted;
    },
    getDAES(data){
      return this.getDAesString(data, KEY, IV);
    },
    ScrollToEnd(){
      var container = document.querySelector(".chat");
      var scrollHeight = container.scrollHeight;
      container.scrollTop = scrollHeight;
    },
     onSubmit() {

      this.encrypteds = this.getEAES(this.textarea);
    //   console.log(this.encrypteds);
    //   console.log(this.getDAES( this.encrypteds));

       this.Message.push({
         user: this.user,
         message: this.textarea
       });
      var url = "/addMessages"; 
       axios
        .post(url, {
          // message: this.textarea
          message: this.encrypteds
        })
        .then(response => {
            this.textarea = '';
        })
        .catch(error => {
          console.log(error.message);
        });
    },
          connect() {
                this.pusher = new Pusher(this.app.key, {
                    wsHost: this.app.host === null ? window.location.hostname : this.app.host,
                    wsPort: this.formConnect.port === null ? 6001 : this.port,
                    wssPort: this.formConnect.port === null ? 6001 : this.port,
                    wsPath: this.app.path === null ? '' : this.app.path,
                    disableStats: true,
                    authEndpoint: '/{{ request()->path() }}/auth',
                    auth: {
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}",
                            'X-App-ID': this.app.id
                        }
                    },
                    enabledTransports: ['ws', 'flash']
                });

                this.pusher.connection.bind('state_change', states => {
                    // $('div#status').text("Channels current state is " + states.current);
                });

                this.pusher.connection.bind('connected', () => {
                    this.connected = true;

                    // this.loadChart();
                });
                this.pusher.connection.bind('disconnected', () => {
                    this.connected = false;
                    this.logs = [];
                });
                this.pusher.connection.bind('error', event => {
                    if (event.error.data.code === 4100) {
                        $('div#status').text("Maximum connection limit exceeded!");
                        this.connected = false;
                        this.logs = [];
                        throw new Error("Over capacity");
                    }
                });
                this.subscribeToAllChannels();
                // this.subscribeToStatistics();
          },
          disconnect() {
                this.pusher.disconnect();
          },

          subscribeToAllChannels() {
                [
                    'disconnection',
                    'connection',
                    'vacated',
                    'occupied',
                    'subscribed',
                    'client-message',
                    'api-message',
                ].forEach(channelName => this.subscribeToChannel(channelName))
            },
            subscribeToChannel(channel) {
                this.pusher.subscribe('{{ \BeyondCode\LaravelWebSockets\Dashboard\DashboardLogger::LOG_CHANNEL_PREFIX }}' + channel)
                    .bind('log-message', (data) => {
                        this.logs.push(data);
                    });
            },
  },
  updated(){
    this.ScrollToEnd();
  }
};
</script>
