function doctorValidation(formName) {
    var form = formName;
    var email = document.forms[form]['email'].value;
    var password = document.forms[form]['password'].value;
    if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
        alert("Enter valid email");
    }
    if (password == "") {
        alert("Please enter a password");
    } else if (password.length < 5 || password.length > 8) {
        alert("Password length should be 5-8");
    } 
}