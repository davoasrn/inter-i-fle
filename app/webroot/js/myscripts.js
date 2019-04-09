<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
function show_confirm()
{
	var r=confirm("Are you sure ?");
	if (r==true)
	  {
	  alert("You pressed OK!");
	  return true;
	  }
	else
	  {
	  alert("You pressed Cancel!");
	  return false;
	  }
}
</script>
<script type="text/javascript">
$(document).ready(function(){
	setTimeout(function(){
		$('#flashMessage').fadeOut('slow',function(){
			$(this).remove();		
		});	
	},2000);
});
</script>

<!-- check all script -->
<SCRIPT language="javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
       
 
    });
    
    
});
$(document).ready(function(){
		$(".submit").hide();
		$("#removeAll").click(function(){
				var selectedIds = new Array();
				var n = $("input:checked").length;
				alert(n);
				$("input.case:checked").each(function(){
					selectedIds.push($(this).attr("id"));
				});
				alert(selectedIds);
				$('#idArr').val(selectedIds); //return false;
				//$.post("removePrice", { 'choices[]': ["Jon", "Susan"] });
				$("#priceForm").submit(); 
		});
});
</SCRIPT>
