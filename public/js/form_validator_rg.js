function initValidation()
{
    document.getElementById("register_frm").onsubmit = failOrSuc
}

function failOrSuc()
{

    if(!fieldValidator())
        {
            document.getElementById("errorT").style.display="block";
            document.getElementById("errorMsg").innerHTML = topErr;
            return false
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
    var username = document.getElementById("username").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var pwd = document.getElementById("password").value;
    var pwd2 = document.getElementById("password2").value;
    if(username==""||fname==""||lname==""||pwd==""||pwd2=="")
        {
            topErr = "Please fill all the required fields";
            return false;
        }
    else if(pwd!=pwd2)
        {
            topErr = "Passwords doesn't match";
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