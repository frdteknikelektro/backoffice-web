'use strict';

require('./../app');

const ResourceDatatable = require('./../resource-datatable');

$(document).ready(function() {
  window.UserDatatable = new ResourceDatatable('users', {
    columns: [
      { data: 'name', type: 'string' },
      { data: 'email', type: 'string' },
      { data: 'id' }
    ]
  });
});
