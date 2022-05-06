<script type="text/javascript">
	
const load_list_of_audited_findings_hr =()=>{
     $('#spinner').css('display','block');
     var empid = document.getElementById('empid_audited_fass_checking').value;
     var fname = document.getElementById('fname_audited_fass_checking').value;
     var lname = document.getElementById('linename_audited_fass_checking').value;
     var dateFrom = document.getElementById('hrauditedlistdatefrom').value;
     var dateTo = document.getElementById('hrauditedlistdateto').value;
     var esection = '<?=$esection;?>';
     var carmaker = document.getElementById('carmaker_checking').value;
     var carmodel = document.getElementById('carmodel_checking').value;
     var position = document.getElementById('position_checking').value;
     var audit_type = document.getElementById('audit_type_checking').value;

           $.ajax({
                url: '../../process/hr/for_checking_processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_audited_list_hr',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    empid:empid,
                    fname:fname,
                    esection:esection,
                    lname:lname,
                    carmaker:carmaker,
                    carmodel:carmodel,
                    position:position,
                    audit_type:audit_type
                    
                },success:function(response){
                    document.getElementById('audited_data_hr').innerHTML = response;
                    $('#spinner').fadeOut(function(){
                        
                    });     
                }
            });   
}		

// check all and uncheck
const uncheck_all =()=>{
    var select_all = document.getElementById('check_all_hr');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func =()=>{
    var select_all = document.getElementById('check_all_hr');
    if(select_all.checked == true){
        console.log('check');
        $('.singleCheck').each(function(){
            this.checked=true;
        });
    }else{
        console.log('uncheck');
        $('.singleCheck').each(function(){
            this.checked=false;
        }); 
    }
}

const update_status_hr =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){

    var status = $('#status_hr').val();

 if(status == ''){
         swal('ALERT','Select Status!','info'); 

   } else{

    $.ajax({
        url: '../../process/hr/for_checking_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'update_hr',
            id:arr,
            status:status
      
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
             load_list_of_audited_findings_hr();
             uncheck_all();
                swal('SUCCESS!', 'Success', 'success');
                $('#status_hr').val('');
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }
}
}
</script>