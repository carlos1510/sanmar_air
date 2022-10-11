/**
 * Created by carlo on 13/09/2018.
 */

function validar_campo(lista){
    var valido=true;
    for(var i=0;i<lista.length;i++){
        $elemento= $(lista[i]);
        $parent=$elemento.parent();
        if( $elemento.val()=='' || $elemento.val()==' ' ||$elemento.val()==null){
            $parent.addClass("has-error");
            $elemento.focus();
            valido=false;
        }else{
            $parent.removeClass("has-error");
        }
    }
    return valido;
}

function ocultar(lista){
    for (var i=0;i<lista.length;i++){
        $elemento =lista[i];
        document.getElementById(''+$elemento).style.display = "none";
    }
}

function mostrar(lista){
    for (var i=0;i<lista.length;i++){
        $elemento =lista[i];
        document.getElementById(''+$elemento).style.display = "block";
    }
}

function round(number, precision) {
    var pair = (number + 'e').split('e')
    var value = Math.round(pair[0] + 'e' + (+pair[1] + precision))
    pair = (value + 'e').split('e')
    return +(pair[0] + 'e' + (+pair[1] - precision))
}

function bloquear_desbloquear_campo(lista, accion){
    for(var i=0;i<lista.length;i++){
        if( accion == 'B'){
            $(lista[i]).prop('readonly', true);
        }else{
            $(lista[i]).prop('readonly', false);
        }
    }
}
