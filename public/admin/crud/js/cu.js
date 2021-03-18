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
      console.log('oldFile: '+oldFile);
      console.log('newFile: '+newFile.error);

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
_data.idList            = _data.listContents.length;
_data.footer            = _data.selectedItem.footer;
_data.legales            = _data.selectedItem.legales;

_data.contenidosTipo = [
  {
    id: 'imagen1',
    index: 0,
    btn: 'Banner horizontal',
    cols: 1,
    titulo: 'Banner horizontal'
  },
  {
    id: 'imagen2',
    index: 1,
    btn: '2 banners verticales',
    cols: 1,
    titulo: '2 banners verticales'
  },
  {
    id: 'textolibre',
    index: 2,
    btn: 'Texto Libre',
    cols: 1,
    titulo: 'Texto libre'
  },
  {
    id: 'separador1',
    index: 3,
    btn: 'Separador en blanco',
    cols: 1,
    titulo: 'Separador en blanco'
  },
  {
    id: 'contenido_predefinido',
    index: 4,
    btn: 'Contenido predefinido',
    cols: 1,
    titulo: 'Contenido predefinido'
  },
  {
    id: 'textoplano',
    index: 5,
    btn: 'Contenido HTML',
    cols: 1,
    titulo: 'Contenido HTML'
  }
];



if (typeof _methods.agregaritem === 'undefined') {
  
  _methods.agregaritem = function(id, index, field,model) {
    
      var _this = this;
      _data.idList++;

      let mayorIndex = 0;
      console.log(_this.listContents);
      _this.listContents.forEach( function(valor, indice, array) {
         if (mayorIndex < valor.index.replace("content_", "")){
          mayorIndex = parseInt(valor.index.replace("content_", ""));
         }

         console.log('mayorIndex: '+mayorIndex);
      });
      mayorIndex++;
      _data.idList = mayorIndex;
      var inputNew = '';
      if (id == 'separador1'){
        inputNew = 30;
      }
      var newItem = {
        id: id,
        unique: _data.idList,
        filevalue: [],
        fileurl: [],
        index: 'content_'+_data.idList,
        nombre: _this.contenidosTipo[index].titulo,
        input: inputNew,
      };

      if (id == 'imagen1'){
        newItem['link'] = 'https://www.smiles.com.ar/';
      }

      if (id == 'imagen2'){
        newItem['link'] = 'https://www.smiles.com.ar/';
        newItem['link2'] = 'https://www.smiles.com.ar/';
      }

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


if (typeof _methods.deleteImage === 'undefined') {
  _methods.deleteImage = function(evt, item, pos) {
    var _this = this;
    console.log('delete');
    evt.preventDefault();
    if(pos == 1){
      item.input = '';
    }else{
      item.input2 = '';
    }
    _this.exportar();
  }
}
if (typeof _methods.exportar === 'undefined') {
  
  _methods.exportar = function(index,field,model) {
      var _this = this;

     
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

if (typeof _methods.viewContent === 'undefined') {
  
  _methods.viewContent = function(evt, preview, item) {
      var _this = this;
      let contenidoHTML = evt.target[evt.target.selectedIndex].getAttribute('contenido');
      let contenidoHTML2 = evt.target[evt.target.selectedIndex].getAttribute('contenido');
      
      document.getElementById(preview).innerHTML = contenidoHTML;
      //item.contenidohtml = contenidoHTML;

      this.exportar();
     
    }
}

if (typeof _methods.checkMove === 'undefined') {
  
  _methods.checkMove = function(evt) {
      var _this = this;
      this.exportar();
     
    }
}

var objFooter = new Object();

if (_data.selectedItem.footer){
  objFooter = new Object(JSON.parse(_data.selectedItem.footer));
  _data.id_redes    = JSON.parse(objFooter).redes;
  _data.id_footer   = JSON.parse(objFooter).footer;
}else{
  _data.id_redes    = 0;
  _data.id_footer   = 0;
}

var objLegales = new Object();

if (_data.selectedItem.legales){
  objLegales = new Object(JSON.parse(_data.selectedItem.legales));
  _data.id_legales   = JSON.parse(objLegales).legales;
  _data.legales_custom   = JSON.parse(objLegales).legales_custom;
}else{
  _data.id_legales        = 0;
  _data.legales_custom    = '';
}



if (typeof _methods.selectFooter === 'undefined') {
  
  _methods.selectFooter = function(evt, $tipo) {
      var _this = this;
      if($tipo == 'footer'){
        _data.id_footer = evt.target.value;
      }

      if($tipo == 'redes'){
        _data.id_redes = evt.target.value;
      }
      let $footer = {footer: _data.id_footer, redes: _data.id_redes};
      _data.footer  = JSON.stringify($footer);
      _data.selectedItem.footer = JSON.stringify(_data.footer);
     
     
    }
}

if (typeof _methods.selectLegales === 'undefined') {
  
  _methods.selectLegales = function(evt, $tipo) {
      var _this = this;

      if($tipo == 'predefinido'){
        _data.id_legales = evt.target.value;
      }

      if($tipo == 'legales_custom'){
        _data.legales_custom = evt;
      }

      let $legales = {legales: _data.id_legales, legales_custom: _data.legales_custom};
      _data.legales  = JSON.stringify($legales);
      _data.selectedItem.legales = JSON.stringify(_data.legales);
     
     
    }
}

if (typeof _methods.downloadHtml === 'undefined') {
  
  _methods.downloadHtml = function(filename, idelement) {
      var contentHTML = document.getElementById(idelement).innerHTML;
      var element = document.createElement('a');
      element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(contentHTML));
      element.setAttribute('download', filename);

      element.style.display = 'none';
      document.body.appendChild(element);

      element.click();

      document.body.removeChild(element);
     
     
    }
}
