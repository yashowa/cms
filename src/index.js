console.log('ok')
import css from './sass/style.scss';
//import DataFormat from './js/features/DataFormat';
//require ('./js/features/DataFormat.js');
require ('./js/admin/users.js');


$(document).on('ready',function(){
    setTimeout(function(){
        $('#notification-bar').removeClass('success fadeOut');
        $('#notification-bar').removeClass('danger fadeOut');
    },1500);
})
