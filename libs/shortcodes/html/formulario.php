  <?php ?>
  <form action="#" method="post">

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="user_name">

    <label for="mail">Correo electrónico:</label>
    <input type="email" id="mail" name="user_mail">
    
    <label for="adelanto">Adelanto</label>
    <input type="number" id="adelanto" name="adelanto" min="2000" max="25000" step="1000">
    
    <label for="cuotas">Cuotas</label>
    <select name="cuotas" id="cuotas">
      <option value="12">12</option>
      <option value="24">24</option>
      <option value="36">36</option>
      <option value="48">48</option>
      <option value="60">60</option>
      <option value="72">72</option>
    </select>
    
    <label for="manzanas">Manzanas</label>
    <select name="manzanas" id="manzanas" class="manzanaSelect">
      <option value="manzana1">Manzana 1</option>
      <option value="manzana2">Manzana 2</option>
      <option value="manzana3">Manzana 3</option>
      <option value="manzana4">Manzana 4</option>
      <option value="manzana5">Manzana 5</option>
      <option value="manzana6">Manzana 6</option>
      <option value="manzana7">Manzana 7</option>
    </select>
    <div id="loteDivLoader" style="display : none" class="container">
      <img src="<?php echo get_stylesheet_directory_uri().'/img/loader.gif' ?>"alt="" style="width: 150px;">
      </div>
    <div id="loteDiv">
      <label for="lote">Lote</label>
      <select name="lote" id="lote" class="loteSelect">
        </select>
      </div>
    <br>
    <button id="btn1">Enviar</button>
  </form>