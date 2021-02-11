if (typeof _methods.onChangeOrder === 'undefined') {
    _methods.onChangeOrder = function() {
          var _this = this;
          var _order = this.filters.order.split('|');
          _this.filters.page = 1;
          _this.filters.orderBy = _order[0];
          _this.filters.sortedBy = _order[1];

          _this.doFilter();
      };    
  }
  if (typeof _methods.onChangePage === 'undefined') {
      _methods.onChangePage = function(page) {
          var _this = this;
          _this.filters.page = page;
          _this.doFilter();
      };
  }

  if (typeof _methods.filter === 'undefined') {
      _methods.filter = function () {
          var _this = this;
          _this.filters.page = 1;
          _this.doFilter();
      };
  }

  if (typeof _methods.clearFilters === 'undefined') {
      _methods.clearFilters = function () {
          var _this = this;
          _this.filters.page = 1;
          _this.filters.search = null;
          _this.doFilter();
      };
  }    

  if (typeof _methods.doFilter === 'undefined') {
      _methods.doFilter = function () {
          var _this = this;
          _this.loading = true;
          _this._call(_this.url_filter,'POST',_this.filters).then(function(data) {
              _this.list.length = 0;
              _this.list = data.list;
              _this.paging = data.paging;
              _this.loading = false;
          }, function(error) {
              _this.loading = false;
          });
      };
  }


