function AppointmentValidation() {
    var app_date = document.getElementById("appointment_date").value; 
    var current_date = new Date();
    var before_date = current_date.setDate(current_date.getDate()-1);
    var strtDt  = new Date(app_date);
    var endDt  = new Date(before_date);
    var flag = 0;

    if (strtDt < endDt){
        flag = 1; 
        document.getElementById("error").innerHTML = "Please select valid date";  
    } else {
        flag = 0;
        document.getElementById("error").innerHTML = "";  
    }

}