<script type="text/javascript">
	
const load_list_of_history_findings =()=>{

     $('#spinner').css('display','block');
     
     var empid = document.getElementById('empidhistory').value;
     var fname = document.getElementById('fnamehistory').value;
     var dateFrom = document.getElementById('auditedhistorydatefrom').value;
     var dateTo = document.getElementById('auditedhistorydateto').value;
     var line = document.getElementById('linenhistory').value;
     var carmaker = document.getElementById('carmakerhistory').value;
     var carmodel = document.getElementById('carmodelhistory').value;
     var position = document.getElementById('positionhistory').value;

           $.ajax({
                url: '../../process/admin/history_processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_history_list',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    empid:empid,
                    fname:fname,
                    line:line,
                    carmaker:carmaker,
                    carmodel:carmodel,
                    position:position
                },success:function(response){
                    document.getElementById('history_data').innerHTML = response;
                    $('#spinner').fadeOut(function(){                       
                    });
                }
            }); 
}

function export_history_list(table_id, separator = ',') {
    // Select rows from table_id
    var rows = document.querySelectorAll('table#' + table_id + ' tr');
    // Construct csv
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'History_of_Modification'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>