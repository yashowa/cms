console.log('ok')
import css from './sass/style.scss';

//console.log(css)

require ('./js/admin/users.js');




$(document).on('ready',function(){
    setTimeout(function(){
        $('#notification-bar').removeClass('success fadeOut');
        $('#notification-bar').removeClass('danger fadeOut');
    },1500);
})