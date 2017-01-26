<?php
// Form headline and deck with a horizontal divider above and an extra
// space below.
// XXX: Would be nice to handle the decoration with a CSS class
?>

<?php
// Form fields, each with corresponding errors follows. Fields marked
// 'private' are not included in the output for clients
global $thisclient;




foreach ($form->getFields() as $i => $field) {
    if (isset($options['mode']) && $options['mode'] == 'create') {
        if (!$field->isVisibleToUsers() && !$field->isRequiredForUsers())
            continue;
    }
    elseif (!$field->isVisibleToUsers() && !$field->isEditableToUsers()) {
        continue;
    }



    if( $field->getLocal('label') === 'Issue Summary' or $field->getLocal('label') === 'נושא הפנייה' ){ ?>
        <div class="row">
        <div class="col s5">&nbsp;</div>
            <div class="col s6">

                <?php if (!$field->isBlockLevel()) { ?>
                <label for="<?php echo $field->getFormName(); ?>"><span class="<?php
            if ($field->isRequiredForUsers()) echo 'required'; ?>">
                <?php echo Format::htmlchars($field->getLocal('label')); ?>
                <?php if ($field->isRequiredForUsers()) { ?>
                    <span class="error">*</span>
                <?php }
                ?></span><?php
                if ($field->get('hint')) { ?>
                    <br /><em style="color:gray;display:inline-block"><?php
                        echo Format::viewableImages($field->getLocal('hint')); ?></em>
                    <?php
                } ?>
                <br/>
                <?php
            }
            $field->render(array('client'=>true));
                ?></label><?php
                foreach ($field->errors() as $e) { ?>
                    <div class="error"><?php echo $e; ?></div>
                <?php }
            $field->renderExtras(array('client'=>true));
                ?>
            </div>
        </div>
  <?php
        continue;
    } ?>

    <div class="row">
        <div class="col s12">
            <label style="padding: 4px;font-size: 14px;" ><?php echo __('אנא מלא את תוכן הפנייה');?><font class="error">*</font></label>
                <?php if (!$field->isBlockLevel()) { ?>
                <label for="<?php echo $field->getFormName(); ?>"><span class="<?php
                    if ($field->isRequiredForUsers()) echo 'required'; ?>">
                    <?php echo Format::htmlchars($field->getLocal('label')); ?>
                        <?php if ($field->isRequiredForUsers()) { ?>
                            <span class="error">*</span>
                        <?php }
                        ?></span><?php
                    if ($field->get('hint')) { ?>
                        <br /><em style="color:gray;display:inline-block"><?php
                            echo Format::viewableImages($field->getLocal('hint')); ?></em>
                        <?php
                    } ?>
                    <br/>
                    <?php
                    }
                    $field->render(array('client'=>true));
                    ?></label><?php
                foreach ($field->errors() as $e) { ?>
                    <div class="error"><?php echo $e; ?></div>
                <?php }
                $field->renderExtras(array('client'=>true));
                ?>

        </div>
    </div>
    <?php
}
?>

<?php
/*
foreach ($form->getFields() as $field) {

    if (isset($options['mode']) && $options['mode'] == 'create') {
        if (!$field->isVisibleToUsers() && !$field->isRequiredForUsers())
            continue;
    }
    elseif (!$field->isVisibleToUsers() && !$field->isEditableToUsers()) {
        continue;
    }
    ?>
    <tr>
        <td colspan="2" style="padding-top:10px;">
            <?php if (!$field->isBlockLevel()) { ?>
            <label for="<?php echo $field->getFormName(); ?>"><span class="<?php
                if ($field->isRequiredForUsers()) echo 'required'; ?>">
                <?php echo Format::htmlchars($field->getLocal('label')); ?>
                    <?php if ($field->isRequiredForUsers()) { ?>
                        <span class="error">*</span>
                    <?php }
                    ?></span><?php
                if ($field->get('hint')) { ?>
                    <br /><em style="color:gray;display:inline-block"><?php
                        echo Format::viewableImages($field->getLocal('hint')); ?></em>
                    <?php
                } ?>
                <br/>
                <?php
                }
                $field->render(array('client'=>true));
                ?></label><?php
            foreach ($field->errors() as $e) { ?>
                <div class="error"><?php echo $e; ?></div>
            <?php }
            $field->renderExtras(array('client'=>true));
            ?>
        </td>
    </tr>
    <?php
}
?>
*/
