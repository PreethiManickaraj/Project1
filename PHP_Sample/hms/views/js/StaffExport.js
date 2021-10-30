function StaffExport() 
{
    var message = confirm("Export Records to CSV?");
    if(message == true) {
        window.open("StaffReportPost?&is_report=1",'_blank');    
    }
}