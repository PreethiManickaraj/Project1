function PatientExport() 
{
    var message = confirm("Export Records to CSV?");
    if(message == true) {
        window.open("PatientReportPost?&is_report=1",'_blank');    
    }
}