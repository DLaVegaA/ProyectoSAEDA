var boletaReg=/^PE[0-9]{8}$|^[0-9]{10}$|^PP[0-9]{8}$/;
var curpReg=/^[A-Z]{4}[0-9]{6}[A-Z]{6}([A-Z]|[0-9]){1}[0-9]{1}$/;

function ValidarFormularioRPDF(){   
    var bandera=true;
  
    var NoBoleta= document.getElementById('boletaFloating').value;
    var NoBoletaerror= document.getElementById('NoBoletaerror');

    var Curp= document.getElementById('CURPFloating').value;
    var CURPerror= document.getElementById('CURPerror');
    
    if(!boletaReg.test(NoBoleta)){

        NoBoletaerror.innerText='Por favor ingresa un número de boleta valido';
        bandera=false;
    }else{
        NoBoletaerror.innerText='';
    }

    if (!curpReg.test(Curp)) {
        CURPerror.textContent='Por favor ingrese un curp valido';
        bandera=false;
    } else {
        CURPerror.textContent='';
    }

    if (bandera===false) {
       
        return false;
    }

    return true;
}