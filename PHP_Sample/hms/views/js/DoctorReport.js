function DoctorReport()
{
    var message = confirm("Export Records to CSV?");
    if(message == true) {
        window.open("DoctorReportPost?&is_report=1", '_blank');
    }
}