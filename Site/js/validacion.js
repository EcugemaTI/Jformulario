    window.addEvent('domready', function() {
	    function check_cedula( p_cedula ){




      numero = p_cedula;

//	  alert(numero);



      var suma = 0;

      var residuo = 0;

      var pri = false;

      var pub = false;

      var nat = false;

      var numeroProvincias = 22;

      var modulo = 11;



      /* Verifico que el campo no contenga letras */

      var ok=1;

      for (i=0; i<numero.length && ok==1 ; i++){

         var n = parseInt(numero.charAt(i));

         if (isNaN(n)) ok=0;

      }

      if (ok==0){

         //alert("No puede ingresar caracteres en el número");

         return false;

      }



      if (numero.length < 10 ){

         //alert('El número ingresado no es válido');

         return false;

      }



      /* Los primeros dos digitos corresponden al codigo de la provincia */

      provincia = numero.substr(0,2);

      if (provincia < 1 || provincia > numeroProvincias){

//         alert('El código de la provincia (dos primeros dígitos) es inválido');

		 return false;

      }



      /* Aqui almacenamos los digitos de la cedula en variables. */

      d1  = numero.substr(0,1);

      d2  = numero.substr(1,1);

      d3  = numero.substr(2,1);

      d4  = numero.substr(3,1);

      d5  = numero.substr(4,1);

      d6  = numero.substr(5,1);

      d7  = numero.substr(6,1);

      d8  = numero.substr(7,1);

      d9  = numero.substr(8,1);

      d10 = numero.substr(9,1);



      /* El tercer digito es: */

      /* 9 para sociedades privadas y extranjeros   */

      /* 6 para sociedades publicas */

      /* menor que 6 (0,1,2,3,4,5) para personas naturales */



      if (d3==7 || d3==8){

  //       alert('El tercer dígito ingresado es inválido');

         return false;

      }



      /* Solo para personas naturales (modulo 10) */

      if (d3 < 6){

         nat = true;

         p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;

         p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;

         p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;

         p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;

         p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;

         p6 = d6 * 1;  if (p6 >= 10) p6 -= 9;

         p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;

         p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;

         p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;

         modulo = 10;

      }



      /* Solo para sociedades publicas (modulo 11) */

      /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */

      else if(d3 == 6){

         pub = true;

         p1 = d1 * 3;

         p2 = d2 * 2;

         p3 = d3 * 7;

         p4 = d4 * 6;

         p5 = d5 * 5;

         p6 = d6 * 4;

         p7 = d7 * 3;

         p8 = d8 * 2;

         p9 = 0;

      }



      /* Solo para entidades privadas (modulo 11) */

      else if(d3 == 9) {

         pri = true;

         p1 = d1 * 4;

         p2 = d2 * 3;

         p3 = d3 * 2;

         p4 = d4 * 7;

         p5 = d5 * 6;

         p6 = d6 * 5;

         p7 = d7 * 4;

         p8 = d8 * 3;

         p9 = d9 * 2;

      }



      suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;

      residuo = suma % modulo;



      /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/

      digitoVerificador = residuo==0 ? 0: modulo - residuo;



      /* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/

      if (pub==true){

         if (digitoVerificador != d9){

    //        alert('El ruc de la empresa del sector público es incorrecto.');

            return false;

         }

         /* El ruc de las empresas del sector publico terminan con 0001*/

         if ( numero.substr(9,4) != '0001' ){

      //      alert('El ruc de la empresa del sector público debe terminar con 0001');

            return false;

         }

      }

      else if(pri == true){

         if (digitoVerificador != d10){

        //    alert('El ruc de la empresa del sector privado es incorrecto.');

            return false;

         }

         if ( numero.substr(10,3) != '001' ){

          //  alert('El ruc de la empresa del sector privado debe terminar con 001');

            return false;

         }

      }



      else if(nat == true){
//	alert(digitoVerificador);
//	alert(d10);
         if (digitoVerificador != d10){

           // alert('El número de cédula de la persona natural es incorrecto.');

            return false;

         }

         if (numero.length >10 && numero.substr(10,3) != '001' ){

  //          alert('El ruc de la persona natural debe terminar con 001');

            return false;

         }

      }

      return true;

   };

											document.formvalidator.setHandler('cedula', function(value) {

												  regex=/^([0-9]{10})$/;
												
												document.getElementById("btnGrabar").disabled=false;
												if(value.length==0){
													$('errcedula').innerHTML='Cédula es obligatoria.';
													return false;
												}
												if(!check_cedula(value)){
													$('errcedula').innerHTML='No es una cédula válida.';
													return false;
												}
												if(regex.test(value)==0 ){
													$('errcedula').innerHTML='error en el código verificador.No letras ni espacios.';

													return false;
												}
												else
												{
												$('errcedula').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('apellidopaterno', function(value) {

												  regex=/^[a-zA-Z0-9_]{1,30}$/;
												
												if(value.length==0){
													$('errapellidopaterno').innerHTML='Apellido paterno es obligatorio.';

													return false;												
												}
												if(regex.test(value)==0 ){
													$('errapellidopaterno').innerHTML='Apellido paterno es obligatorio.';

													return false;
												}
												else
												{
												$('errapellidopaterno').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('apellidomaterno', function(value) {

												  regex=/^[a-zA-Z0-9_]{1,30}$/;

												if(regex.test(value)==0 ){
													$('errapellidomaterno').innerHTML='debe ser mayor a 2 letras y menor a 30.';

													return false;
												}
												else
												{
												$('errapellidomaterno').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('nombres', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errnombres').innerHTML='debe ser mayor a 2 letras y menor a 30.';

													return false;
												}
												else
												{
												$('errnombres').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('fechadenacimiento', function(value) {

												  regex=/^([1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-1])[- / .]([1-9]|0[1-9]|1[0-2])[- / .](1[9][0-9][0-9]|2[0][0-9][0-9])$/;

												if(regex.test(value)==0 ){
													$('errfechadenacimiento').innerHTML='debe ingresar la fecha en formato dia/mes/año';

													return false;
												}
												else
												{
												$('errfechadenacimiento').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('nacionalidad', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errnacionalidad').innerHTML='debe ser mayor a 2 letras y menor a 30.';

													return false;
												}
												else
												{
												$('errnacionalidad').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('ciudad', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errciudad').innerHTML='debe ser mayor a 2 letras y menor a 30.';

													return false;
												}
												else
												{
												$('errciudad').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('domicilioactual', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,90}$/;

												if(regex.test(value)==0 ){
													$('errdomicilioactual').innerHTML='no puede ser mayor a 90 letras';

													return false;
												}
												else
												{
												$('errdomicilioactual').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('telefonofijo', function(value) {

												  regex=/^[0-9_]{9}$/;

												if(regex.test(value)==0 ){
													$('errtelefonofijo').innerHTML='debe ser numérico y debe ser de 9 dígitos';

													return false;
												}
												else
												{
												$('errtelefonofijo').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('telefonocelular', function(value) {

												  regex=/^[0-9_]{10}$/;

												if(regex.test(value)==0 ){
													$('errtelefonocelular').innerHTML='debe ser numérico y debe ser de 9 dígitos';

													return false;
												}
												else
												{
												$('errtelefonocelular').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('apellidomaternoconyuge', function(value) {

												  regex=/^[a-zA-Z0-9_]{0,30}$/;

												if(regex.test(value)==0 ){
													$('errapellidomaternoconyuge').innerHTML='debe tener 30 caracteres o menos.';

													return false;
												}
												else
												{
												$('errapellidomaternoconyuge').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('nombresconyuge', function(value) {

												  regex=/^[a-zA-Z0-9_]{0,30}$/;

												if(regex.test(value)==0 ){
													$('errnombresconyuge').innerHTML='debe tener 30 caracteres o menos.';

													return false;
												}
												else
												{
												$('errnombresconyuge').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('cedulaconyuge', function(value) {

												  regex=/^[a-zA-Z0-9_]{0,30}$/;

												if(regex.test(value)==0 ){
													$('errcedulaconyuge').innerHTML='es obligatorio y el número de caracteres debe ser menor a 30.';

													return false;
												}
												else
												{
												$('errcedulaconyuge').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('nombreempresaactual', function(value) {

												  regex=/^[a-zA-Z0-9_]{0,30}$/;

												if(regex.test(value)==0 ){
													$('errnombreempresaactual').innerHTML='es obligatorio y el número de caracteres debe ser menor a 30.';

													return false;
												}
												else
												{
												$('errnombreempresaactual').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('actividadempresa', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('erractividadempresa').innerHTML='número de caracteres debe ser mayor a 2 y menor a 30.';

													return false;
												}
												else
												{
												$('erractividadempresa').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('cargo', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errcargo').innerHTML='número de caracteres debe ser mayor a 2 y menor a 30.';

													return false;
												}
												else
												{
												$('errcargo').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('empciudad', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errempciudad').innerHTML='es obligatorio y el número de caracteres debe ser menor a 30.';

													return false;
												}
												else
												{
												$('errempciudad').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('emptelefonofijo', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('erremptelefonofijo').innerHTML='es obligatorio y el número de caracteres debe ser menor a 30.';

													return false;
												}
												else
												{
												$('erremptelefonofijo').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('empdireccion', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,150}$/;

												if(regex.test(value)==0 ){
													$('errempdireccion').innerHTML='es obligatorio y el número de caracteres debe ser menor a 150.';

													return false;
												}
												else
												{
												$('errempdireccion').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('empprofesion', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errempprofesion').innerHTML='es obligatorio y el número de caracteres debe ser menor a 30.';

													return false;
												}
												else
												{
												$('errempprofesion').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('empresaanterior', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,80}$/;

												if(regex.test(value)==0 ){
													$('errempresaanterior').innerHTML='debe tener 80 caracteres o menos.';

													return false;
												}
												else
												{
												$('errempresaanterior').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('empanttiempotrabajo', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errempanttiempotrabajo').innerHTML='debe ser mayor a 2 letras y menor a 30.';

													return false;
												}
												else
												{
												$('errempanttiempotrabajo').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('empanttelefonofijo', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,9}$/;

												if(regex.test(value)==0 ){
													$('errempanttelefonofijo').innerHTML='teléfono debe tener 9 digitos';

													return false;
												}
												else
												{
												$('errempanttelefonofijo').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('banco', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errbanco').innerHTML='no puede ser mayor a 30 caracteres.';

													return false;
												}
												else
												{
												$('errbanco').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('sueldomensual', function(value) {

												  regex=/^[0-9._]{0,30}$/;

												if(regex.test(value)==0 ){
													$('errsueldomensual').innerHTML='debe ingresar el sueldo mensual .';

													return false;
												}
												else
												{
												$('errsueldomensual').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('otrosingresos', function(value) {

												  regex=/^[0-9._]{0,30}$/;

												if(regex.test(value)==0 ){
													$('errotrosingresos').innerHTML='debe ingresar otros ingresos.';

													return false;
												}
												else
												{
												$('errotrosingresos').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('totalingresos', function(value) {

												  regex=/^[0-9._]{0,30}$/;

												if(regex.test(value)==0 ){
													$('errtotalingresos').innerHTML='debe ingresar total de ingresos';

													return false;
												}
												else
												{
												$('errtotalingresos').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('origendeotrosingresos', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,60}$/;

												if(regex.test(value)==0 ){
													$('errorigendeotrosingresos').innerHTML='Origen de otros ingresos no puede superar los 60 caracteres.';

													return false;
												}
												else
												{
												$('errorigendeotrosingresos').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('referencia1apellidos', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errreferencia1apellidos').innerHTML='Apellido de referencia1  no puede superar los 30 caracteres.';

													return false;
												}
												else
												{
												$('errreferencia1apellidos').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('referencia1nombres', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errreferencia1nombres').innerHTML='Nombre de la referencia1 no puede superar los 30 caracteres';

													return false;
												}
												else
												{
												$('errreferencia1nombres').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('referencia1parentezco', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errreferencia1parentezco').innerHTML='Parentezco no puede superar los 30 caracteres.';
													return false;
												}
												else
												{
												$('errreferencia1parentezco').innerHTML='';
													return true;
												}
											});
											
											
											document.formvalidator.setHandler('referencia2apellidos', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errreferencia2apellidos').innerHTML='Apellidos para la referencia 2 no puede superar los 30 caracteres.';

													return false;
												}
												else
												{
												$('errreferencia2apellidos').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('referencia2nombres', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errreferencia2nombres').innerHTML='Nombre de la referencia2 no puede superar los 30 caracteres.';

													return false;
												}
												else
												{
												$('errreferencia2nombres').innerHTML='';
													return true;
												}
											});
											document.formvalidator.setHandler('referencia2parentezco', function(value) {

												  regex=/^[a-zA-Z0-9_]{2,30}$/;

												if(regex.test(value)==0 ){
													$('errreferencia2parentezco').innerHTML='Parentezco para referencia 2 no puede superar los 30 caracteres.';

													return false;
												}
												else
												{
												$('errreferencia2parentezco').innerHTML='';
													return true;
												}
											});
											
											
											
											document.formvalidator.setHandler('email', function(value) {

												  regex=/^(.+@.+..+)$/;

												if(regex.test(value)==0 ){
													$('erremail').innerHTML='debe ingresar un email válido, por ej.: correo@dominio.com';

													return false;
												}
												else
												{
												$('erremail').innerHTML='';
													return true;
												}
											});
											
});


		
