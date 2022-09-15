(function ($) {
  $(document).on("ready", function () {


    /** Boton enviar */
    $("#btn1").on("click", function (e) {
      e.preventDefault();
      var manzana = document.getElementById("manzanas");
      var manzanaValue = manzana.value;
      $.ajax({
        url: dcms_vars.ajaxurl,
        type: "post",
        data: {
          action: "procesarForm",
          manzana: manzanaValue,
        },
        success: function (resultado) {
          console.log(resultado)
        },
      });
    });

    /** Selector para el selector de manzanas */
    $("#manzanas").on("change", function () {
      var manzana = document.getElementById("manzanas");
      var manzanaValue = manzana.value;
      $.ajax({
        url: dcms_vars.ajaxurl,
        type: "post",
        data: {
          action: "manzanaAction"
        },beforeSend: function(){
          $('#loteDiv').css('display', 'none')
          $('#loteDivLoader').css('display', 'inline')
          loteDivLoader
        },
        success: function (resultado) {
          $('#result_form').html('')
          $('#loteDivLoader').css('display', 'none')
          $('#loteDiv').css('display', 'inline')
          $("#lote").html("");
          res = JSON.parse(resultado);

          res.forEach((element) => {
            if (manzanaValue == element.categoria) {
              $("#lote").append(
                '<option value="' +element.precio+'">' +element.nombre+"</option>"
              );}
          });
        },
      });
    });

    /** Cambio de Lote, calculo y prevista  
     * Falta hacer Funcion para que el adelalnto
     * actualize el total cuando se modifique 
     * ppsantiago - 9/13
    */
    $("#lote").on("change", function () {
      $('#result_form').html('')
      var lote = document.getElementById("lote");
      var loteValue = lote.value;
      var adelanto = document.getElementById("adelanto");
      var adelantoValue = adelanto.value;
      var cuotas = document.getElementById("cuotas");
      var cuotasValue = cuotas.value;
      $.ajax({
        url: dcms_vars.ajaxurl,
        type: "post",
        data: {
          action: "loteAction",
        },beforeSend: function(){
          $('#result_form').html('Cargando')
        },
        success: function () {
          total = loteValue - adelantoValue;
          valorCuota = total / cuotasValue
          $('#result_form').append('<h1>Total: $'+total+'</h1>')
          $('#result_form').append('<h1>Valor de la cuota: $'+parseInt(valorCuota)+'</h1>')
        },
      });
    });



  });
})(jQuery);
