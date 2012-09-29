<?xml version="1.0"?>
<form id="formAddress" action="@updateAddress.html" method="post">
  <p>No generation function for type integer</p>
  <p>
    <label>R&#xE9;petition:</label>
    <input name="address_repetition" id="address_repetition" class="" type="text" value="<?php echo $address->getRepetition() ?>"/>
  </p>
  <p>
    <label>address_nomvoie:</label>
    <input name="address_nomvoie" id="address_nomvoie" class="" type="text" value="<?php echo $address->getNomVoie() ?>"/>
  </p>
  <p>
    <label>address_codepostal:</label>
    <input name="address_codepostal" minlength="5" maxlength="5" class="required" id="address_codepostal" type="text" value="<?php echo $address->getCodePostal() ?>"/>
  </p>
  <p>
    <label>address_ville:</label>
    <input name="address_ville" id="address_ville" class="" type="text" value="<?php echo $address->getVille() ?>"/>
  </p>
</form>
