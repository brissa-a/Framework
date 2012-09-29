<?xml version="1.0"?>
<form id="formMember" action="@updateMember.php" method="post">
  <p>
    <label>member_login:</label>
    <input name="member_login" maxlength="255" id="member_login" class="" type="text" value="<?php echo $member->getLogin(); ?>"/>
  </p>
  <p>
    <label>member_password:</label>
    <input name="member_password" maxlength="32" id="member_password" class="" type="text" value="<?php echo $member->getPassword(); ?>"/>
  </p>
  <p>
    <label>member_firstname:</label>
    <input name="member_firstname" maxlength="255" id="member_firstname" class="" type="text" value="<?php echo $member->getFirstName(); ?>"/>
  </p>
  <p>
    <label>member_familyname:</label>
    <input name="member_familyname" maxlength="255" class="required" id="member_familyname" type="text" value="<?php echo $member->getFamilyName(); ?>"/>
  </p>
  <p>
    <label>member_birthdate:</label>
    <input name="member_birthdate" id="member_birthdate" class="date" type="text" value="<?php echo $member->getBirthDate()->format('d/m/Y'); ?>"/>
  </p>
  <p>
    <label>member_subscribedate:</label>
    <input name="member_subscribedate" id="member_subscribedate" class="datetime" type="text" value="<?php echo $member->getSubscribeDate()->format('d/m/Y H:m'); ?>"/>
  </p>
  <p>
    <label>member_lastconnection:</label>
    <input name="member_lastconnection" id="member_lastconnection" class="datetime" type="text" value="<?php echo $member->getLastConnection()->format('d/m/Y H:m'); ?>"/>
  </p>
  <p>No generation function for type boolean</p>
</form>
