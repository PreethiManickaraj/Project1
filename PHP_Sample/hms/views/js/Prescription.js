function addRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    if (rowCount < 5) {                         
      var row = table.insertRow(rowCount);
      var colCount = table.rows[0].cells.length;
      for (var i = 0; i < colCount; i++) {
        var newcell = row.insertCell(i);
        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
      }
    } else {
      alert("Maximum 5 field is allowed"); 
    }
  }
  function delRow(r,tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    if(rowCount <= 1 ) {
        alert("Cannot remove all fields.")
    } else {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById(tableID).deleteRow(i);
    }
  }