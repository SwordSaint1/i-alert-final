<script type="text/javascript">
	
const closed =()=>{
     $('#spinner').css('display','block');
     var empid = document.getElementById('empid_audited_fas_closed').value;
     var fname = document.getElementById('fname_audited_fas_closed').value;
     var lname = document.getElementById('linename_audited_fas_closed').value;
     var dateFrom = document.getElementById('recievedfrom_closed').value;
     var dateTo = document.getElementById('recievedto_closed').value;
     var esection = '<?=$esection;?>';
     var carmaker = document.getElementById('carmaker_closed').value;
     var carmodel = document.getElementById('carmodel_closed').value;
     var section = document.getElementById('section_closed').value;
     var audit_type = document.getElementById('audit_type_closed').value;
     var position = document.getElementById('position_closed').value;
     var audit_categ = document.getElementById('audit_categ_closed').value;
     $.ajax({
     url: '../../process/fas/audited_closed_processor.php',
     type: 'POST',
     cache: false,
     data:{ 
        method: 'fetch_closed_fas',
        dateFrom:dateFrom,
        dateTo:dateTo,
        empid:empid,
        fname:fname,
        esection:esection,
        lname:lname,
        carmaker:carmaker,
        carmodel:carmodel,
        section:section,
        audit_type:audit_type,
        position:position,
        audit_categ:audit_categ
   	 },success:function(response){
        document.getElementById('audited_closed_fas').innerHTML = response;
        $('#spinner').fadeOut(function(){
      });
	 }
      });
}	
		
</script>