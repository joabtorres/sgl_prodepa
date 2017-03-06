/* fundo_tela_login - Moda background da tag body se existi container tela_login*/
function fundo_tela_login() {
    if(document.getElementById('tela_login')){
        $('body').css('background-color', '#EBEFF2');
    }
}
/*
* @author Joab Torres Alencar
* @description Está função submite o forumlário de buscar rápida que está no menu principal
* Menu principal 
*/
function submit_form_navbar(){
    if(document.nSearchSGL){
        document.nSearchSGL.submit();
    }
}

$(document).ready(function(){
    fundo_tela_login();
});
