/* fundo_tela_login - Moda background da tag body se existi container tela_login*/
function fundo_tela_login() {
    if(document.getElementById('tela_login')){
        $('body').css('background-color', '#EBEFF2');
    }
}

$(document).ready(function(){
    fundo_tela_login();
});
