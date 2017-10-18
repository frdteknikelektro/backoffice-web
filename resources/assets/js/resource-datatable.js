'use strict';

const Resource = require('./resource');

if (typeof window.$ === 'undefined' && typeof window.jQuery === 'undefined') {
  window.$ = window.jQuery = require('jquery');
} else if (typeof window.$.fn.DataTable === 'undefined') {
  require('datatables.net');
  require('datatables.net-bs');
  require('datatables.net-responsive');
  require('datatables.net-responsive-bs');
}

function ResourceDatatable(resource, option = null) {
  this.resource = new Resource(resource);
  var defaultOption = {
    pageLength: 25,
    responsive: {
      details: {
        type: 'column',
        target: 'tr > td:not(:last-child)'
      }
    },
    processing: true,
    serverSide: true,
    ajax: {
      headers: { 'X-Datatables': 'Datatables' }
    },
    columnDefs: [
      { responsivePriority: 9998, targets: 0 },
      {
        targets: -1,
        responsivePriority: 9999,
        searchable: false,
        sortable: false,
        width: '72px',
        render: function (data, type, full, meta) {
          return '<a rel="tooltip" title="Show" class="table-action-button action-edit" href="'+resource+'/'+data+'"><i class="pe-7s-look"></i></a>' +
                 '<a rel="tooltip" title="Edit" class="table-action-button action-edit" href="'+resource+'/'+data+'/edit"><i class="pe-7s-note"></i></a>' +
                 '<a rel="tooltip" title="Delete" class="table-action-button action-delete" href="#" data-id="'+data+'" data-row="'+meta.row+'"><i class="pe-7s-trash"></i></a>';
        }
      }
    ]
  };
  this.option = $.extend(true, defaultOption, option);
  this.datatable = $('#'+resource).DataTable(this.option);
  this.datatable.on('draw', function (e) {
    $('a.table-action-button.action-delete').on('click', function (e) {
      e.preventDefault();
      this.delete($(e.delegateTarget).data('id'), $(e.delegateTarget).data('row'));
    }.bind(this));
  }.bind(this));

  $('.dataTables_filter label').append(
    ' <a href="'+resource+'/create" class="btn btn-default btn-sm">' +
    '<i class="pe-7s-plus"></i>' +
    '</a>'
  );
}

ResourceDatatable.prototype.delete = function (id, row) {
  return confirm('Deleting data. Clik OK to continue.') ? this.resource.delete(id).then(function (response) {
    this.datatable.row(row).remove().draw();
  }.bind(this, row)).catch(function (error) {
    alert(error.response.data.message);
  }) : false;
}

module.exports = ResourceDatatable;
