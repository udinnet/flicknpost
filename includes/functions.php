<?php

function strip_zeros_from_date($marked_string='')
{
    //remove zeros
    $no_zeros = str_replace('*0', '', $marked_string);
    //remove other zeros that not been used
    $cleaned_sring = str_replace('*', '', $no_zeros);
    return $cleaned_sring;
}

function redirect_to($location = NULL)
{
    if($location != NULL)
        header ("Location: {$location}");
    exit;
}

function output_msg($message = NULL)
{
    if($message != NULL)
    {
        return "<h3 id\"infomsg\" style=\"color: #ffb305;\">{$message}</h3>";
    }
    else
        return "";
}

function include_layout_template($template="")
{
    include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

function __autoload($class_name)
{
    $file = strtolower($class_name);
    $path = LIB_PATH.DS."{$file}.php"; 
    if(file_exists($path))
    {
        require_once ($path);
    }
    else
    {
        die("<br/>The file {$file}.php does not exists<br/>");
    }
    
}

function log_action($action,$message="")
{
    $file = 'log_login.txt';
    $dir = SITE_ROOT.DS.'logs';
    $current_dir = getcwd();
    $log_time = strftime("%Y-%m-%d %H:%M:%S",time());
    $log_string = $log_time." | ".$action." | ".$message."\n";
    
    if($dir != $current_dir)
    {
        chdir($dir);
    }
    
    if($action == "Login")
    {
        if(!file_exists($file))
        {
            $log_handle = fopen($file,'w');
            fclose($log_handle);
        }
    
        if(!is_writable($file))
        {
            chmod($file, 0755);
        }
    
        $log_handle = fopen($file,'a');
    
        fwrite($log_handle, $log_string);      
        fclose($log_handle);        
    }
    
    if($action == "Logout")
    {
        if(!file_exists($file))
        {
            $log_handle = fopen($file,'w');
            fclose($log_handle);
        }
    
        if(!is_writable($file))
        {
            chmod($file, 0755);
        }
    
        $log_handle = fopen($file,'a');
    
        fwrite($log_handle, $log_string);      
        fclose($log_handle);        
    }
    
    if($action == "Clear")
    {
        $log_handle = fopen($file,'w');
        if(!is_writable($file))
        {
            chmod($file, 0755);
        }
        fwrite($log_handle, $log_string);
        fclose($log_handle);
    }
    
    if($action == "Read")
    {
        if(!file_exists($file))
        {
            if(!is_readable($file)||!is_writable($file))
            {
                chmod($file, 0755);
            }
            $log_handle = fopen($file,'w');
            fwrite($log_handle, $log_string);
            fclose($log_handle);
            $log_handle = fopen($file,'r');
            $log_content = fread($log_handle, filesize($file));
            fclose($log_handle);
        }
        else
        {
            if(!is_readable($file)||!is_writable($file))
            {
                chmod($file, 0755);
            }
            $log_handle = fopen($file,'a');
            fwrite($log_handle, $log_string);
            fclose($log_handle);
            $log_handle = fopen($file,'r');
            $log_content = fread($log_handle, filesize($file));
            fclose($log_handle);
        }
        
    }
    return $log_content;
}


function homepage_box ($content="")
{
    $position = 200;
    $content_len = strlen($content);
    
    if($content_len<=$position)
    {
        $post = $content;
    }
    else
    {
        $post = substr($content,$position,1); //Checking current end

        if($post !=" "){
            while($post !=" "){
                $i=1;
                $position=$position+$i;

                $post = substr($content,$position,1);
            }
            $post = substr($content,0,$position);

        }
        else
           $post = substr($content,0,$position);
    }

    unset($position);
    $post = $post." ...";
    
    return strip_tags($post);
    
}

function timestamp_convert($sql_timestamp="")
{
      $unixtime = strtotime($sql_timestamp);
      return strftime('%B %d, %Y at %I:%M %p', $unixtime);    
}
?>
