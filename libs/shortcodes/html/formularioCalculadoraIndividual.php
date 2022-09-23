<?php
  $o = get_stylesheet_directory_uri().'/img/loader.gif' ;
  
  echo(' 

  <form action="#" method="post">

    <label for="name">Nombre:</label>
    <input required type="text" id="name" name="user_name" required>

    <label for="mail">Correo electrónico:</label>
    <input required type="email" id="mail" name="user_mail" >
    
    <label for="adelantoIndividual">Adelanto</label>
    <input required type="number" id="adelantoIndividual" name="adelantoIndividual" min="2000" max="25000" step="1000" >
    
    <label for="cuotasIndividual">Cuotas</label>
    <select name="cuotasIndividual" id="cuotasIndividual">
      <option value="12">12</option>
      <option value="24">24</option>
      <option value="36">36</option>
      <option value="48">48</option>
      <option value="60">60</option>
      <option value="72">72</option>
    </select>

    <div id="loteDivLoader" style="display : none" class="container">
      <img src="'.$o.'"alt="" style="width: 150px;">
      </div>
    <div id="loteDiv">
        <br>
        <button type="submit" id="btn1">Enviar</button>
    </div>

    
  </form> ');


  ?>