$(document).ready(function(){
    $(function(){
        $('#busquedaProyectoxEmpresa_id').on('change', cambioSeleccionEmpresa);
        $('#proyecto_id').on('change', Cambio_proyecto);
        $('#contratista_id').on('change',Cambio_contratista);
        $('#busquedaDocumentosXmandante').on('change',documentosXmandante);
        $('#busquedaDocumentosXholding').on('change',documentosXholding);
        $('#busquedaDocumentosXcadena').on('click',busquedaDocumentosXcadena);

    });

    function EnviarCertificadoRevision(){
        //var mutli_education = document.form_name.elements["rut[]"];
        var mutli_education = document.getElementsByid['rut'];
        alert(mutli_education);
    }





    function cambioSeleccionEmpresa(){
        
        var empresa_id = $(this).val();
    
        $.get('/api/Listaproyectos/'+empresa_id+'/empresa', function(info){
            
            if (info.length>0){
             
            $("#tb-proyectoXempresa tr").empty(); 
            document.getElementById("tb-proyectoXempresa").insertRow(-1).innerHTML = '<td><strong>Id</strong></td><td><strong>Proyecto</strong></td><td><strong>Editar</strong></td>'
            for (i=0;i<=info.length-1;i++)
            {
                document.getElementById("tb-proyectoXempresa").insertRow(-1).innerHTML = '<td>'+info[i].id+'</td><td>'+info[i].proyecto+'</td><td>'+'<a href="proyectos/'+info[i].id+'/edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>'
            }
        }
            
       

        });
    }


    $('#firmarCertificado').click(function(){
        //alert('presionado')
        document.getElementById('textareaRechazo').value="OK";
    });
    $('#verCertificadoR').click(function(){
        //alert('presionado')
        document.getElementById('textareaRechazo').value=" ";
    });
    
    function documentosXmandante(){
        var empresa_id = $(this).val();
        $.get('/api/documento/'+empresa_id+'/mandante',function(resultado){
            //var docs =  new Array(); 
        if (resultado!=1){
             var $fila='';
             for (i=0;i<=resultado.length-1;i++)
             {
             $fila+="<tr><th>"+resultado[i][0]+"</th><th><a href='"+resultado[i][8]+resultado[i][1]+"' target='_blank'>"+resultado[i][1]+"</a></th><th>"+resultado[i][2] +"</th><th>"+resultado[i][9] +"</th><th>"+resultado[i][3]+"</th><th>"+resultado[i][4] +"</th><th>"+resultado[i][10] +"</th><th>"+resultado[i][5] +"</th><th>"+resultado[i][6]+"</th><th><center><a href='/editar/"+resultado[i][7]+"/documentos' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></a></center></th><th><center><a class='btn btn-sm btn-danger' href='javascript:EliminarDocumento("+resultado[i][7]+");'><i class='fa fa-trash'></i></a></center></th><th><input type='hidden' name='documentos[]' value='"+resultado[i][1]+"'></th></tr>";
             //docs.push(resultado[i][1]);
            }
            // document.getElementById('documentos').value=docs;
             var table = $('#DatatableZip').DataTable();
             table.destroy();
         
             $("#DatatableZip tbody").html($fila);
             $("#DatatableZip").DataTable({
                 language:{search:"Buscar"},
                 "pageLength": 100,
                 paging: true,
                 searching: true,
                 dom: 'Bfrtip',
                 buttons: [
                     'copyHtml5',
                     'excelHtml5',
                     'csvHtml5',
                     'pdfHtml5'
                 ]
             });
        }else{
            alert("No existen Documentos para Descargar");
        }
          
        });
    }

    // documentos por holding
    function documentosXholding(){
        
        var holding = $(this).val();
        $.get('/api/documento/'+holding+'/holding',function(resultado){
           
        if (resultado!=1){
             var $fila='';
             for (i=0;i<=resultado.length-1;i++)
             {
             $fila+="<tr><th>"+resultado[i][0]+"</th><th><a href='"+resultado[i][8]+resultado[i][1]+"' target='_blank'>"+resultado[i][1]+"</a></th><th>"+resultado[i][2] +"</th><th>"+resultado[i][9] +"</th><th>"+resultado[i][3]+"</th><th>"+resultado[i][4] +"</th><th>"+resultado[i][10] +"</th><th>"+resultado[i][5] +"</th><th>"+resultado[i][6]+"</th><th><center><a href='/editar/"+resultado[i][7]+"/documentos' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></a></center></th><th><center><a class='btn btn-sm btn-danger' href='javascript:EliminarDocumento("+resultado[i][7]+");'><i class='fa fa-trash'></i></a></center></th><th><input type='hidden' name='documentos[]' value='"+resultado[i][1]+"'></th></tr>";
             //docs.push(resultado[i][1]);
            }
            // document.getElementById('documentos').value=docs;
             var table = $('#DatatableZip').DataTable();
             table.destroy();
         
             $("#DatatableZip tbody").html($fila);
             $("#DatatableZip").DataTable({
                 language:{search:"Buscar"},
                 "pageLength": 100,
                 paging: true,
                 searching: true,
                 dom: 'Bfrtip',
                 buttons: [
                     'copyHtml5',
                     'excelHtml5',
                     'csvHtml5',
                     'pdfHtml5'
                 ]
             });
        }else{
            alert("No existen Documentos por Holding");
        }
          
        });
    }

    function busquedaDocumentosXcadena(){
        var empresa_id = $('#empresa_id').val();
        var proyecto_id = $('#proyecto_id').val();
        var contratista_id = $('#contratista_id').val();

        
        if (proyecto_id==''){
            proyecto_id=0;
        }
        if (contratista_id==''){
            contratista_id=0;
        }
        // alert(empresa_id)
        // alert(proyecto_id)
        // alert(contratista_id)
        document.getElementById("textResultado").innerHTML = "Buscando Documentación";
      
        $.get('/api/documento/'+contratista_id+'/Xcontratatista/'+empresa_id+'/'+proyecto_id+'/boton/',function(resultado){

            
            if (resultado!=1){
                var $fila='';
                for (i=0;i<=resultado.length-1;i++)
                {
                $fila+="<tr><th>"+resultado[i][0]+"</th><th><a href='"+resultado[i][8]+resultado[i][1]+"' target='_blank'>"+resultado[i][1]+"</a></th><th>"+"http://clientes.serreschile.cl/"+resultado[i][8]+resultado[i][1]+"</th><th>"+resultado[i][2] +"</th><th>"+resultado[i][9] +"</th><th>"+resultado[i][3]+"</th><th>"+resultado[i][4] +"</th><th>"+resultado[i][10] +"</th><th>"+resultado[i][5] +"</th><th>"+resultado[i][6]+"</th><th><center><a href='/editar/"+resultado[i][7]+"/documentos' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></a></center></th><th><center><a class='btn btn-sm btn-danger' href='javascript:EliminarDocumento("+resultado[i][7]+");'><i class='fa fa-trash'></i></a></center></th><th><input type='hidden' name='documentos[]' value='"+resultado[i][1]+"'></th></tr>";
                //docs.push(resultado[i][1]);
               }
               // document.getElementById('documentos').value=docs;
               document.getElementById("textResultado").innerHTML = "Busqueda Finalizada";
                var table = $('#DatatableZip').DataTable();
                table.destroy();
            
                $("#DatatableZip tbody").html($fila);
                $("#DatatableZip").DataTable({
                    language:{search:"Buscar"},
                    "pageLength": 100,
                    paging: true,
                    searching: true,
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ]
                });
           }else{
               alert("No existen Documentos por Holding");
           }
        });
    }

});