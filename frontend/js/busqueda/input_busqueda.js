function fecha_busqueda(){
    fecha=document.getElementById('fecha').value;
    //console.log(fecha+ " ");
    document.getElementById('INTERNAS').innerHTML = "";
    document.getElementById('EXTERNAS').innerHTML = "";
    for(i=1;i<=3;i++){
        urlf = direccion_pagina + "/api/externas/rq_tTuberiaExterna_"+i+".php?fecha="+fecha;
        tabla_externas_fnt(urlf,("EXTERNA"+i));
        urlf = direccion_pagina + "/api/internas/rq_tTuberiaInterna_"+i+".php?fecha="+fecha;
        tabla_internas_fnt(urlf,("INTERNA"+i));
    }
    
    
}

function no_tubo_busqueda(){
    tubo=document.getElementById('no_tubo').value;
    document.getElementById('INTERNAS').innerHTML = "";
    document.getElementById('EXTERNAS').innerHTML = "";
    console.log(tubo);
    for(i=1;i<=3;i++){
        urlf = direccion_pagina + "/api/externas/rq_tTuberiaExterna_"+i+".php?tubo="+tubo;
        tabla_externas_fnt(urlf,("EXTERNA"+i));
        urlf = direccion_pagina + "/api/internas/rq_tTuberiaInterna_"+i+".php?tubo="+tubo;
        tabla_internas_fnt(urlf,("INTERNA"+i));
    }
    
}

function tabla_externas_fnt(urlf,maquina_fnt){
    //console.log("aqui externa.")
    fetch(urlf).then(response => response.json())
            .then(data1 => datos_fetch(data1))
            .catch(error => console.log(error))
        
        const datos_fetch=(data1)=>{
            console.log(urlf);
            console.log(maquina);
            var tabla_a = "";
            for(i=0;i<data1.length;i++)
                {
                    if (data1[i].Tex_Reporte_excel!=""){
                        id_tubo_exsnr=`<td><b>${data1[i].Tex_ID_tubo}</b></td>`;        
                    }else{
                        id_tubo_exsnr=`<td>${data1[i].Tex_ID_tubo}</td>`;
                    }
                    tabla_a +=
                            `<tr class="w3-pale-blue">`
                                + id_tubo_exsnr + `
                                <td>${data1[i].Tex_No_tubo}</td>
                                <td>${data1[i].Tex_No_placa}</td>
                                <td>${data1[i].Tex_ID_proyecto}</td>
                                <td>${data1[i].Tex_Lote_alambre}</td>
                                <td>${data1[i].Tex_Lote_fundente}</td>
                                <td>${maquina_fnt}</td>
                                <td>${data1[i].Tex_Fecha}</td>
                                <td>${data1[i].Tex_Hora}</td>
                            </tr>`;
                }
            
            document.getElementById('datos_tabla1').innerHTML += tabla_a;
            
        }
        data=0;
}

function tabla_internas_fnt(urlf,maquina_fnt){
    //console.log("aqui interna.")
    fetch(urlf).then(response => response.json())
            .then(data_in => datos1_fetch(data_in))
            .catch(error => console.log(error))
        
        const datos1_fetch=(data_in)=>{
            var tabla_a = "";
            console.log(urlf);
            console.log(maquina);
            for(i=0;i<data_in.length;i++)
                {
                    
                    //console.log("excel: "+data_in[i].Tin_Archivo_Fexcel);
                    if (data_in[i].Tin_Reporte_excel!=""){
                        id_tubo_insnr=`<td><b>${data_in[i].Tin_ID_tubo}</b></td>`;        
                    }else{
                        id_tubo_insnr=`<td>${data_in[i].Tin_ID_tubo}</td>`;
                    }
                    tabla_a +=
                        `<tr class="w3-pale-blue">`
                            + id_tubo_insnr + `
                            <td>${data_in[i].Tin_No_tubo}</td>
                            <td>${data_in[i].Tin_No_placa}</td>
                            <td>${data_in[i].Tin_ID_proyecto}</td>
                            <td>${data_in[i].Tin_Lote_alambre}</td>
                            <td>${data_in[i].Tin_Lote_fundente}</td>
                            <td>${maquina_fnt}</td>
                            <td>${data_in[i].Tin_Fecha}</td>
                            <td>${data_in[i].Tin_Hora}</td>
                        </tr>`;
                }
            
            document.getElementById('datos_tabla2').innerHTML += tabla_a;
            
        }
        data_in=0;
}

function reiniciar_combos(){
    combo_soldadura=``;
    
}