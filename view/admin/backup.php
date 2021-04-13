
<?php
$role_session = mi_get_session('role');
if ($role_session['settings'] != 1){
    mi_redirect(MI_BASE_URL.'admin/index.php');
}
?>

<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>

<main>
    <div class="main-content">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <h4><strong>Site Backup</strong></h4>
                <p>Import and Export your site backup</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-lg-4 col-12 code code-card code-fold">
                <h6 class="code-title">Export Site data</h6>

                <div class="code-preview">
                    <div class="media">
                        <div class="media-body">
                            <form action="actions.php" method="post" enctype="multipart/form-data">
                                <button type="submit" class="btn btn-info btn-lg" name="backup_export" value="1">
                                    Generate Backup and Export <span class="fa fa-refresh"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="code-toggler">
                </div>
            </div>

            <div class="col-md-8 col-lg-8 col-12 code code-card code-fold">
                <h6 class="code-title">All Backups</h6>

                <div class="code-preview">
                    <div class="media">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Backup Name</th>
                                <th>Backup Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $dir = 'backup';
                            if (is_dir($dir)) {
                                if ($dh = opendir($dir)) {
                                    $i = 1;
                                    while (($file = readdir($dh)) !== false) {
                                        if (!empty($file) && strlen($file) > 10 && $i < 6){
                                            $name = str_replace('.mi', '', $file);
                                            echo '<tr>';
                                            echo '<td>'.$i.'</td>';
                                            echo '<td>'.$name.'</td>';
                                            echo '<td>'.date('d M, Y - h:i:s A', filemtime('backup/'.$file)).'</td>';
                                            echo '<td>
                                                                    <a class="btn btn-info btn-sm" href="'.MI_BASE_URL.'admin/backup/'.$file.'" title="Download" download>
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                    <button class="btn btn-sm btn-danger removeBackup" title="Delete" value="'.$file.'">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                  </td>';
                                            echo '</tr>';
                                            $i++;
                                        }
                                    }
                                    closedir($dh);
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="code-toggler">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-12 code code-card code-fold">
                <h6 class="code-title">Import/Restore Site backup</h6>

                <div class="code-preview">
                    <div class="media">
                        <div class="media-body">
                            <form action="actions.php" method="post" enctype="multipart/form-data">

                                <div class="input-group input-group-lg mb-3">
                                    <input type="file" class="form-control form-control-lg" name="backup_file">
                                    <div class="input-group-append">
                                        <button class="btn btn-info btn-lg" type="submit" name="backup_restore" value="1" style="padding: 10px 20px;">
                                            Import and Restore Backup <span class="fa fa-upload"></span>
                                        </button>
                                    </div>
                                </div>
                                <p class="text-danger font-weight-bold"><em>Note: Importing data will remove previous current records.</em></p>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="code-toggler">
                </div>
            </div>
        </div>
    </div>
    <?=mi_include('footer_extra.php');?>
</main>
<!-- END Main container -->


<?=mi_footer();?>
