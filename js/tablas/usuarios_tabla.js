function Cargar_plantilla_usuarios(){
    
    Cabeceras_usuarios();
    if (document.getElementById('usuario_nivel').innerHTML=="ADMIN"){
        Agregar_usuario();
        Actualizar_usuario();
        Eliminar_usuario();
    }else{
        document.getElementById('formulario_agregar').innerHTML="";
        document.getElementById('busqueda_id').innerHTML="";
    }
    
    urlf ="http://10.10.20.15/api/rq_tUsuarios.php?usuario=";
    
    fetch(urlf).then(response => response.json())
            .then(usuarios_data => datos_fetch(usuarios_data))
            .catch(error => console.log(error))
        
        const datos_fetch=(usuarios_data)=>{
            var tabla_a = "";
            for(i=0;i<usuarios_data.length;i++)
                {
                    if(usuarios_data[i].Us_Usuario!="ADMIN"){
                        tabla_a +=
                            `<tr class="w3-pale-blue">
                                <td>${usuarios_data[i].Us_ID}</td>
                                <td>${usuarios_data[i].Us_Usuario}</td>`;
                        if(document.getElementById('usuario_nivel').innerHTML=="ADMIN"){
                            tabla_a +=`<td>${usuarios_data[i].Us_Contra}</td>
                                       <td>${usuarios_data[i].Us_Nivel}</td>`
                                
                        }
                        tabla_a+=`<td>${usuarios_data[i].Us_Descripcion}</td>
                                  </tr>`
                
                    }
                    

                }
            console.log('DESPUES DEL PHP:'+document.getElementById('usuario_nivel').innerHTML);
            document.getElementById('datos_tabla').innerHTML = "";
            document.getElementById('datos_tabla').innerHTML = tabla_a;
            
        }
        usuarios_data=0;
}

function Cabeceras_usuarios(){
    var ancho_tabla=document.getElementById('area_tabla');
    ancho_tabla.style.maxWidth='600px'; 
    document.getElementById('titulo').innerHTML="";
    titulo_tabla=`<b>USUARIOS</b>`
    document.getElementById('titulo').innerHTML=titulo_tabla;

    document.getElementById('cabeceras').innerHTML="";
    
    cabeceras_tabla=`<tr class="w3-light-grey">
                        <th>ID</th>
                        <th>Usuario</th>`;
    if(document.getElementById('usuario_nivel').innerHTML=="ADMIN"){
        cabeceras_tabla+=`<th>Contraseña</th>
                            <th>Nivel</th>`;
    }
    cabeceras_tabla+=`<th>Descripcion</th>
                    </tr>`;
                            
    document.getElementById('cabeceras').innerHTML=cabeceras_tabla;
}

function Agregar_usuario(){
    document.getElementById('formulario_agregar').innerHTML="";
    contenido_agregar=`<p>INGRESE LOS DATOS DEL NUEVO USUARIO</p>
                      <form action="/api/rq_tUsuarios.php" method="post" target="R1_iframe">
                        <p><input id="d1" class="w3-input w3-padding-16 w3-border" type="text" placeholder="USUARIO" required name="Us_usuario"></p>
                        <p><input id="d2" class="w3-input w3-padding-16 w3-border" type="text" placeholder="CONTRASEÑA" required name="Us_contraseña"></p>
                        <p><input id="d3" class="w3-input w3-padding-16 w3-border" type="text" placeholder="NIVEL" required name="Us_nivel"></p>
                        <p><input id="d4" class="w3-input w3-padding-16 w3-border" type="text" placeholder="DESCRIPCION" required name="Us_descripcion"></p>
                        <p><button class="w3-button" type="submit">AGREGAR</button></p>
                      </form>
                      <button onclick="limpiar_formulario_usuario(1,4)" type="button" class="w3-button  w3-bar-item  w3-sand w3-section w3-padding" style="width:47% !important">Limpiar</button>
                      <iframe name="R1_iframe" width="100%" height="30" class="w3-container w3-blue"  title="Iframe Example"></iframe>`;
    document.getElementById('formulario_agregar').innerHTML=contenido_agregar;
}

function Actualizar_usuario(){
    document.getElementById('busqueda_id').innerHTML="";
    busqueda_folio=`<label><b>INGRESE EL USUARIO</b></label>
                    <input id="usuarioA" class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Usuario" name="usuario" required>
                    <button onclick="Actualizar_datos_usuario()" type="button" class="w3-button w3-block">Buscar</button>`;
    document.getElementById('busqueda_id').innerHTML=busqueda_folio;
}

function Actualizar_datos_usuario(){
    if(document.getElementById("usuarioA").value!=="")
    {
        usuario_A = document.getElementById("usuarioA").value;
        //console.log(id_folio);
        let urlf = "http://10.10.20.15/api/rq_tUsuarios.php?usuario="+usuario_A;
        console.log(urlf);
        fetch(urlf).then(response =>response.json()) 
        .then(data =>actualizar(data))
        .catch(error=> console.log(error))

        const actualizar=(data)=>{
            console.log(data);
            let formulaio_a="";
            document.getElementById('formulario_actualizar').innerHTML=formulaio_a; 
            formulaio_a=
            `<p>INGRESE LOS DATOS A ACTUALIZAR</p>
            <form name="Actualizar" action="/api/rq_tUsuarios.php" method="post" target="R2_iframe">
                <label><b>ID: ${data[0].Us_ID} </b></label>
                <input id="d5" class="w3-input w3-border w3-margin-bottom" type="hidden" value =${data[0].Us_ID} name="US_A">
                <br>
                <label><b>Usuario</b></label>
                <input  id="d6" class="w3-input w3-padding-16 w3-border" type="text" value =${data[0].Us_Usuario} name="Us_usuario">
                <label><b>Contraseña</b></label>
                <input id="d7" class="w3-input w3-padding-16 w3-border" type="text" value =${data[0].Us_Contra} name="Us_contraseña">
                <label><b>Nivel</b></label>
                <input id="d8" class="w3-input w3-padding-16 w3-border" type="text" value =${data[0].Us_Nivel} name="Us_nivel">
                <label><b>Descripcion</b></label>
                <input id="d9" class="w3-input w3-padding-16 w3-border" type="text" value =${data[0].Us_Descripcion} name="Us_descripcion">
                <p><button class="w3-button" type="submit">ACTUALIZAR</button></p>
            </form>
            <button onclick="limpiar_formulario_usuario(5,9)" type="button" class="w3-button  w3-bar-item  w3-sand w3-section w3-padding" style="width:47% !important">Limpiar</button>
            <iframe name="R2_iframe" width="100%" height="30" class="w3-container w3-blue"  title="Iframe Example"></iframe>`;
            document.getElementById('formulario_actualizar').innerHTML=formulaio_a;      
        }
        data=0;
    }
}

function Eliminar_usuario(){
    document.getElementById('b_borrar_id').innerHTML="";
    borrar_folio=`<form name="Eliminar" action="/api/rq_tUsuarios.php" method="post" target="R3_iframe">
                    <label><b>INGRESE ID DEL USUARIO</b></label>
                    <input id="b_id_usuario" class="w3-input w3-border w3-margin-bottom" type="text" placeholder="ID" name="US_B" required>
                    <button type="buttom" class="w3-button w3-block">Eliminar</button>
                  </form>
                  <iframe name="R3_iframe" width="100%" height="30" class="w3-container w3-blue"  title="Iframe Example"></iframe> `;
    document.getElementById('b_borrar_id').innerHTML=borrar_folio;
}

function borrar_operador(){
    id_usuario_b = document.getElementById("b_id_usuario").value;
    console.log(id_usuario_b);
    let urlf = "http://10.10.20.15/api/rq_tUsuarios.php";
    var us_id = {DI: id_usuario_b};
    fetch(urlf,{
        method:'POST',
        body: JSON.stringify(us_id),
        headers:{
                    'Content-Type': 'application/json'
                }
    })
    .then(Response=>Response.string)
    .then(usuario_data=>eliminar(usuario_data))
    .catch(error=> console.log(error))

    const eliminar=(usuario_data)=>{
            console.log(usuario_data);
            document.getElementById('mensaje_eliminar').innerHTML="";
            document.getElementById('mensaje_eliminar').innerHTML=`Se elimino el registro del operador con folio: ${document.getElementById("b_id_usuario").value}`;
    }
    usuario_data=0;
}

function limpiar_formulario_usuario(ini,num){
    
    console.log(num);
    for(var i=ini;i<=num;i++){
        var id_elemento="d"+String(i);

        if(document.getElementById(id_elemento).value != ""){
            document.getElementById(id_elemento).value = "";
           
        }  
    }
    
    
}