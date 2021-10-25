function getStateByCountry(countryId, stateFieldId) {
    if (countryId.length == 0) {
        document.getElementById(stateFieldId).innerHTML = "";
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
          document.getElementById(stateFieldId).innerHTML = this.responseText;
        }
        xmlhttp.open("GET", "StatePost?country_id=" + countryId+"&is_ajax=1");
        xmlhttp.send();
    }
}