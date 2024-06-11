var boletaReg=/^PE[0-9]{8}$|^[0-9]{10}$|^PP[0-9]{8}$/;
var patReg=/^([A-Z]|[a-z])+(?:\s[A-Za-z]+)*\s?$/;
var matReg=/^([A-Z]|[a-z])+(?:\s[A-Za-z]+)*\s?$/;
var nomReg=/^([A-Z]|[a-z])+(?:\s[A-Za-z]+)*\s?$/;
var telReg=/^[0-9]{10}$/;
var curpReg=/^[A-Z]{4}[0-9]{6}[A-Z]{6}([A-Z]|[0-9]){1}[0-9]{1}$/;
var corrReg=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;


function redirigirAPestaña() {
    // Activar la pestaña de contacto
    var bandera=true;

    var Nombre= document.getElementById('floatingNombre').value;
    var errorNombre= document.getElementById('errorNombre');
  
    var NoBoleta= document.getElementById('floatingBoleta').value;
    var errorNoBoleta= document.getElementById('errorNoBoleta');
   
    var Paterno= document.getElementById('floatingApPaterno').value;
    var errorPaterno= document.getElementById('errorApPaterno');
 
    var Materno= document.getElementById('floatingApMaterno').value;
    var errorMaterno= document.getElementById('errorApMaterno');

    var Curp= document.getElementById('floatingCURP').value;
    var errorCurp= document.getElementById('errorCurp');
  

    if(!boletaReg.test(NoBoleta)){

        errorNoBoleta.innerText='Por favor ingresa un número de boleta valido';
        bandera=false;
    }else{
        errorNoBoleta.innerText='';
    }
    if (!nomReg.test(Nombre)) {
        errorNombre.textContent='Por favor ingresa un Nombre valido';      
        bandera=false;
    } else {
        errorNombre.textContent='';
    }
    if (!patReg.test(Paterno)) {
        errorPaterno.textContent='Por favor ingresa un Apellido Paterno valido';
        bandera=false;
    }else{
        errorPaterno.textContent='';  
    }
    if (!matReg.test(Materno)) {
        errorMaterno.textContent='Por favor ingresa un Apellido Materno valido';
        bandera=false;
    } else {
        errorMaterno.textContent='';
    }
    if (!curpReg.test(Curp)) {
        errorCurp.textContent='Por favor ingrese un curp valido';
        bandera=false;
    } else {
        errorCurp.textContent='';
    }

   

    if (bandera===true) {
        var myTab = new bootstrap.Tab(document.querySelector('#pestañaContacto'));
        myTab.show();
        document.body.scrollIntoView({
        behavior: 'smooth' 
    })
    }else{
        bandera= false;
        
    }
    return bandera;
}

function redirigirAPestaña2() {
    // Activar la pestaña de contacto
    var bandera=true;
    var Telefono= document.getElementById('floatingTel').value;
    var errorTelefono= document.getElementById('errorTelefono');
    var Correo=document.getElementById('floatingCorreo').value;
    var errorCorreo= document.getElementById('errorCorreo');

    if (!telReg.test(Telefono)) {
        errorTelefono.textContent='Por favor ingresa un número de telefono valido';
        bandera=false;
    } else {
        errorTelefono.textContent='';
    }
    if (!corrReg.test(Correo)) {
        errorCorreo.textContent='Por favor ingrese un correo electronico valido';
        bandera=false;
    
    } else {
        errorCorreo.textContent='';
    }

    if (bandera === true) {
       var myTab = new bootstrap.Tab(document.querySelector('#pestañaProcedencia'));
       myTab.show();
       document.body.scrollIntoView({
        behavior: 'smooth' 
    })  
    } else {
        bandera= false;
    }

   return bandera;
}

/* function regresarIndex()
{
    window.onload = function() 
    {
        window.location.href = "./index.html";
    };
} */

function ValidarFormulario(){   
    var bandera=true;
    /* alert("Antes de validaar boleta"); */
    var Nombre= document.getElementById('floatingNombre').value;
    var errorNombre= document.getElementById('errorNombre');
  
    var NoBoleta= document.getElementById('floatingBoleta').value;
    var errorNoBoleta= document.getElementById('errorNoBoleta');
   
    var Paterno= document.getElementById('floatingApPaterno').value;
    var errorPaterno= document.getElementById('errorApPaterno');
 
    var Materno= document.getElementById('floatingApMaterno').value;
    var errorMaterno= document.getElementById('errorApMaterno');

    var Telefono= document.getElementById('floatingTel').value;
    var errorTelefono= document.getElementById('errorTelefono');

    var Curp= document.getElementById('floatingCURP').value;
    var errorCurp= document.getElementById('errorCurp');

    var Correo=document.getElementById('floatingCorreo').value;
    var errorCorreo= document.getElementById('errorCorreo');

    //var errorModal=document.getElementById('errorModal');
    
    if(!boletaReg.test(NoBoleta)){

        errorNoBoleta.innerText='Por favor ingresa un número de boleta valido';
        bandera=false;
    }else{
        errorNoBoleta.innerText='';
    }
    
     //alert("despues de validaar boleta");
    //alert("Antes de validaar nombre"); 
    
    if (!nomReg.test(Nombre)) {
        errorNombre.textContent='Por favor ingresa un Nombre valido';      
        bandera=false;
    } else {
        errorNombre.textContent='';
    }

    //alert("despues de validaar nombre"); 
    //alert("antes de validaar pat"); 

    if (!patReg.test(Paterno)) {
        errorPaterno.textContent='Por favor ingresa un Apellido Paterno valido';
        bandera=false;
    }else{
        errorPaterno.textContent='';  
    }

    //alert("despues de validaar pat");
    //alert("antes de validaar mat");
    
    if (!matReg.test(Materno)) {
        errorMaterno.textContent='Por favor ingresa un Apellido Materno valido';
        bandera=false;
    } else {
        errorMaterno.textContent='';
    }

    //alert("despues de validaar mat");
    //alert("antes de validaar tel");

    if (!telReg.test(Telefono)) {
        errorTelefono.textContent='Por favor ingresa un número de telefono valido';
        bandera=false;
    } else {
        errorTelefono.textContent='';
    }

    //alert("despues de validaar tel");
    //alert("antes de validaar curp");

    if (!curpReg.test(Curp)) {
        errorCurp.textContent='Por favor ingrese un curp valido';
        bandera=false;
    } else {
        errorCurp.textContent='';
    }
    if (!corrReg.test(Correo)) {
        errorCorreo.textContent='Por favor ingrese un correo electronico valido';
        bandera=false;
    
    } else {
        errorCorreo.textContent='';
    }

   // alert("despues de validaar curp");

    if (bandera===false) {
       //alert("entre al if de bandera");
       
        return false;
    }

    /* document.getElementById('RegistroAlumnos').reset(); */

    //alert("estoy en el return true");
    return true;
}