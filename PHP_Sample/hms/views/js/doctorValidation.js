function doctorValidation(formName) {
    var form = formName;
    var firstname = document.forms[form]["firstname"].value;
    var lastname = document.forms[form]["lastname"].value;
    var gender = document.forms[form]["gender"].checked;
    var dob = document.forms[form]["dob"].value;
    var age = document.forms[form]['firstname'].value;
    var email = document.forms[form]['email'].value;
    var contact = document.forms[form]['contact'].value;
    var password = document.forms[form]['password'].value;
    var address = document.forms[form]['address'].value
    var qualification = document.forms[form]['qualification'].value;
    if (firstname == "") {
        alert("First name must be filled out");
    }
    if (lastname == "") {
        alert("Last name must be filled out");
    }
    var gender = document.getElementsByName('gender');
    var gender_value = "";
    gender.forEach(function (element) {
        if (element.checked) {
            gender_value = element.value;
        }
    })
    if (gender_value == "") {
        alert("Please select gender");
    }
    if (dob == "") {
        alert("Date of Birth should be filled");
    }
    if (age == "") {
        alert("Enter your age");
    }
    if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
        alert("Enter valid email");
    }
    if (contact == "") {
        alert("Please enter your contact number");
    } else if (contact.length>10) {
        alert("Enter valid contact number");
    } 
    if (password == "") {
        alert("Please enter a password");
    } else if (password.length < 5 || password.length > 8) {
        alert("Password length should be 5-8");
    } 
    if (address == "") {
        alert("Please enter address");
    }
    if (qualification == "") {
        alert("Please enter your qualification");
    }
}