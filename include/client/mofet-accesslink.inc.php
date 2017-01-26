
<form action="login.php" method="post" id="clientLogin">
    <?php csrf_token(); ?>
<div class="container">
    <div class="row">

        <div class="col s6" style="text-align: left;margin-right: 15px;">
            <h5 style="color: #1576fb;"><?php echo __('בדיקת סטטוס פנייה');?></h5>
        </div>
    </div>

    <div class="row">

       <div class="col s6">
            <p><?= __('הכנס דואר אלקטרוני ומספר פנייה');?></p>
           <div><strong><?php echo Format::htmlchars($errors['login']); ?></strong></div>
        </div>


        <div class="col s6">
            <div class="input-field">
                <input id="email" name="lemail" size="30" class="nowarn" required  type="email" />
                <label for="email"><?php echo __('דואר אלקטרוני<span class="error">*</span>'); ?></label>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col s6">&nbsp;</div>
        <div class="col s6">
            <div class="input-field ">
                <input type="text" id="ticketno"  name="lticket" size="30" class="nowarn" required  />
                <label for="ticketno"><?php echo __('מספר פנייה<span class="error">*</span>'); ?></label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s6">&nbsp;</div>
        <div class="col s6">
            <div class="input-field ">
                <input class="btn" id="view-btn" type="submit" value="<?= __("צפה בפנייה") ?>">
            </div>
        </div>
    </div>
</div>

</form>