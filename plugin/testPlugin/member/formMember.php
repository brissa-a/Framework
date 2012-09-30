<?php
global $em;

if (isset($_REQUEST["member_id"])) {
$member = $em -> getRepository("Member") -> findOneBy(array("id" => $_GET["member_id"]));
if ($member == null)
	unset($member);
}
?>
<form id="formMember"action="@createMember.php"method="post">
<?php if (isset($member)): ?>
<input id="member_id" name="id" type="hidden" value="<?php echo $member->getId()?>"/>
<?php endif ?>
<p ><label for="member_login">member_login</label><input name="member_login"id="member_login"maxlength="255"type="text"value="<?php if (isset($member)){ echo $member->getLogin();} ?>"/></p><p ><label for="member_password">member_password</label><input name="member_password"id="member_password"maxlength="32"type="text"value="<?php if (isset($member)){ echo $member->getPassword();} ?>"/></p><p ><label for="member_firstname">member_firstname</label><input name="member_firstname"id="member_firstname"maxlength="255"type="text"value="<?php if (isset($member)){ echo $member->getFirstName();} ?>"/></p><p ><label for="member_familyname">member_familyname</label><input name="member_familyname"id="member_familyname"maxlength="255"class="required"type="text"value="<?php if (isset($member)){ echo $member->getFamilyName();} ?>"/></p><p ><label for="member_birthdate">member_birthdate</label><input name="member_birthdate"id="member_birthdate"class=" date"type="text"value="<?php if (isset($member)){ echo $member->getBirthDate()->format("d/m/Y");} ?>"/></p><p ><label for="member_subscribedate">member_subscribedate</label><input name="member_subscribedate"id="member_subscribedate"class=" datetime"type="text"value="<?php if (isset($member)){ echo $member->getSubscribeDate()->format("d/m/Y H:m");} ?>"/></p><p ><label for="member_lastconnection">member_lastconnection</label><input name="member_lastconnection"id="member_lastconnection"class=" datetime"type="text"value="<?php if (isset($member)){ echo $member->getLastConnection()->format("d/m/Y H:m");} ?>"/></p><p>No generation function for type boolean</p></form>