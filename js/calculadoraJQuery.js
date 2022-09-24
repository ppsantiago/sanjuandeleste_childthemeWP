(function ($) {
  $(document).on("ready", function () {
    /**  Funciones Compartidas -----------------------------
     *
     *
     */

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

    /**  FORMULARIO GENERAL-----------------------------
     *
     *
     */
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

    const mnzLoadwidget = () => {
      //[elementor-template id="1182"]
      $("#shortmap").html('[elementor-template id="1182"]');
    };

    // End Actions Function

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
     */
    $("#lote").on("change", function () {
      clenHTML("result_form");
      loadResult();
    });
    //Evento a la escucha CUOTAS
    $("#adelanto").on("change", function () {
      var lote = document.getElementById("lote");
      var loteValue = lote.value;

      if (!loteValue.length == 0) {
        console.log(lote.text);
        clenHTML("result_form");
        loadResult();
      }
    });
    //Evento a la escucha ADELANTO
    $("#cuotas").on("change", function () {
      var lote = document.getElementById("lote");
      var loteValue = lote.value;

      if (!loteValue.length == 0) {
        clenHTML("result_form");
        loadResult();
      }
    });

    /**  FORMULARIO INDIVIDUAL-----------------------------
     *
     *
     */

    // recarga div de resultado segun parametros
    const loadResultindividual = (loteID, lotePrice) => {
      var loteValue = lotePrice;
      var adelanto = document.getElementById("adelantoIndividual");
      var adelantoValue = adelanto.value;
      var cuotas = document.getElementById("cuotasIndividual");
      var cuotasValue = cuotas.value;
      $.ajax({
        url: dcms_vars.ajaxurl,
        type: "post",
        data: {
          action: "loteAction",
          data: loteID,
        },
        beforeSend: function () {
          loaderA(true, "resultDetail");
        },
        success: function () {
          total = loteValue - adelantoValue;
          valorCuota = total / cuotasValue;
          loaderA(false, "resultDetail");
          clenHTML("resultDetail");
          $("#resultDetail").append("<h3>Resumen del resultado</h3>");
          $("#resultDetail").append("<h1>Total: $" + total + "</h1>");
          $("#resultDetail").append(
            "<h4>Valor de la cuota: $" + parseInt(valorCuota) + "</h4>"
          );
        },
      });
    };

    //Evento a la escucha CUOTAS
    $("#cuotasIndividual").on("change", async function () {
      var loteURL = document.URL;

      $.ajax({
        url: dcms_vars.ajaxurl,
        type: "post",
        data: {
          action: "getPostID",
          data: loteURL,
        },
        beforeSend: function () {
          console.log("beforesend");
        },
        success: function (resultado) {
          res = JSON.parse(resultado);
          res.forEach((element) => {
            loadResultindividual(element.id, element.precio);
          });
        },
      });
    });

    //Evento a la escucha ADELANTO
    $("#adelantoIndividual").on("change", async function () {
      var loteURL = document.URL;
      $.ajax({
        url: dcms_vars.ajaxurl,
        type: "post",
        data: {
          action: "getPostID",
          data: loteURL,
        },
        beforeSend: function () {
          console.log("beforesend");
        },
        success: function (resultado) {
          console.log(resultado)
          res = JSON.parse(resultado);
          res.forEach((element) => {
            loadResultindividual(element.id, element.precio);
          });
        },
      });
    });
  });
})(jQuery);
