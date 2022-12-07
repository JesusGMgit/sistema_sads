var numero_de_paginas;
var total_elementos_tabla;
var total_registros_tablas_in=new Array(3);
var total_registros_tablas_ex=new Array(3);
function crear_tabla(section_exin, maquina) {
    //*crear div responsive donde se metera la tabla    
    let id_div_tabla="div_tablas_"+section_exin;
    let div_responsive=document.createElement('div');
    div_responsive.setAttribute("id",id_div_tabla);
    div_responsive.setAttribute("class","w3-responsive w3-padding");
    

    //*crear titulo a la tabla
    let titulo_tabla=`<br>
                      <p class="w3-center"><b>DATOS DE TUBERIA EN MAQUINA ${maquina}</b></p>
                      <br>`;

    //*crear cuepro de la tabla
    let table = document.createElement('table');
    let id_table=section_exin + "_" + maquina;
    table.setAttribute("id",id_table);
    table.setAttribute("class","w3-table-all w3-centered");
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');
    tbody.setAttribute("id",maquina);
    console.log("id_tabla: "+id_table);
    table.appendChild(thead);
    table.appendChild(tbody);
    
    //*crear encabezado de tabla
    let encabezados=["ID tubo","No TUBO","No PLACA","ID PROYECTO","LOTE ALAMBRE","LOTE FUNDENTE","MAQUINA","FECHA","HORA"]
    let fila_encabezados = document.createElement('tr');
    for(crear_i=0;crear_i<9;crear_i++){
        let cabezera = document.createElement('th');
        cabezera.innerHTML = encabezados[crear_i];
        fila_encabezados.appendChild(cabezera);
    }
    thead.appendChild(fila_encabezados);

    //*crear flechas de navegacion por paginas de cada tabla
    let div_paginado=document.createElement('div');
    div_paginado.setAttribute("id","paginado_"+maquina);
    div_paginado.setAttribute("class","w3-bar");
    boton_flecha_primero=`<a onclik="" href="#" class="w-button w3-hover-red">&laquo;</a>`;
    //boton_flecha_ultimo=`<a onclik="" href="#" class="w-button w3-hover-red">&raquo;</a>`;
    div_paginado.innerHTML= boton_flecha_primero;

    //*CARGAR EN PAGINA LOS ELEMENTOS
    div_responsive.innerHTML+=titulo_tabla;
    div_responsive.appendChild(table);
    document.getElementById(section_exin).appendChild(div_responsive);
    document.getElementById(section_exin).appendChild(div_paginado)
}

function paginas_de_tabla(){
    if(elementos_tabla>tamaño_tabla_total){
        no_paginas=total_elementos_tabla/tamaño_tabla_total;
        botones_pagina="";
        boton_pagina="";
        for (p=1;p<=no_paginas;p++)
        {
            boton_pagina=`<a onclick="fecha_busqueda()" href="#" class="w3-button w3-hover-purple">${p}</a>`;
            botones_pagina+=boton_pagina
        }
        botones_pagina+=`<a href="#" class="w3-button w3-hover-orange">»</a>`;
        document.getElementById('paginas_de_la_tabla').innerHTML=botones_pagina;
        numero_de_paginas=no_paginas;
    }
}

function tabla_internas(urlf,maquina_tabla,num_maquina_in){
    //console.log(urlf);
    //console.log(maquina);
    //?crear tabla para alguna maquina externa
    crear_tabla("INTERNAS",maquina_tabla);
    //*id de a tabla creada
    let id_tabla="INTERNAS_"+maquina_tabla;

    //?solicitar datos de la maquina
    fetch(urlf).then(response => response.json())
            .then(data_in => datos1_fetch(data_in))
            .catch(error => console.log(error))
        
        const datos1_fetch=(data_in)=>{
            var tabla_a = "";
            let botones_paginas;
            let registros_mostrados;
            //console.log(data_in);
            console.log("maquina: "+maquina_tabla+" no filas: "+data_in.length);
            //crear botones para paginado
            total_paginas_maquina=data_in.length/20;
            if (total_paginas_maquina>1)
            {
                for(i_pin=1;i_pin<total_paginas_maquina;i_pin++){
                    botones_paginas=`<a onclick="fecha_busqueda()" href="#" class="w3-button w3-hover-purple">${i_pin}</a>`;
                    botones_paginas+=botones_paginas
                }
                botones_paginas+=`<a onclik="" href="#" class="w-button w3-hover-red">&raquo;</a>`;
                document.getElementById("paginado_"+maquina_tabla).innerHTML+=botones_paginas;
                registros_mostrados=21;
            }else{
                botones_paginas+=`<a onclik="" href="#" class="w-button w3-hover-red">&raquo;</a>`;
                document.getElementById("paginado_"+maquina_tabla).innerHTML+=botones_paginas;
                registros_mostrados=data_in,length;
            }


            for(in_i=0;in_i<21;in_i++)
            {
                if (data_in[in_i].Tin_Reporte_excel!=""){
                    id_tubo_insnr=`<td><b>${data_in[in_i].Tin_ID_tubo}</b></td>`;        
                }else{
                    id_tubo_insnr=`<td>${data_in[in_i].Tin_ID_tubo}</td>`;
                }
                tabla_a +=3
                        `<tr class="w3-pale-blue">`
                            + id_tubo_insnr + `
                            <td>${data_in[in_i].Tin_No_tubo}</td>
                            <td>${data_in[in_i].Tin_No_placa}</td>
                            <td>${data_in[in_i].Tin_ID_proyecto}</td>
                            <td>${data_in[in_i].Tin_Lote_alambre}</td>
                            <td>${data_in[in_i].Tin_Lote_fundente}</td>
                            <td>${maquina_tabla}</td>
                            <td>${data_in[in_i].Tin_Fecha}</td>
                            <td>${data_in[in_i].Tin_Hora}</td>
                        </tr>`;
            }
            if(data_in.length<=0)
            {
                tabla_a="no hay datos";
            }
            document.getElementById(id_tabla).innerHTML += tabla_a;
            
        }
        data_in=0;
}

function tabla_externas(urlf,maquina_tabla,num_maquina_ex){
    //console.log(urlf);
    //console.log(maquina);
    //?crear tabla para alguna maquina externa
    crear_tabla("EXTERNAS",maquina_tabla);
    //*id de a tabla creada
    let id_tabla="EXTERNAS_"+maquina_tabla;

    //?solicitar datos de la maquina
    fetch(urlf).then(response => response.json())
            .then(data => datos_fetch(data))
            .catch(error => console.log(error))
        
        const datos_fetch=(data)=>{
            var tabla_a = "";
            console.log("no filas: "+data.length);
            
            for(ex_i=0;ex_i<data.length;ex_i++)
            {
                if (data[ex_i].Tex_Reporte_excel!=""){
                    id_tubo_exsnr=`<td><b>${data[ex_i].Tex_ID_tubo}</b></td>`;        
                }else{
                    id_tubo_exsnr=`<td>${data[ex_i].Tex_ID_tubo}</td>`;
                }
                tabla_a +=
                        `<tr class="w3-pale-blue">`
                            + id_tubo_exsnr + `
                            <td>${data[ex_i].Tex_No_tubo}</td>
                            <td>${data[ex_i].Tex_No_placa}</td>
                            <td>${data[ex_i].Tex_ID_proyecto}</td>
                            <td>${data[ex_i].Tex_Lote_alambre}</td>
                            <td>${data[ex_i].Tex_Lote_fundente}</td>
                            <td>${maquina_tabla}</td>
                            <td>${data[ex_i].Tex_Fecha}</td>
                            <td>${data[ex_i].Tex_Hora}</td>
                        </tr>`;
            }
            if(data.length<=0)
            {
                tabla_a="no hay datos";
            }
            document.getElementById(id_tabla).innerHTML += tabla_a;
            
        }
        data=0;
}


