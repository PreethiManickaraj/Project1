function PasswordValidation() {
    var pw = document.getElementById("ChangePassword").value; 
    var cpw = document.getElementById("ConfirmPassword").value; 
    if(pw == "") {  
        document.getElementById("error").innerHTML = "**Fill the password please!";  
        return false;  
    }  
    if(pw.length < 8) {  
        document.getElementById("error").innerHTML = "**Password length must be atleast 8 characters";  
        return false;  
    }  
    if(pw.length > 15) {  
        document.getElementById("error").innerHTML = "**Password length must not exceed 15 characters";  
        return false;  
    }
    if(pw != cpw) {
        document.getElementById("error").innerHTML = "Please fill the password correctly";  
        return false; 
    } else {
        document.getElementById("success").innerHTML = "Password updated successfully..";  
    }
}