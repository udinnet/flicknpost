<?php
function admin_template($title="",$login=0)
{
    $htmldata = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    $htmldata .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
    $htmldata .= "<head>";
    $htmldata .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
    $htmldata .= "<title>"; 
    $htmldata .=  $title." :: Flick & Post";
    $htmldata .= "</title>";
    $htmldata .= "<meta name=\"keywords\" content=\"\" />";
    $htmldata .= "<meta name=\"description\" content=\"\" />";
    $htmldata .= "<link href=\"../css/fnp_style2.css\" rel=\"stylesheet\" type=\"text/css\" />";
    $htmldata .= "<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>";
    $htmldata .= "<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'>";
    $htmldata .= "<script type=\"text/javascript\" src=\"../js/tinymce/tiny_mce.js\" ></script >";
    $htmldata .= "<script type=\"text/javascript\" >";
    $htmldata .= "tinyMCE.init({";
    $htmldata .= "mode : \"textareas\",";
    $htmldata .= "theme : \"simple\""; 
    $htmldata .= "});";
    $htmldata .= "</script >";
    $htmldata .= "</head>";
    $htmldata .= "<body>";
    $htmldata .= "<div id=\"fnp_wrapper\">";
    $htmldata .= "<div id=\"fnp_header\">";
    $htmldata .= "<div id=\"site_title\">";
    $htmldata .= "<h1><a href=\"../index.php\">";
    $htmldata .= "<img src=\"../assert_img/logo.png\" alt=\"Flick & Post\" />";
    $htmldata .= "</a></h1>";
    $htmldata .= "</div>";
    $htmldata .= "<div id=\"fnp_menu\">";
    $htmldata .= "<ul>";
    $htmldata .= "<li><a href=\"../index.php\">Home</a></li>";
    $htmldata .= "<li><a href=\"../flickblog.php\">FlickBlog</a></li>";
    
    if($login==1)
    {
        $htmldata .= "<li><a href=\"../register.php\" >Register</a></li>";
        $htmldata .= "<li><a href=\"login.php\" class=\"current\">Login</a></li>";
    }
    else
    {
        $htmldata .= "<li><a href=\"index.php\" class=\"current\">Control Panel</a></li>";
        $htmldata .= "<li><a href=\"logout.php\">Logout</a></li>";
    }
    $htmldata .= "<li><a href=\"../contactus.php\">Contact Us</a></li>";
    $htmldata .= "</ul>";   
    $htmldata .= "</div> <!-- end of fnp_menu -->";
    $htmldata .= "<div class=\"cleaner\"></div>";
    $htmldata .= "</div> <!-- end of header -->";
    $htmldata .= "<div id=\"fnp_content\">";
    
    return $htmldata;
}


function public_template($title="",$scripts="")
{
    $htmldata = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
    $htmldata .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
    $htmldata .= "<head>";
    $htmldata .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
    $htmldata .= "<title>"; 
    if($title=="")
    {
        $htmldata .=  $title."Flick & Post";
    }
    else
    {
        $htmldata .=  $title." :: Flick & Post";
    }
    $htmldata .= "</title>";
    $htmldata .= "<meta name=\"keywords\" content=\"\" />";
    $htmldata .= "<meta name=\"description\" content=\"\" />";
    $htmldata .= "<link href=\"css/fnp_style.css\" rel=\"stylesheet\" type=\"text/css\" />";
    $htmldata .= "<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>";
    $htmldata .= "<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'>";
    $htmldata .= "<link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>";
    $htmldata .= $scripts;
    $htmldata .= "</head>";
    $htmldata .= "<body>";
    $htmldata .= "<div id=\"fnp_wrapper\">";
    $htmldata .= "<div id=\"fnp_header\">";
    $htmldata .= "<div id=\"site_title\">";
    $htmldata .= "<h1><a href=\"index.php\">";
    $htmldata .= "<img src=\"assert_img/logo.png\" alt=\"Flick & Post\" />";
    $htmldata .= "</a></h1>";
    $htmldata .= "</div>";
    /*$htmldata .= "<div id=\"fnp_menu\">";
    $htmldata .= "<ul>";
    $htmldata .= "<li><a href=\"index.html\">Home</a></li>";
    $htmldata .= "<li><a href=\"services.html\">Services</a></li>";
    $htmldata .= "<li><a href=\"news.html\" class=\"current\">Control Panel</a></li>";
    $htmldata .= "<li><a href=\"logout.php\">Logout</a></li>";
    $htmldata .= "<li><a href=\"../contactus.php\">Contact Us</a></li>";
    $htmldata .= "</ul>";   
    $htmldata .= "</div> <!-- end of fnp_menu -->";
    $htmldata .= "<div class=\"cleaner\"></div>";
    $htmldata .= "</div> <!-- end of header -->";
    $htmldata .= "<div id=\"fnp_content\">";*/
    
    
    return $htmldata;
}

function include_footer_layout($template="")
{
    include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}
?>
