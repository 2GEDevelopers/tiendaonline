<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <div class="container">
            <div id="header" name="header" class="row" style="margin-top: 20px"> 
                <div id="logoDiv" name="logoDiv" class="span4">
                    <a href="<?php echo url_for1("@homepage") ?>"><h1> LOGO </h1></a>    
                </div>
                <div id="userDiv" name="userDiv" class="span4"></div>
            </div>
            <div id="navContainer" name="navContainer" class="row">
                <div id="navDiv" name="navDiv" class="navbar"  style="margin-left: 10px;">
                    <div class="nav-collapse">
                    <!--     Este menu debe ser impreso dinamicamente                   -->
                        <ul class="nav ">
                            <li><a href="#"><h3>Categoria-1</h3></a></li>
                            <li><a href="#"><h3>Categoria-2</h3></a></li>
                            <li><a href="#"><h3>Categoria-3</h3></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php echo $sf_content ?>
            <div id="footer" name="footer"></div>
        </div>
    </body>
</html>
