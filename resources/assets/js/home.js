require('./app');

window.type = ['', 'info', 'success', 'warning', 'danger'];

window.demo = require('./demo');

$(document).ready(function() {

  demo.initChartist();

  $.notify({
    icon: 'pe-7s-gift',
    message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."
  }, {
    type: 'info',
    timer: 4000
  });
});
