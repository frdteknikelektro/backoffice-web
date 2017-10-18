'use strict';

if (typeof window.axios === 'undefined') {
  window.axios = require('axios');
}

function Resource(resource) {
  this.resource = resource;
}

Resource.prototype.index = function() {
  return axios.get(this.resource);
};

Resource.prototype.show = function(id) {
  return axios.get(this.resource + '/' + id);
};

Resource.prototype.update = function(id, param) {
  return axios.put(this.resource + '/' + id, param);
};

Resource.prototype.delete = function(id) {
  return axios.delete(this.resource + '/' + id);
};

module.exports = Resource;
