var busqueda_reporte_externas=0; busqueda_reporte_internas=0;
function descarga(){
    soldadura = document.getElementById("reporte_soldadura").value;
    ID_tubo=document.getElementById("reporte_tubo").value;
    
    //console.log(no_tubo+" : "+soldadura);

    if (soldadura == "INTERNA") {
        for(i=1;i<=3;i++){
            urlf = "http://10.10.20.15/api/internas/rq_tTuberiaInterna_"+i+".php?tubo=" + ID_tubo;
            tabla_internas_1(urlf,("INTERNA"+i));
        }
        //urlf = "http://10.10.20.15/api/rq_tTuberiaInterna.php?tubo=" + ID_tubo;
        //tabla_internas_1(urlf);

    }else if (soldadura=="EXTERNA"){
        for(i=1;i<=3;i++){
            urlf = "http://10.10.20.15/api/externas/rq_tTuberiaExterna_"+i+".php?tubo=" + ID_tubo;
            tabla_externas_1(urlf,("EXTERNA"+i));
        }
        //urlf = "http://10.10.20.15/api/rq_tTuberiaExterna.php?tubo=" + ID_tubo;
        //tabla_externas_1(urlf);
    }else{
        
    }
   
}


function tabla_externas_1(urlf,maquina_1){
    
    fetch(urlf).then(response => response.json())
            .then(data1 => datos1_fetch(data1))
            .catch(error => console.log(error))
        
        const datos1_fetch=(data1)=>{
            nom_reporte=data1[0].Tex_Reporte_excel;
            maquina=maquina_1;
            document.getElementById('link_descarga_reporte').innerHTML="";
            if(nom_reporte!="" && busqueda_reporte_externas==0){
                ruta_reporte ="/Reportes/"+maquina+"/"+nom_reporte;
                var link_reporte=`<a href=${ruta_reporte}>Descargar Reporte : ${nom_reporte} </a>`;
                document.getElementById('link_descarga_reporte').innerHTML=link_reporte;
                busqueda_reporte_externas=1;
            }else{
                document.getElementById('link_descarga_reporte').innerHTML="No hay reporte";
            }

        }
        data1=0;
}
function tabla_internas_1(urlf,maquina_2){
    
    fetch(urlf).then(response => response.json())
            .then(data2 => datos2_fetch(data2))
            .catch(error => console.log(error))
        
        const datos2_fetch=(data2)=>{
            
            nom_reporte=data2[0].Tin_Reporte_excel;
            maquina=maquina_2;
            document.getElementById('link_descarga_reporte').innerHTML="";
            if(nom_reporte!="" && busqueda_reporte_internas==0){
                ruta_reporte ="/Reportes/"+maquina+"/"+nom_reporte;
                var link_reporte=`<a href=${ruta_reporte}>Descargar Reporte : ${nom_reporte} </a>`;
                document.getElementById('link_descarga_reporte').innerHTML=link_reporte;
                busqueda_reporte_internas=1;
            }else{
                document.getElementById('link_descarga_reporte').innerHTML="No hay reporte";
            }

        }
        data2=0;
}