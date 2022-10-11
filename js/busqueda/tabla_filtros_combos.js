function tabla_externas(urlf,maquina_tabla){
    //console.log(urlf);
    //console.log(maquina);
    fetch(urlf).then(response => response.json())
            .then(data => datos_fetch(data))
            .catch(error => console.log(error))
        
        const datos_fetch=(data)=>{
            var tabla_a = "";
            //console.log(data);
            for(i=0;i<data.length;i++)
                {
                    if (data[i].Tex_Reporte_excel!=""){
                        id_tubo_exsnr=`<td><b>${data[i].Tex_ID_tubo}</b></td>`;        
                    }else{
                        id_tubo_exsnr=`<td>${data[i].Tex_ID_tubo}</td>`;
                    }
                    tabla_a +=
                            `<tr class="w3-pale-blue">`
                                + id_tubo_exsnr + `
                                <td>${data[i].Tex_No_tubo}</td>
                                <td>${data[i].Tex_No_placa}</td>
                                <td>${data[i].Tex_ID_proyecto}</td>
                                <td>${data[i].Tex_Lote_alambre}</td>
                                <td>${data[i].Tex_Lote_fundente}</td>
                                <td>${maquina_tabla}</td>
                                <td>${data[i].Tex_Fecha}</td>
                                <td>${data[i].Tex_Hora}</td>
                            </tr>`;
                }
            document.getElementById('datos_tabla1').innerHTML += tabla_a;
            
        }
        data=0;
}
function tabla_internas(urlf,maquina_tabla){
    //console.log(urlf);
    //console.log(maquina);
    fetch(urlf).then(response => response.json())
            .then(data_in => datos1_fetch(data_in))
            .catch(error => console.log(error))
        
        const datos1_fetch=(data_in)=>{
            var tabla_a = "";
            //console.log(data_in);
            for(i=0;i<data_in.length;i++)
                {
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
                                <td>${maquina_tabla}</td>
                                <td>${data_in[i].Tin_Fecha}</td>
                                <td>${data_in[i].Tin_Hora}</td>
                            </tr>`;
                }
            
            document.getElementById('datos_tabla2').innerHTML += tabla_a;
            
        }
        data_in=0;
}