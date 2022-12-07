function Cargar_plantilla_soldadura_interna(){
 
    Cabeceras_soldadura_interna();
    Agregar_registro_tabla_internas()
    Actualizar_tabla_internas();
    Eliminar_registro_tabla_interna()

    document.getElementById('datos_tabla').innerHTML = "";

    for(i=1;i<=3;i++){
        maquina_tabla="INTERNA"+i;
        url_tabla ="http://10.10.20.15/api/internas/rq_tTuberiaInterna_"+i+".php";
        llenar_tabla_internas(url_tabla,maquina_tabla);
    }
    
}

function llenar_tabla_internas(urlf,maquina){
    fetch(urlf).then(response => response.json())
            .then(interna_data => datos_fetch(interna_data))
            .catch(error => console.log(error))
        
        const datos_fetch=(internas_data)=>{
            var tabla_a = "";
           console.log(maquina);
            for(i=0;i<internas_data.length;i++)
                {
                    if (internas_data[i].Tin_Reporte_excel!=""){
                        id_tubo_insnr=`<td><b>${internas_data[i].Tin_ID_tubo}</b></td>`;
                    }else{
                        id_tubo_insnr=`<td>${internas_data[i].Tin_ID_tubo}</td>`;
                    }
                    tabla_a +=
                            `<tr class="w3-pale-blue">`
                                + id_tubo_insnr +
                                `<td>${internas_data[i].Tin_No_tubo}</td>
                                <td>${internas_data[i].Tin_No_placa}</td>
                                <td>${internas_data[i].Tin_ID_proyecto}</td>
                                <td>${internas_data[i].Tin_Lote_alambre}</td>
                                <td>${internas_data[i].Tin_Lote_fundente}</td>
                                <td>${maquina}</td>
                                <td>${internas_data[i].Tin_FolioOperador}</td>
                                <td>${internas_data[i].Tin_Fecha}</td>
                                <td>${internas_data[i].Tin_Hora}</td>
                                <td>${internas_data[i].Tin_Reporte_excel}</td>
                            </tr>`;
                }
           
            document.getElementById('datos_tabla').innerHTML += tabla_a;
            
        }
        interna_data=0;
}


function Cabeceras_soldadura_interna(){
    var ancho_tabla=document.getElementById('area_tabla');
    ancho_tabla.style.maxWidth='1000px';
    document.getElementById('titulo').innerHTML="";
    titulo_tabla=`<b>SOLDADURA EXTERNA</b>`
    document.getElementById('titulo').innerHTML=titulo_tabla;

    document.getElementById('cabeceras').innerHTML="";
    
    cabeceras_tabla=`<tr class="w3-light-grey">
                        <th>ID</th>
                        <th>No. Tubo</th>
                        <th>No. Placa</th>
                        <th>Proyecto</th>
                        <th>Lote Alambre</th>
                        <th>Lote Fundente</th>
                        <th>Maquina</th>
                        <th>Folio Operador</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Reporte Excel</th>
                    </tr>`;
    document.getElementById('cabeceras').innerHTML=cabeceras_tabla;
}

function Agregar_registro_tabla_internas(){
    document.getElementById('formulario_agregar').innerHTML="";
}

function Actualizar_tabla_internas(){
    document.getElementById('busqueda_id').innerHTML="";
    
    busqueda_ID=`<label><b>MAQUINA</b></label>
                    <br>
                    <select  id="maquina">
                        <option selected>SELECCIONE UNO</option>
                        <option>INTERNA1</option>
                        <option>INTERNA2</option> 
                        <option>INTERNA3</option>
                    </select>
                    <br>
                    <label><b>INGRESE ID DE TUBO</b></label>
                    <input id="id_tubo" class="w3-input w3-border w3-margin-bottom" type="text" placeholder="ID" name="A_data_tubo" required>
                    <button onclick="Actualizar_datos_tuberia_in()" type="button" class="w3-button w3-block">Buscar</button>`;
    document.getElementById('busqueda_id').innerHTML=busqueda_ID;
}

function Actualizar_datos_tuberia_in(){
    if((document.getElementById("id_tubo").value!=="INGRESE ID DE TUBO") && (document.getElementById("maquina").value))
    {
        id_tubo = document.getElementById("id_tubo").value;
        a_maquina=document.getElementById("maquina").value;
        let urlf;
        if(a_maquina=="INTERNA1"){
            urlf = "http://10.10.20.15/api/internas/rq_tTuberiaInterna_1.php?tubo="+id_tubo;
        }else if(a_maquina=="INTERNA2"){
            urlf = "http://10.10.20.15/api/internas/rq_tTuberiaInterna_2.php?tubo="+id_tubo;
        }else {
            urlf = "http://10.10.20.15/api/internas/rq_tTuberiaInterna_3.php?tubo="+id_tubo;
        }
        
        fetch(urlf).then(response =>response.json()) 
        .then(data_tuberia =>actualizar(data_tuberia))
        .catch(error=> rutina_error(error))

        const actualizar=(data_tuberia)=>{
            let formulaio_a="";
            document.getElementById('formulario_actualizar').innerHTML=formulaio_a; 
            formulaio_a=
            `<p>INGRESE LOS DATOS DEL TUBO</p>
            <form name="Actualizar" action="/api/rq_tTuberiaExterna.php" method="post" target="R2_iframe">
                <label><b>ID Tubo: ${data_tuberia[0].Tin_ID_tubo} </b></label>
                <input id="d8" class="w3-input w3-border w3-margin-bottom" type="hidden" value =${data_tuberia[0].Tin_ID_tubo} name="A_data_tubo">
                <br>
                <label><b>No. de tubo</b></label>
                <input  id="d9" class="w3-input w3-padding-16 w3-border" type="text" value =${data_tuberia[0].Tin_No_tubo} name="T_no_tubo">
                <label><b>No. de placa</b></label>
                <input  id="d10" class="w3-input w3-padding-16 w3-border" type="number" value =${data_tuberia[0].Tin_No_placa} name="T_no_placa">
                <label><b>ID del proyecto</b></label>
                <input id="d11" class="w3-input w3-padding-16 w3-border" type="number" value =${data_tuberia[0].Tin_ID_proyecto} name="T_ID_proyecto">
                <label><b>Lote del alambre</b></label>
                <input id="d12" class="w3-input w3-padding-16 w3-border" type="text" value =${data_tuberia[0].Tin_Lote_alambre} name="T_lote_alambre">
                <label><b>Lote del fundente</b></label>
                <input id="d13" class="w3-input w3-padding-16 w3-border" type="text" value =${data_tuberia[0].Tin_Lote_fundente} name="T_lote_fundente">
                <label><b>Maquina</b></label>
                <input id="d14" class="w3-input w3-padding-16 w3-border" type="text" value =${data_tuberia[0].Tin_Maquina} name="T_maquina">
                <label><b>Folio operador</b></label>
                <input id="d15" class="w3-input w3-padding-16 w3-border" type="text" value =${data_tuberia[0].Tin_FolioOperador} name="T_foliooperador">
                <label><b>Fecha</b></label>
                <input id="d16" class="w3-input w3-padding-16 w3-border" type="text" value =${data_tuberia[0].Tin_Fecha} name="T_fecha">
                <label><b>Hora</b></label>
                <input id="d17" class="w3-input w3-padding-16 w3-border" type="text" value =${data_tuberia[0].Tin_Hora} name="T_hora">
                <label><b>Observaciones</b></label>
                <input id="d18" class="w3-input w3-padding-16 w3-border" type="text" value =${data_tuberia[0].Tin_Observaciones} name="T_observaciones">
                <p><button class="w3-button" type="submit">ACTUALIZAR</button></p>
            </form>
            <button onclick="limpiar_formulario_tuberia(8,18)" type="button" class="w3-button  w3-bar-item  w3-sand w3-section w3-padding" style="width:47% !important">Limpiar</button>
            <iframe name="R2_iframe" width="100%" height="30" class="w3-container w3-blue"  title="Iframe Example"></iframe>`;
            document.getElementById('formulario_actualizar').innerHTML=formulaio_a;      
        }

        const rutina_error=(error)=>{
            document.getElementById('formulario_actualizar').innerHTML=`<p>ID DE TUBO, CHEQUE EL ID O LA MAQUINA</p>
                                                                        <p>ERROR: ${error}</p>`; 
        }
        data=0;
    }
}

function Eliminar_registro_tabla_interna(){
    document.getElementById('b_borrar_id').innerHTML="";
}


function limpiar_formulario_tuberia(ini,num){
    
    for(var i=ini;i<=num;i++){
        var id_elemento="d"+String(i);

        if(document.getElementById(id_elemento).value != ""){
            document.getElementById(id_elemento).value = "";
           
        }  
    }
    
    document.getElementById('formulario_actualizar').innerHTML="";
}