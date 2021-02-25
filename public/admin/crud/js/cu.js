Vue.use(VeeValidate, {
    locale: 'es',
    dictionary: _dictionary,
});



if (typeof _methods.store === 'undefined') {
    _methods.store = function() {
        var _this = this;
        var _ajaxMethod = _this.selectedItem.id == 0 ? _this.ajaxPost : _this.ajaxPut ;
        var _is_valid = _this.validateForm();
        _this.alert.show = false;
        return _this.$validator.validateAll().then(function(result) {
            if (result && _is_valid) {
                return _ajaxMethod(_this.url_save,_this.selectedItem,true,_this.errors).then(function(data){
                    location.href = _this.url_index;
                });                            
            }
        });
    };
}

if (typeof _methods.validateForm === 'undefined') {
    _methods.validateForm = function() {
        var _this = this;
        return true;
    };
}

if (typeof _methods.cancel === 'undefined') {
    _methods.cancel = function() {
        location.href = this.url_index;
    }
}

if (typeof _methods.onBlur === 'undefined') {
    _methods.onBlur = function(field,model) {
      var _this = this;
      var _model = (typeof model !== 'undefined' ? model : _this.selectedItem);
      switch (field) {
        case 'order':
          _model.order = _model.order ? _model.order : 1;
          break;
      }
    }
}

if (typeof _methods.inputFile === 'undefined') {
    _methods.inputFile = function(newFile, oldFile,onSuccess, onError,ref) {
      // Automatic upload
      var _this = this;
      var _ref = typeof ref !== 'undefined' ? ref : 'upload';

      if (Boolean(newFile) !== Boolean(oldFile) || oldFile.error !== newFile.error) {
        if (!this.$refs[_ref].active) {
          this.$refs[_ref].active = true;
        }
      }

      if (newFile && oldFile) {
        if (newFile.success) {
          this.$refs[_ref].clear();
          onSuccess(newFile);
        }    
        if (newFile.error) {
          this.$refs[_ref].clear();
          onError(newFile);
        }                      
      }
    }
}


if(_data.selectedItem.contenido != ''){
  _data.listContents  = JSON.parse(_data.selectedItem.contenido);
}else{
  _data.listContents  = [];
}
_data.idList        = _data.listContents.length;

_data.contenidosTipo = [
  {
    id: 'imagen1',
    index: 0,
    btn: '+Fila 1 imagen',
    cols: 1,
    titulo: 'Fila de una sola imagen'
  },
  {
    id: 'imagen2',
    index: 1,
    btn: '+Fila - 2 imagenes',
    cols: 1,
    titulo: 'Fila con dos imagenes'
  },
  {
    id: 'textolibre',
    index: 2,
    btn: '+Fila - Texto Libre',
    cols: 1,
    titulo: 'Fila con texto libre'
  },{
    id: 'separador1',
    index: 3,
    btn: '+Separador en blanco',
    cols: 1,
    titulo: 'Separador Horizontal | 30px de alto'
  }
];



if (typeof _methods.agregaritem === 'undefined') {
  
  _methods.agregaritem = function(id, index, field,model) {
    
      var _this = this;
      _data.idList++;

      let mayorIndex = 0;
      _this.listContents.forEach( function(valor, indice, array) {
         if (mayorIndex < valor.index.replace("content_", "")){
          mayorIndex = parseInt(valor.index.replace("content_", ""));
         }

         console.log('mayorIndex: '+mayorIndex);
      });
      mayorIndex++;
      _data.idList = mayorIndex;
      var newItem = {
        id: id,
        index: 'content_'+_data.idList,
        nombre: _this.contenidosTipo[index].titulo,
        input: '',
      };

      _this.listContents.push(newItem);
      this.exportar();
    }
}

if (typeof _methods.removerItem === 'undefined') {
  
  _methods.removerItem = function(index,field,model) {
      var _this = this;
      for (var i = 0; i < _this.listContents.length; i++) {
        if(_this.listContents[i].index == index){
          _this.listContents.splice(i, 1);
          this.exportar();
        }
      }
      
     
    }
}


if (typeof _methods.exportar === 'undefined') {
  
  _methods.exportar = function(index,field,model) {
      var _this = this;
//      alert(JSON.stringify(_this.listContents));
      
        var childDivs = document.getElementById('accordion').getElementsByClassName('card');

        var sortArray = [];
        for( i=0; i< childDivs.length; i++ )
        {
         var childDiv = childDivs[i];
         console.log('childDiv'+childDiv.getAttribute('index'));

          for (var j = 0; j < _this.listContents.length; j++) {
            if(_this.listContents[j].index == childDiv.getAttribute('index')){
              sortArray.push(_this.listContents[j]);
            }
          }

        }

        _data.listContents = sortArray;
        _data.selectedItem.contenido = JSON.stringify(_data.listContents);
    }
}

if (typeof _methods.checkMove === 'undefined') {
  
  _methods.checkMove = function(evt) {
      var _this = this;
      this.exportar();
     
    }
}

