(function ($) {
  $(document).on("ready", function () {
    // Start Actions Function ------>

    const clenHTML = (id) => {
      $("#" + id).html("");
    };

    //pasar bool para saber si arranca o termina el loader
    const loaderA = (run = Boolean, id = String) => {
      if (run == true) {
        $("#" + id).css("display", "none");
        $("#" + id + "Loader").css("display", "inline");
      } else {
        $("#" + id + "Loader").css("display", "none");
        $("#" + id).css("display", "inline");
      }
    };

    // End Actions Function

    // Start Actions Function ------>

    const loadResult = () => {
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
        },
        beforeSend: function () {
          loaderA(true, "loteDiv");
        },
        success: function () {
          total = loteValue - adelantoValue;
          valorCuota = total / cuotasValue;
          loaderA(false, "loteDiv");
          clenHTML("result_form");
          $("#result_form").append("<h1>Total: $" + total + "</h1>");
          $("#result_form").append(
            "<h1>Valor de la cuota: $" + parseInt(valorCuota) + "</h1>"
          );
        },
      });
    };

    const mnzAction = () => {
      var manzana = document.getElementById("manzanas");
      var manzanaValue = manzana.value;
      $.ajax({
        url: dcms_vars.ajaxurl,
        type: "post",
        data: {
          action: "manzanaAction",
        },
        beforeSend: function () {
          loaderA(true, "loteDiv");
        },
        success: function (resultado) {
          clenHTML("result_form");
          loaderA(false, "loteDiv");
          clenHTML("lote");

          res = JSON.parse(resultado);

          res.forEach((element) => {
            if (manzanaValue == element.categoria) {
              $("#lote").append(
                '<option value="' +
                  element.precio +
                  '">' +
                  element.nombre +
                  "</option>"
              );
            }
          });
        },
      });
    };


    const mnzLoadwidget = () =>{
      //[elementor-template id="1182"]
      $("#shortmap").html('[elementor-template id="1182"]')

    }



    // End Actions Function

    /** Boton enviar */
    $("#btn1").on("click", function (e) {
      //e.preventDefault();
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
          console.log(resultado);
        },
      });
    });

    /** Selector para el selector de manzanas */
    $("#manzanas").on("change", function () {
      mnzAction();
      mnzLoadwidget();
      
    });

    /** Cambio de Lote, calculo y prevista
     * Falta hacer Funcion para que el adelalnto
     * actualize el total cuando se modifique
     * ppsantiago - 9/13
     */
    $("#lote").on("change", function () {
      clenHTML("result_form");
      loadResult();
    });


    $("#adelanto").on("change", function () {
      var lote = document.getElementById("lote");
      var loteValue = lote.value;
      
      if (!loteValue.length == 0) {
        console.log(lote.text)
        clenHTML("result_form");
        loadResult();
      }
    });

    $("#cuotas").on("change", function () {
      var lote = document.getElementById("lote");
      var loteValue = lote.value;

      if (!loteValue.length == 0) {
        clenHTML("result_form");
        loadResult();
      }
    });
  });
})(jQuery);
