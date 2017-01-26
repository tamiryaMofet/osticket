<?php
if(!defined('OSTCLIENTINC')) die('Access Denied!');
$info=array();
if($thisclient && $thisclient->isValid()) {
    $info=array('name'=>$thisclient->getName(),
        'email'=>$thisclient->getEmail(),
        'phone'=>$thisclient->getPhoneNumber());
}

$info=($_POST && $errors)?Format::htmlchars($_POST):$info;

$form = null;
if (!$info['topicId']) {
    if (array_key_exists('topicId',$_GET) && preg_match('/^\d+$/',$_GET['topicId']) && Topic::lookup($_GET['topicId']))
        $info['topicId'] = intval($_GET['topicId']);
    else
        $info['topicId'] = $cfg->getDefaultTopicId();
}

$forms = array();
if ($info['topicId'] && ($topic=Topic::lookup($info['topicId']))) {
    foreach ($topic->getForms() as $F) {
        if (!$F->hasAnyVisibleFields())
            continue;
        if ($_POST) {
            $F = $F->instanciate();
            $F->isValidForClient();
        }
        $forms[] = $F;
    }
}

?>

<div class="ticket-create-wrap s12">
    <div class="row ticket-create-wrap">
        <h5  class="ticket-create ticket-create-margin" ><?php echo __('פתיחת פנייה חדשה');?></h5>
    </div>
    <form id="ticketForm" method="post" action="open.php?lang=he_IL" enctype="multipart/form-data">
        <?php csrf_token(); ?>
        <input type="hidden" name="a" value="open">
    <div class="row">
        <div class="col s5">
            <p><?php echo __('אנא מלא את הטופס על מנת לפתוח פנייה חדשה');?></p>
        </div>
        <div class="col s6">
            <?php
                $uform = UserForm::getUserForm()->getForm($_POST);
                if ($_POST) $uform->isValid();
                $uform->render(false);
            ?>

            <div class="browser-default ">
                <label><?php echo __('נושא התקלה');?></label>
                <select id="topicId" name="topicId" onchange="javascript:
                    var data = $(':input[name]', '#dynamic-form').serialize();
                    $.ajax(
                      'ajax.php/form/help-topic/' + this.value,
                      {
                        data: data,
                        dataType: 'json',
                        success: function(json) {
                          $('#dynamic-form').empty().append(json.html);
                          $(document.head).append(json.media);
                        }
                      });">
                    <option value="" disabled selected><?php echo __('נושא התקלה');?></option>
                    <?php
                    if($topics=Topic::getPublicHelpTopics()) {
                        foreach($topics as $id =>$name) {
                            echo sprintf('<option value="%d" %s>%s</option>',
                                $id, ($info['topicId']==$id)?'selected="selected"':'', $name);
                        }
                    } else { ?>
                        <option value="0" ><?php echo __('General Inquiry');?></option>
                        <?php
                    } ?>
                </select>
                <label>Help Topic<font class="error">*&nbsp;<?php echo $errors['topicId']; ?></font></label>
            </div>
        </div>
    </div>


        <?php foreach ($forms as $form) {
            include(CLIENTINC_DIR . 'templates/mofet-dynamic-form.tmpl.php');
        } ?>


        <?php
        if($cfg && $cfg->isCaptchaEnabled() && (!$thisclient || !$thisclient->isValid())) {
            if($_POST && $errors && !$errors['captcha'])
                $errors['captcha']=__('Please re-enter the text again');
            ?>
            <div class="row">
            <div class="col s8 captchaRow">
                <span class="required"><?php echo __('אנא הקלד את הטקסט המופיע בתמונה');?>:</span>

                    <span class="captcha"><img src="captcha.php" border="0" align="left"></span>
                    &nbsp;&nbsp;
                    <input id="captcha" type="text" name="captcha" size="6" autocomplete="off">
                    <font class="error">&nbsp;<?php echo $errors['captcha']; ?></font>
            </div>
            </div>
            <?php
        } ?>


    <div class="row center-align bootom-btns">
        <div class="col s12">
            <button class="btn submit-btn" type="submit" name="action"> <?php echo __('שלח פנייה');?></button>
            <button type="reset" class="btn reset-btn" ><?php echo __('איפוס טופס');?></button>
        </div>
    </div>
</div>
</form>
