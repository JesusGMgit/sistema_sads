function Cargar_plantilla_proyectos(){
    
    Cabeceras_proyectos();
    Agregar_proyectos();
    Actualizar_proyecto();
    Eliminar_proyecto();
    urlf ="http://10.10.20.15/api/rq_tProyectos.php?id=";
    fetch(urlf).then(response => response.json())
            .then(proyectos_data => datos_fetch(proyectos_data))
            .catch(error => console.log(error))
        
        const datos_fetch=(proyectos_data)=>{
            var tabla_a = "";
            for(i=0;i<proyectos_data.length;i++)
                {
                    tabla_a +=
                            `<tr class="w3-pale-blue">
                                <td>${proyectos_data[i].Pro_ID}</td>
                                <td>${proyectos_data[i].Pro_Nombre}</td>
                                <td>${proyectos_data[i].Pro_Diametro}</td>
                                <td>${proyectos_data[i].Pro_Espesor}</td>
                                <td>${proyectos_data[i].Pro_Alambre}</td>
                                <td>${proyectos_data[i].Pro_Fundente}</td>
                                <td>${proyectos_data[i].Pro_OrdenTrabajo}</td>
                                <td>${proyectos_data[i].Pro_Especificacion}</td>
                                <td>${proyectos_data[i].Pro_WPS}</td>
                            </tr>`;
                }
            document.getElementById('datos_tabla').innerHTML = "";
            document.getElementById('datos_tabla').innerHTML = tabla_a;
            
        }
        proyectos_data=0;
}

function Cabeceras_proyectos(){
    var ancho_tabla=document.getElementById('area_tabla');
    ancho_tabla.style.maxWidth='900px';
    document.getElementById('titulo').innerHTML="";
    titulo_tabla=`<b>PROYECTOS</b>`
    document.getElementById('titulo').innerHTML=titulo_tabla;

    document.getElementById('cabeceras').innerHTML="";
    
    cabeceras_tabla=`<tr class="w3-light-grey">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Diametro</th>
                        <th>Espesor</th>
                        <th>Alambre</th>
                        <th>Fundente</th>
                        <th>Orden T</th>
                        <th>Especificacion</th>
                        <th>WPS</th>
                    </tr>`;
    document.getElementById('cabeceras').innerHTML=cabeceras_tabla;
}

function Agregar_proyectos(){
    document.getElementById('formulario_agregar').innerHTML="";
    contenido_agregar=`<p>INGRESE LOS DATOS DEL NUEVO PROYECTO</p>
                      <form action="/api/rq_tProyectos.php" method="post" target="R1_iframe">
                        <p><input id="d1" class="w3-input w3-padding-16 w3-border" type="text" placeholder="NOMBRE" required name="Pro_nombre"></p>
                        <p><input id="d2" class="w3-input w3-padding-16 w3-border" type="text" placeholder="DIAMETRO" required name="Pro_diametro"></p>
                        <p><input id="d3" class="w3-input w3-padding-16 w3-border" type="text" placeholder="ESPESOR" required name="Pro_espesor"></p>
                        <p><input id="d4" class="w3-input w3-padding-16 w3-border" type="text" placeholder="ALAMBRE" required name="Pro_alambre"></p>
                        <p><input id="d5" class="w3-input w3-padding-16 w3-border" type="text" placeholder="FUNDENTE" required name="Pro_fundente"></p>
                        <p><input id="d6" class="w3-input w3-padding-16 w3-border" type="text" placeholder="ORDEN TRABAJO" required name="Pro_ordentrabajo"></p>
                        <p><input id="d7" class="w3-input w3-padding-16 w3-border" type="text" placeholder="ESPECIFICACION" required name="Pro_especificacion"></p>
                        <p><input id="d7" class="w3-input w3-padding-16 w3-border" type="text" placeholder="WPS" required name="Pro_wps"></p>
                        <p><button class="w3-button" type="submit">AGREGAR</button></p>
                      </form>
                      <button onclick="limpiar_formulario_proyecto(1,7)" type="button" class="w3-button  w3-bar-item  w3-sand w3-section w3-padding" style="width:47% !important">Limpiar</button>
                      <iframe name="R1_iframe" width="100%" height="30" class="w3-container w3-blue"  title="Iframe Example"></iframe>`;
    document.getElementById('formulario_agregar').innerHTML=contenido_agregar;
}

function Actualizar_proyecto(){
    document.getElementById('busqueda_id').innerHTML="";
    busqueda_folio=`<label><b>INGRESE ID DE PROYECTO</b></label>
                    <input id="id_proyecto" class="w3-input w3-border w3-margin-bottom" type="text" placeholder="ID" name="id" required>
                    <button onclick="Actualizar_datos_proyecto()" type="button" class="w3-button w3-block">Buscar</button>`;
    document.getElementById('busqueda_id').innerHTML=busqueda_folio;
}

function Actualizar_datos_proyecto(){
    if(document.getElementById("id_proyecto").value!=="")
    {
        id_proyecto = document.getElementById("id_proyecto").value;
        let urlf = "http://10.10.20.15/api/rq_tProyectos.php?id="+id_proyecto;
        fetch(urlf).then(response =>response.json()) 
        .then(data_proyecto =>actualizar(data_proyecto))
        .catch(error=> console.log(error))

        const actualizar=(data_proyecto)=>{
            let formulaio_a="";
            document.getElementById('formulario_actualizar').innerHTML=formulaio_a; 
            formulaio_a=
            `<p>INGRESE LOS DATOS DEL PROYECTO</p>
            <form name="Actualizar" action="/api/rq_tProyectos.php" method="post" target="R2_iframe">
                <label><b>ID Proyecto: ${data_proyecto[0].Pro_ID} </b></label>
                <input id="d8" class="w3-input w3-border w3-margin-bottom" type="hidden" value =${data_proyecto[0].Pro_ID} name="DI_A">
                <br>
                <label><b>nombre de Proyecto</b></label>
                <input  id="d9" class="w3-input w3-padding-16 w3-border" type="text" value =${data_proyecto[0].Pro_Nombre} name="Pro_nombre">
                <label><b>Diametro del tubo</b></label>
                <input  id="d10" class="w3-input w3-padding-16 w3-border" type="number" value =${data_proyecto[0].Pro_Diametro} name="Pro_diametro">
                <label><b>Espesor de placa</b></label>
                <input id="d11" class="w3-input w3-padding-16 w3-border" type="number" value =${data_proyecto[0].Pro_Espesor} name="Pro_espesor">
                <label><b>Tipo de alambre</b></label>
                <input id="d12" class="w3-input w3-padding-16 w3-border" type="text" value =${data_proyecto[0].Pro_Alambre} name="Pro_alambre">
                <label><b>Tipo de fundente</b></label>
                <input id="d13" class="w3-input w3-padding-16 w3-border" type="text" value =${data_proyecto[0].Pro_Fundente} name="Pro_fundente">
                <label><b>Orden de trabajo</b></label>
                <input id="d14" class="w3-input w3-padding-16 w3-border" type="text" value =${data_proyecto[0].Pro_OrdenTrabajo} name="Pro_ordentrabajo">
                <label><b>Especificacion</b></label>
                <input id="d15" class="w3-input w3-padding-16 w3-border" type="text" value =${data_proyecto[0].Pro_Especificacion} name="Pro_especificacion">
                <p><button class="w3-button" type="submit">ACTUALIZAR</button></p>
            </form>
            <button onclick="limpiar_formulario_proyecto(8,15)" type="button" class="w3-button  w3-bar-item  w3-sand w3-section w3-padding" style="width:47% !important">Limpiar</button>
            <iframe name="R2_iframe" width="100%" height="30" class="w3-container w3-blue"  title="Iframe Example"></iframe>`;
            document.getElementById('formulario_actualizar').innerHTML=formulaio_a;      
        }
        data=0;
    }
}

function Eliminar_proyecto(){
    document.getElementById('b_borrar_id').innerHTML="";
    borrar_folio=`<form name="Actualizar" action="/api/rq_tProyectos.php" method="post" target="R3_iframe">
                    <label><b>INGRESE ID DE PROYECTO</b></label>
                    <input id="b_id_proyecto" class="w3-input w3-border w3-margin-bottom" type="text" placeholder="ID" name="DI_B" required>
                    <button type="buttom" class="w3-button w3-block">Eliminar</button>
                  </form>
                  <iframe name="R3_iframe" width="100%" height="30" class="w3-container w3-blue"  title="Iframe Example"></iframe> `;
    document.getElementById('b_borrar_id').innerHTML=borrar_folio;
}

function borrar_proyecto(){
    id_proyecto_b = document.getElementById("b_id_proyecto").value;
    let urlf = "http://10.10.20.15/api/rq_tOperadores.php";
    var pro_id = {DI: id_proyecto_b};
    fetch(urlf,{
        method:'POST',
        body: JSON.stringify(pro_id),
        headers:{
                    'Content-Type': 'application/json'
                }
    })
    .then(Response=>Response.string)
    .then(proyecto_data=>eliminar(proyecto_data))
    .catch(error=> console.log(error))

    const eliminar=(proyecto_data)=>{
            document.getElementById('mensaje_eliminar').innerHTML="";
            document.getElementById('mensaje_eliminar').innerHTML=`Se elimino el registro del operador con folio: ${document.getElementById("b_id_proyecto").value}`;
    }
    proyecto_data=0;
}

function limpiar_formulario_proyecto(ini,num){
    
    for(var i=ini;i<=num;i++){
        var id_elemento="d"+String(i);

        if(document.getElementById(id_elemento).value != ""){
            document.getElementById(id_elemento).value = "";
           
        }  
    }
    
    document.getElementById('formulario_actualizar').innerHTML="";
}