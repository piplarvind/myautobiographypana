// JavaScript Document

var j = jQuery.noConflict();

j(function(){    
    // add multiple select / deselect functionality
    
    j("#check_all").change(function () {
       
        if (j('#check_all').attr('checked')) {
            j('.case').each(function(){
                j(this).attr("checked",true);
                j(this).parent('span').addClass('checked');
            });
        }
        else
        {
            j('.case').each(function(){
                j(this).attr("checked",false);
                j(this).parent('span').removeClass('checked');
            });
        }
    });
	
    j(".case").change(function () {
        var a=1;
        j('.case').each(function(){
            if (!this.checked) {
                a=0;  // if one of the is listed chekcbox is not  cheacked
                j('input[name=check_all]').attr('checked', false);
				j('input[name=check_all]').parent().removeClass('checked');
            }
        });
        if(a==1)
        {
            j('input[name=check_all]').attr('checked', true);
			j('input[name=check_all]').parent().addClass('checked');
        }
    });
	
	/*$(".row-fluid select").change(function(){	
			jQuery("#check_all").attr("checked",false);
			jQuery("#check_all").parent('span').removeClass('checked');
			jQuery('.case').each(function(){
                $(this).attr("checked",false);
                $(this).parent('span').removeClass('checked');
            });
	});
	*/
	
	/*jQuery(".row-fluid ul").click(function(){
						alert($(this).element().clikced
			
			/*jQuery("#check_all").attr("checked",false);
			
			jQuery("#check_all").parent('span').removeClass('checked');
			jQuery('.case').each(function(){
                $(this).attr("checked",false);
                $(this).parent('span').removeClass('checked');
            });
			
	});*/
	
});

function deleteConfirm()
{
    var del_num=0;
	
    /* jQuery('.checked').each(function(){
        del_num=1; 
    });
	*/
	
	j('.case').each(function(){
            if (this.checked) {
				del_num=1;
            }
    });
	
	if(!del_num){
        alert("Please select atleast one record to delete");
		return false;
    }
	else{
        var status=confirm("Do you really want to delete?");
        if(status)
        {
            
           return true;
        }
        else
        {
            return false;
        }
    }
}