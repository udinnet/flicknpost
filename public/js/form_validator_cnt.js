function initValidation()
{
    document.getElementById("contact_form_id").onsubmit = failOrSuc;
}

function failOrSuc()
{

    if(!fieldValidator())
        {
            document.getElementById("errorT").style.display="block";
            document.getElementById("errorMsg").innerHTML = topErr;
            return false;
        }
    else if(!emailValidator())
        {
            document.getElementById("errorT").style.display="block";
            document.getElementById("errorMsg").innerHTML = topErr;
            return false;
        }
    else
       {
           document.getElementById("errorMsg").innerHTML = "";
           return true;
       }
}

function emailValidator()
{
    var emailField = document.getElementById("email").value;
    var atsign = emailField.indexOf("@");
    var dotsym = emailField.lastIndexOf(".");
    if(emailField != "")
        {
            if(dotsym<atsign+2||atsign<1||dotsym+2>emailField.length)
                {
                    topErr = "Email Address You Entered is Invaild";
                    return false;
                }
            else
                {
                    return true;
                }
        }
    else
        {
            topErr = "Email Address Field is Empty";
            return false;
        }
    
}

function fieldValidator()
{
    var name = document.getElementById("author").value;
    var txt = document.getElementById("text").value;
    txt = jQuery.trim(txt); //used Jquery for the trim()
    
    if(name==""||txt=="")
        {
            topErr = "Please fill all the required fields";
            return false;
        }
    else
        {
            topErr = "";
            return true;
        }
}

var topErr;
window.onload = function(){initValidation();};
