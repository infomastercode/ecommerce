<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('layout/admin/header'); ?>
        
        <?php
        if (isset($load_plugin_css) && !empty($load_plugin_css)) {
            foreach ($load_plugin_css as $plugin_css) {
                $path_plugin_css = URL_PLUGIN."/".$plugin_css.".css";
                echo "<link href=".$path_plugin_css." rel=\"stylesheet\" type=\"text/css\">\n";
            }
        }
        ?>
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <?php
            $this->load->view('layout/admin/main_menu');
            $layout = new MainMenu();
            $layout->Menu($sub_menu);
            ?>
            <!-- #Navigation -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">
                                <?php echo $text_title; ?>
                                <?php $this->load->view('layout/admin/selector', isset($selector) ? $selector : ''); ?>
                            </h1>
                        </div>
                    </div>
                    <!-- #Page Heading -->
                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo $action; ?>" id="<?php echo $form_form; ?>" method="post" onkeypress="return event.keyCode != 13" enctype="multipart/form-data" class="form-horizontal">
                                <?php $this->load->view($load_page); ?>
                            </form>
                        </div>
                    </div>
                    <!-- #Row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <?php $this->load->view('layout/admin/script'); ?>

        <?php
        if (isset($load_js) && !empty($load_js)) {
            foreach ($load_js as $js) {
                $path_js = URL_JAVASCRIPT."/".$js.".js";
                echo "<script type=\"text/javascript\" src=\"$path_js\"></script>\n";
            }
        }
        ?>
        
        <?php
        if (isset($load_plugin_js) && !empty($load_plugin_js)) {
            foreach ($load_plugin_js as $plugin_js) {
                $path_plugin_js = URL_PLUGIN."/".$plugin_js.".js";
                echo "<script type=\"text/javascript\" src=\"$path_plugin_js\"></script>\n";
            }
        }
        ?>
    </body>
</html>