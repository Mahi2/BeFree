<center>
    <div class="alert alert-success"><?= _lang("success_install"); ?></div>
    <div class="alert alert-warning"><?= _lang("alert_remove_files"); ?></div>
    <div class="alert alert-info"><? _lang("put_code"); ?>
        <br/><br/>
        <kbd>
            include_once("befree_folder/config.php");<br/>
            include_once("befree_folder/project-security.php");
        </kbd>
    </div>
    <a href="../index.php" class="btn-success btn">
        <i class="fas fa-arrow-circle-right"></i>
        <?= _lang("proceed"); ?>
    </a>
</center>