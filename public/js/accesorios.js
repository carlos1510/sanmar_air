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

function obtenerNombreMes(mes){
    var lista = [
        {'mes':1, 'nombre': 'Enero'},
        {'mes':2, 'nombre': 'Febrero'},
        {'mes':3, 'nombre': 'Marzo'},
        {'mes':4, 'nombre': 'Abril'},
        {'mes':5, 'nombre': 'Mayo'},
        {'mes':6, 'nombre': 'Junio'},
        {'mes':7, 'nombre': 'Julio'},
        {'mes':8, 'nombre': 'Agosto'},
        {'mes':9, 'nombre': 'Setiembre'},
        {'mes':10, 'nombre': 'Octubre'},
        {'mes':11, 'nombre': 'Noviembre'},
        {'mes':12, 'nombre': 'Diciembre'}
    ];
    var resultado = "";
    for (var i = 0; i < lista.length; i++){
        if (mes == lista[i].mes){
            resultado = lista[i].nombre;
            break;
        }
    }
    return resultado;
}
