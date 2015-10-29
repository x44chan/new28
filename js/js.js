//test test
$(function(){	
	$("#regerr").on("click", function(){
        window.location.reload();
    });
});
$(document).ready(function(){	
    $("#regerr").click(function(){
        $("#regerr").attr("href", "admin.php?");
    });
	$('#typeoflea').change(function() {
   		var selected = $(this).val();
		$('#numdays').val("");
		if(selected == 'Others:'){
			$('#othersl').attr('disabled',false);
			$("#othersl").attr('required',true);
			$('#othersl').attr("placeholder", "Enter Reason");
   		}else{
			$('#othersl').val("");
			$('#othersl').attr('disabled',true);
			$('#othersl').attr("placeholder", " ");
			$("#othersl").attr('required',false);
   		}
   		if(selected == 'Paternity Leave' || selected == 'Wedding Leave'){
   			$('#numdays').val('7');
   			$('#numdays').attr('readonly', true);
   		}else{
   			$('#numdays').val();
   			$('#numdays').attr('readonly', false);
   		}

	});
	$("#petamount").keyup(function(e){
        $(this).val(format($(this).val()));
    });
	 //auto add comma in amount
	var format = function(num){
	    var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
	    if(str.indexOf(".") > 0) {
	        parts = str.split(".");
	        str = parts[0];
	    }
	    str = str.split("").reverse();
	    for(var j = 0, len = str.length; j < len; j++) {
	        if(str[j] != ",") {
	            output.push(str[j]);
	            if(i%3 == 0 && j < (len - 1)) {
	                output.push(",");
	            }
	            i++;
	        }
	    }
	    formatted = output.reverse().join("");
	    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
	};
	$('#csrinternet').change(function(){
		    if($('#csrinternet').is(":checked")){ 	        
		    	$("#csrintprob").attr('required',true);
		    	$("#csrintact").attr('required',true);
		    }else{
		    	$("#csrintprob").attr('required',false);
		    	$("#csrintact").attr('required',false);
		    }
		});
		$('#csrrouter').change(function(){
		    if($('#csrrouter').is(":checked")){ 	        
		    	$("#csrrouterprob").attr('required',true);
		    	$("#csrrouteract").attr('required',true);
		    }else{
		    	$("#csrrouterprob").attr('required',false);
		    	$("#csrrouteract").attr('required',false);
		    }
		});
		$('#csrfirewall').change(function(){
		    if($('#csrfirewall').is(":checked")){ 	        
		    	$("#csrfirewallprob").attr('required',true);
		    	$("#csrfirewallact").attr('required',true);
		    }else{
		    	$("#csrfirewallprob").attr('required',false);
		    	$("#csrfirewallact").attr('required',false);
		    }
		});
		$('#csrswitch').change(function(){
		    if($('#csrswitch').is(":checked")){ 	        
		    	$("#csrswitchprob").attr('required',true);
		    	$("#csrswitchact").attr('required',true);
		    }else{
		    	$("#csrswitchprob").attr('required',false);
		    	$("#csrswitchact").attr('required',false);
		    }
		});
		$('#csracc').change(function(){
		    if($('#csracc').is(":checked")){ 	        
		    	$("#csraccprob").attr('required',true);
		    	$("#csraccact").attr('required',true);
		    }else{
		    	$("#csraccprob").attr('required',false);
		    	$("#csraccact").attr('required',false);
		    }
		});
		$('#csractvedrctory').change(function(){
		    if($('#csractvedrctory').is(":checked")){ 	        
		    	$("#csractvedrctoryprob").attr('required',true);
		    	$("#csractvedrctoryact").attr('required',true);
		    }else{
		    	$("#csractvedrctoryprob").attr('required',false);
		    	$("#csractvedrctoryact").attr('required',false);
		    }
		});
		$('#csrfilesrvr').change(function(){
		    if($('#csrfilesrvr').is(":checked")){ 	        
		    	$("#csrfilesrvrprob").attr('required',true);
		    	$("#csrfilesrvract").attr('required',true);
		    }else{
		    	$("#csrfilesrvrprob").attr('required',false);
		    	$("#csrfilesrvract").attr('required',false);
		    }
		});
		$('#csrmail').change(function(){
		    if($('#csrmail').is(":checked")){ 	        
		    	$("#csrmailprob").attr('required',true);
		    	$("#csrmailact").attr('required',true);
		    }else{
		    	$("#csrmailprob").attr('required',false);
		    	$("#csrmailact").attr('required',false);
		    }
		});
		$('#csrapp').change(function(){
		    if($('#csrapp').is(":checked")){ 	        
		    	$("#csrappprob").attr('required',true);
		    	$("#csrappact").attr('required',true);
		    }else{
		    	$("#csrappprob").attr('required',false);
		    	$("#csrappact").attr('required',false);
		    }
		});
		$('#csrother').change(function(){
		    if($('#csrother').is(":checked")){ 	        
		    	$("#csrotherprob").attr('required',true);
		    	$("#csrotheract").attr('required',true);
		    }else{
		    	$("#csrotherprob").attr('required',false);
		    	$("#csrotheract").attr('required',false);
		    }
		});
});

//admin jquery
$(function(){	
	$("#needaproval").show();
	$("#showneedapproval").on("click", function(){
        $("#needaproval").show();
		$("#officialbusiness").show();
		$("#officialbusinessdisapprove").show();
		$("#officialbusinessapprove").hide();
		$("#officialbusinessdisapprove").hide();
		$("#officialbusinessdisapprove").hide();
		$("#approved").hide();
		$("#newuser").hide();	
		$("#disapproved").hide();
		$("#regerror").hide();
    });
});
$(function(){	
	$("#newuser").hide();
	$("#newuserbtn").on("click", function(){
        $("#newuser").show();
		$("#officialbusinessapprove").hide();
		$("#officialbusiness").hide();
		$("#approved").hide();
		$("#needaproval").hide();
		$("#disapproved").hide();
		$("#regerror").hide();
		$("#dash").hide();		
	});
});
$(function(){	
	$("#approved").hide();
	$("#officialbusinessapprove").hide();
	$("#officialbusinessdisapprove").hide();
	$("#showapproved").on("click", function(){
        $("#approved").show();
		$("#needaproval").hide();
		$("#newuser").hide();
		$("#regerror").hide();
		$("#disapproved").hide();
		$("#officialbusiness").hide();
		$("#officialbusinessapprove").show();
    });
});
$(function(){	
	$("#disapproved").hide();
	$("#showdispproved").on("click", function(){
    $("#disapproved").show();
		$("#officialbusiness").hide();
		$("#officialbusinessapprove").hide();
		$("#officialbusinessdisapprove").show();
		$("#newuser").hide();
		$("#regerror").hide();
		$("#approved").hide();
		$("#needaproval").hide();
    });
});
//employee jquery
$(function(){	
	$("#home").on("click", function(){
        $("#dash").show();
		$("#penot").show();
		$("#officialbusiness").show();
		$("#offb").hide();
		$("#undertime").hide();
		$("#formhidden").hide();
		$("#needaproval").hide();		
		$("#approvedrequest").hide();
		$("#disapprovedrequest").hide();
		$("#officialbusinessapprove").hide();
    });
});
$(function(){
    $("#formhidden").hide();
    $("#newovertime").on("click", function(){
        $("#formhidden").toggle();
		$("#approvedrequest").hide();
		$("#leave").hide();
		$("#dash").hide();
		$("#disapprovedrequest").hide();
		$("#officialbusiness").hide();
		$("#userlist").hide();
		$("#needaproval").hide();
		$("#appob").hide();
		$("#appot").hide();
		$("#appleave").hide();
		$("#appundr").hide();
		$("#dappob").hide();
		$("#dappot").hide();
		$("#dappleave").hide();
		$("#disappundr").hide();
		$("#disappleave").hide();
		$("#report").hide();

	});
});

$(function(){
    $("#leave").hide();
    $("#newleave").on("click", function(){
        $("#leave").show();
		$('#typeoflea').focus().select();
		$("#approvedrequest").hide();
		$("#dash").hide();
		$("#disapprovedrequest").hide();
		$("#officialbusiness").hide();
		$("#undertime").hide();
		$("#offb").hide();
		$("#formhidden").hide();
		$("#userlist").hide();
		$("#needaproval").hide();
		$("#appob").hide();
		$("#appot").hide();
		$("#appleave").hide();
		$("#appundr").hide();
		$("#dappob").hide();
		$("#dappot").hide();
		$("#dappleave").hide();
		$("#disappundr").hide();
		$("#disappleave").hide();
		$("#report").hide();
	});
});

$(function(){
    $("#undertime").hide();
    $("#newundertime").on("click", function(){
        $("#undertime").show();
		$("#formhidden").hide();
		$("#approvedrequest").hide();
		$("#disapprovedrequest").hide();
		$("#officialbusiness").hide();
		$("#offb").hide();
		$("#dash").hide();
		$("#userlist").hide();
		$("#leave").hide();
		$("#needaproval").hide();
		$("#appob").hide();
		$("#appot").hide();
		$("#appleave").hide();
		$("#appundr").hide();
		$("#dappob").hide();
		$("#dappot").hide();
		$("#dappleave").hide();
		$("#disappundr").hide();
		$("#disappleave").hide();
		$("#report").hide();
	});
});
$(function(){
    $("#offb").hide();
    $("#newoffb").on("click", function(){
        $("#offb").show();
		$("#dash").hide();
		$("#undertime").hide();
		$("#formhidden").hide();
		$("#approvedrequest").hide();
		$("#officialbusiness").hide();
		$("#disapprovedrequest").hide();
		$("#userlist").hide();
		$("#leave").hide();
		$("#needaproval").hide();
		$("#appob").hide();
		$("#appot").hide();
		$("#appleave").hide();
		$("#appundr").hide();
		$("#dappob").hide();
		$("#dappot").hide();
		$("#dappleave").hide();
		$("#disappundr").hide();
		$("#disappleave").hide();
		$("#report").hide();
	});
});

$(function(){
    $("#formhidden").hide();
    $("#newovertime").on("click", function(){
        $("#formhidden").show();
		$("#offb").hide();
		$("#approvedrequest").hide();
		$("#dash").hide();
		$("#undertime").hide();
		$("#disapprovedrequest").hide();
		$("#userlist").hide();
		$("#needaproval").hide();
		$("#leave").hide();
		$("#appob").hide();
		$("#appot").hide();
		$("#appleave").hide();
		$("#appundr").hide();
		$("#dappob").hide();
		$("#dappot").hide();
		$("#dappleave").hide();
		$("#disappundr").hide();
		$("#disappleave").hide();
		$("#report").hide();
	});
});
$(function(){
    $("#approvedrequest").hide();
    $("#myapprove").on("click", function(){
        $("#approvedrequest").show();
		$("#officialbusiness").hide();
		$("#offb").hide();
		$("#formhidden").hide();
		$("#dash").hide();
		$("#disapprovedrequest").hide();
		

    });
});
$(function(){
    $("#disapprovedrequest").hide();
    $("#mydisapprove").on("click", function(){
		$("#offb").hide();
		$("#officialbusiness").hide();
        $("#disapprovedrequest").show();
		$("#formhidden").hide();
		$("#dash").hide();
		$("#approvedrequest").hide();
    });
});


$(function(){
    $("#hideot").on("click", function(){
        $("#formhidden").hide();
		$("#offb").hide();
		$("#leave").hide();
		$("#dash").show();
    });
});


$(function(){
    $("#hideob").on("click", function(){
		$("#offb").hide();
		$("#dash").show();
    });
});


$(function(){
    $("#hideout").on("click", function(){
		$("#undertime").hide();
		$("#dash").show();
    });
});
