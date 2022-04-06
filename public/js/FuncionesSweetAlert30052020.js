// Eliminar Usuarios
function EliminarUser(id)
{
  Swal.fire({
  title: "Eliminar Registro",
  text: "¿ Desea borrar el Usuario ?",
  type: 'warning',
  showCancelButton: true,
  allowOutsideClick: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, borrar'
    }).then((result) => {
       
        if (result.value) {
      
        $.get('/api/eliminar/'+id+'/User/',function(retorno){
         
           
                Swal.fire({
                title: 'Usuario Borrado',
                text: 'Pueden Continuar...',
                type: 'success',
                confirmButtonText: 'Ok',
                showConfirmButton: false,
                timer: 1500,
              })
           
            
              // Swal.fire({
              //   title: 'Usuario Tiene datos Vinculado',
              //   text: 'Pueden Continuar...',
              //   type: 'error',
              //   confirmButtonText: 'Ok',
              //   showConfirmButton: false,
              //   timer: 1500,
              // })
             
            setTimeout ("location.reload();", 1500); 
               
        });
       
        } 
       
    })
}
// fin eliminar usuarios

//eliminar roles 
function EliminarRole(id)
{
  Swal.fire({
  title: "Eliminar Rol",
  text: "¿ Desea Borrar el Rol y su Perfil ?",
  type: 'warning',
  showCancelButton: true,
  allowOutsideClick: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, borrar'
    }).then((result) => {
       
        if (result.value) {
        //         Swal.fire(
        //         'Deleted!',
        //         'Your file has been deleted.',
        //         'success'
        //         )
           
        //         // location.reload();
        // }
        $.get('/api/eliminar/'+id+'/Role/',function(retorno){
            
            Swal.fire({
            title: 'Rol Borrado',
            text: 'Puede Continuar...',
            type: 'success',
            confirmButtonText: 'Ok',
            showConfirmButton: false,
            timer: 1500,
            
})
                 setTimeout ("location.reload();", 1500); 
               
        });
       
        } 
       
    })
}

//fin eliminar roles

// actualizar Proyecto
function ActualizarProyecto(activo){
  var activo2=$('#'+activo).val();
  alert(activo2);
}
//fin actualizar proyecto


// Eliminar Proyecto
function EliminarProyecto(id)
{
  Swal.fire({
  title: "Eliminar Proyecto",
  text: "¿ Desea Eliminar el Proyecto y todos sus Contratistas ?",
  type: 'warning',
  showCancelButton: true,
  allowOutsideClick: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, borrar'
    }).then((result) => {
       
        if (result.value) {
        
        $.get('/api/eliminar/'+id+'/Proyecto/',function(retorno){
            
            Swal.fire({
            title: 'Proyecto Borrado',
            text: 'Pueden Continuar...',
            type: 'success',
            confirmButtonText: 'Ok',
            showConfirmButton: false,
            timer: 1500,
            
})
                 setTimeout ("location.reload();", 1500); 
               
        });
       
        } 
       
    })
}
// fin eliminar proyecto

// Eliminar usuario administrador de contratista
function EliminarUsuConForm(id)
{
  Swal.fire({
  title: "Eliminar Usuario Administrador",
  text: "¿ Desea Eliminar al Usuario que administra las Solicitudes del Contratista ?",
  type: 'warning',
  showCancelButton: true,
  allowOutsideClick: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, borrar'
    }).then((result) => {
       
        if (result.value) {
        
        $.get('/api/eliminar/'+id+'/UsuContForm/',function(retorno){
            
            Swal.fire({
            title: 'Usuario Administrador Borrado',
            text: 'Pueden Continuar...',
            type: 'success',
            confirmButtonText: 'Ok',
            showConfirmButton: false,
            timer: 1500,
            
})
                 setTimeout ("location.reload();", 1500); 
               
        });
       
        } 
       
    })
}

function AprobarSolicitud(id)
{
  $.get('/api/aprobar/'+id+'/certificado/',function(retorno)
  {
    Swal.fire({
      title: 'Certificado Aprobado',
      text: 'Pueden Continuar...',
      type: 'success',
      confirmButtonText: 'Ok',
      showConfirmButton: false,
      timer: 1500,
      
    })
    setTimeout ("location.reload();", 1500); 
  })
}

function RechazarSolicitud(id)
{
  $.get('/api/rechazar/'+id+'/certificado/',function(retorno)
  {
    Swal.fire({
      title: 'Solicitud Rechazada, Devuelta al Inspector',
      text: 'Pueden Continuar...',
      type: 'success',
      confirmButtonText: 'Ok',
      showConfirmButton: false,
      timer: 1500,
      
    })
    setTimeout ("location.reload();", 1500); 
  })
}
// fin eliminar usuario administrador de contratista

