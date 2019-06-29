//class in order to format specific $datas
var DataFormat={
  isValid: function(val,format){
      switch(format){
        case 'name':
        var regexp = /^[a-zA-ZàáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ\s]{2,40}$/i;
        break;
        case 'email':
        var regexp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        break;
        case 'password':
        var regexp = /([A-Za-z0-9]){4,}/;
        break;
        default:
        return true;
        break;
      }
      if(!regexp.test(val)){
          return false;
      }

      return true;
  },
  name:"DataFormat"
}
module.exports =  DataFormat;
