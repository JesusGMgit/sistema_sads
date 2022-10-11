function Cargar_plantilla_operadores(){
    
    Cabeceras_operadores();
    Agregar_operadores();
    Actualizar_operadores();
    urlf ="http://10.10.20.15/api/rq_tOperadores.php?id=";
    fetch(urlf).then(response => response.json())
            .then(operadores_data => datos_fetch(operadores_data))
            .catch(error => console.log(error))
        
        const datos_fetch=(operadores_data)=>{
            var tabla_a = "";
            for(i=0;i<operadores_data.length;i++)
                {
                    tabla_a +=
                            `<tr class="w3-pale-blue">
                                <td>${operadores_data[i].Op_Folio}</td>
                                <td>${operadores_data[i].Op_Nombre}</td>
                                <td>${operadores_data[i].Op_Clave_soldador}</td>
                                <td>${operadores_data[i].Op_Puesto}</td>
                            </tr>`;
                }
            document.getElementById('datos_tabla').innerHTML = "";
            document.getElementById('datos_tabla').innerHTML = tabla_a;
            
        }
        operadores_data=0;
}

function Cabeceras_operadores(){
    var ancho_tabla=document.getElementById('area_tabla');
    ancho_tabla.style.maxWidth='600px';
    document.getElementById('titulo').innerHTML="";
    titulo_tabla=`<b>OPERADORES</b>`
    document.getElementById('titulo').innerHTML=titulo_tabla;

    document.getElementById('cabeceras').innerHTML="";
    
    cabeceras_tabla=`<tr class="w3-light-grey">
                        <th>Folio</th>
                        <th>Nombre</th>
                        <th>Clave</th>
                        <th>Puesto</th>
                    </tr>`;
    document.getElementById('cabeceras').innerHTML=cabeceras_tabla;
}

function Agregar_operadores(){
    document.getElementById('formulario_agregar').innerHTML="";
    contenido_agregar=`<p>INGRESE LOS DATOS DEL NUEVO OPERADOR</p>
                      <form action="/api/rq_tOperadores.php" method="post" target="R1_iframe">
                        <p><input id="d1" class="w3-input w3-padding-16 w3-border" type="number" placeholder="FOLIO" required name="Op_folio"></p>
                        <p><input id="d2" class="w3-input w3-padding-16 w3-border" type="text" placeholder="NOMBRE" required name="Op_nombre"></p>
                        <p><input id="d3" class="w3-input w3-padding-16 w3-border" type="text" placeholder="CLAVE SOLDADOR" required name="Op_clave_soldador"></p>
                        <p><input id="d4" class="w3-input w3-padding-16 w3-border" type="text" placeholder="PUESTO" required name="Op_puesto"></p>
                        <p><button class="w3-button" type="submit">AGREGAR</button></p>
                      </form>
                      <button onclick="limpiar_formulario_operador(1,4)" type="button" class="w3-button  w3-bar-item  w3-sand w3-section w3-padding" style="width:47% !important">Limpiar</button>
                      <iframe name="R1_iframe" width="100%" height="30" class="w3-container w3-blue"  title="Iframe Example"></iframe>`;
    document.getElementById('formulario_agregar').innerHTML=contenido_agregar;
}

function Actualizar_operadores(){
    document.getElementById('busqueda_id').innerHTML="";
    busqueda_folio=`<label><b>INGRESE FOLIO DEL OPERADOR</b></label>
                    <input id="folio_operador" class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Folio" name="id" required>
                    <button onclick="Actualizar_datos_operador()" type="button" class="w3-button w3-block">Buscar</button>`;
    document.getElementById('busqueda_id').innerHTML=busqueda_folio;
}

function Actualizar_datos_operador(){
    if(document.getElementById("folio_operador").value!=="")
    {
        id_folio = document.getElementById("folio_operador").value;
        let urlf = "http://10.10.20.15/api/rq_tOperadores.php?id="+id_folio;
        console.log(urlf);
        fetch(urlf).then(response =>response.json()) 
        .then(data =>actualizar(data))
        .catch(error=> console.log(error))

        const actualizar=(data)=>{
            let formulaio_a="";
            document.getElementById('formulario_actualizar').innerHTML=formulaio_a; 
            formulaio_a=
            `<p>INGRESE LOS DATOS DEL NUEVO OPERADOR</p>
            <form name="Actualizar" action="/api/rq_tOperadores.php" method="post" target="R2_iframe">
                <label><b>Folio: ${data[0].Op_Folio} </b></label>
                <input id="d5" class="w3-input w3-border w3-margin-bottom" type="hidden" value =${data[0].Op_Folio} name="DI_A">
                <br>
                <label><b>Clave de soldador del operador</b></label>
                <input  id="d6" class="w3-input w3-padding-16 w3-border" type="text" value =${data[0].Op_Clave_soldador} name="Op_clave_soldador">
                <label><b>Puesto del trabajador</b></label>
                <input id="d7" class="w3-input w3-padding-16 w3-border" type="text" value =${data[0].Op_Puesto} name="Op_puesto">
                <label><b>Nombre del operador</b></label>
                <input id="d8" class="w3-input w3-padding-16 w3-border" type="text" value =${data[0].Op_Nombre} name="Op_nombre">
                <p><button class="w3-button" type="submit">ACTUALIZAR</button></p>
            </form>
            <button onclick="limpiar_formulario_operador(5,8)" type="button" class="w3-button  w3-bar-item  w3-sand w3-section w3-padding" style="width:47% !important">Limpiar</button>
            <iframe name="R2_iframe" width="100%" height="30" class="w3-container w3-blue"  title="Iframe Example"></iframe>`;
            document.getElementById('formulario_actualizar').innerHTML=formulaio_a;      
        }
        data=0;
    }
}

function Eliminar_operador(){
    document.getElementById('b_borrar_id').innerHTML="";
    borrar_folio=`<form name="Eliminar" action="/api/rq_tOperadores.php" method="post" target="R3_iframe">
                    <label><b>INGRESE FOLIO DEL OPERADOR</b></label>
                    <input id="b_folio_operador" class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Folio" name="DI_B" required>
                    <button type="buttom" class="w3-button w3-block">Eliminar</button>
                  </form>
                  <iframe name="R3_iframe" width="100%" height="30" class="w3-container w3-blue"  title="Iframe Example"></iframe> `;
    document.getElementById('b_borrar_id').innerHTML=borrar_folio;
}

function borrar_operador(){
    id_folio_b = document.getElementById("b_folio_operador").value;
    let urlf = "http://10.10.20.15/api/rq_tOperadores.php";
    var op_folio = {DI: id_folio_b};
    fetch(urlf,{
        method:'POST',
        body: JSON.stringify(op_folio),
        headers:{
                    'Content-Type': 'application/json'
                }
    })
    .then(Response=>Response.string)
    .then(operador_data=>eliminar(operador_data))
    .catch(error=> console.log(error))

    const eliminar=(operador_data)=>{
            console.log(operador_data);
            document.getElementById('mensaje_eliminar').innerHTML="";
            document.getElementById('mensaje_eliminar').innerHTML=`Se elimino el registro del operador con folio: ${document.getElementById("b_folio_operador").value}`;
    }
    operador_data=0;
}

function limpiar_formulario_operador(ini,num){
    
    console.log(num);
    for(var i=ini;i<=num;i++){
        var id_elemento="d"+String(i);

        if(document.getElementById(id_elemento).value != ""){
            document.getElementById(id_elemento).value = "";
           
        }  
    }
    
    
}
