require('./app');

window.type = ['', 'info', 'success', 'warning', 'danger'];

window.demo = require('./demo');

$(document).ready(function() {

  demo.initChartist();

  demo.initGoogleMaps();

  $.notify({
    icon: 'pe-7s-gift',
    message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."
  }, {
    type: 'info',
    timer: 4000
  });
});

const app = new Vue({
    el: '#app',

    data: {
        user: {},
        messages: []
    },

    created() {
        this.messagesIndex();
        Echo.private('chat').listen('MessageSent', function (e) {
          this.messages.push({
            message: e.message.message,
            user: e.user
          });
        }.bind(this));

        axios.get('/api/user').then(response => {
            this.user = response.data.data;
        });
    },

    updated: function () {
        this.$nextTick(function () {
            var el = document.getElementsByClassName('messages-container')[0];
            el.scrollTop = el.scrollHeight;
        });
    },

    methods: {
        messagesIndex() {
            return axios.get('/api/messages').then(response => {
                this.messages = response.data.data.data.reverse();
            });
        },

        messagesStore(message) {
            this.messages.push(message);

            axios.post('/api/messages', {
                user_id: message.user.id,
                message: message.message
            }).then(response => {
                console.log(response.data.data);
            });
        }
    }
});
