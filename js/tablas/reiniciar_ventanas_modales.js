function reiniciar(x_click){
    tabla_selecionada=document.getElementById('titulo').innerHTML;
    document.getElementById('formulario_agregar').innerHTML="";
    document.getElementById('busqueda_id').innerHTML="";
    document.getElementById('b_borrar_id').innerHTML="";
    document.getElementById('formulario_actualizar').innerHTML=""; 

    if(x_click=="xa"){
        document.getElementById('m_op1').style.display='none';
    }else if(x_click=="xr"){
        document.getElementById('m_op2').style.display='none';
    }else if(x_click=="xe"){
        document.getElementById('m_op3').style.display='none';
    }
    
    
    if(tabla_selecionada=="<b>OPERADORES</b>"){
        Cargar_plantilla_operadores();    
    }else if(tabla_selecionada=="<b>PROYECTOS</b>"){
        Cargar_plantilla_proyectos()
    }else if(tabla_selecionada=="<b>SOLDADURA EXTERNA</b>"){
        Cargar_plantilla_soldadura_externa()
    }else if(tabla_selecionada=="<b>SOLDADURA INTERNA</b>"){
        Cargar_plantilla_soldadura_interna()
    }else if(tabla_selecionada=="<b>USUARIOS</b>"){
        Cargar_plantilla_usuarios()
    }

}