//Inicio de Sesion

const login = () => {
    $("#loginForm").click(()=>
    {
      //trim elimina espacios en blanco
      let auth= $.trim($("#email").val()); //obtiene el valor del input 
      let key = $.trim($("#password").val()); //obtiene el valor del input
      const accion = "AUTH";

   if (auth.length==""|| key == ""){
   swal({
     title: "¡Atención!",
     text: `No se permiten campos vacíos`,
     icon: "warning",
     button: false,
     closeOnClickOutside: false,
     timer: 2000,
   });
   }
   else
   {
       $.ajax({
           url:"auth/controller/rutas.php",
           type: "POST",
           datatype: "json",
           data: {
            auth:auth,
            key:key,
            accion:accion
            },
           beforeSend: function () {
            $("#loginForm").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').css('background-color','#707370').off('click');
           },
           success:function(data)
           {
            console.log(data)
            //convertir el JSON a un objeto de JS
            let obj = JSON.parse(data);

               if (obj.found == false) {
                   swal({
                       icon:"error",
                       title: "¡Atención!",
                       icon: "error",
                       text: "El Correo/Matrícula no existen, Verifica que los datos estén escritos correctamente",
                       timer: 2000
                   });
                   $("#loginForm").html('<i class="fa fa-times"></i>').css('background-color','#dc4c64')

                   setTimeout(() =>{
                    $("#loginForm").html('Inciar Sesión <i class="fa fa-arrow-right"></i>').css('background-color','#004f77');
                     //inicio de nuevo la funcion por que retorne a su estado original
                   }, 2000)
                   return login();
               }
               else
               {
                switch (obj.status) {
                    case true:
                        $("#loginForm").html('<i class="fa fa-check"></i>').css('background-color','#18A558').off('click');
                        
                        setTimeout(() => {
                            window.location.href = `${obj.url}/index.php`;
                        }, 2000);
                        
    
                       
                        //encriptar el string con AES256
                        //user es el string encriptado
                        let token = CryptoJS.AES.encrypt(JSON.stringify(obj), obj.key);
                        localStorage.setItem('ADE_Unlock_Key', obj.key);

                        //guardar el objeto en localStorage
                        localStorage.setItem("ADE_TOKEN_UID", token);  
                         
                         
                        
                        break;

                    case false:
                        $("#loginForm").html('Inciar Sesión <i class="fa fa-arrow-right"></i>').css('background-color','#004f77').on('click');
                        swal({
                        title: "¡Acceso Denegado!",
                        icon: "error",
                        text: `${obj.msg}`,
                        button: false,
                        closeOnClickOutside: false,
                        timer: 3000
                        })
                        
                    break;
                
                    default:
                        break;
                }
                     
                      
               }
           },
              error:function(error)
                {
                    console.log(error);
                }
       });
   }

});

}

  


   