//$("#paymentMethodContainer").hide();


function validateForm() {
        var a=document.forms["adressForm"]["adress"].value;
        var b=document.forms["adressForm"]["email"].value;
        var c=document.forms["adressForm"]["phone_number"].value;
        var d=document.forms["adressForm"]["first_name"].value;
		var e=document.forms["adressForm"]["last_name"].value;
		var f=document.forms["adressForm"]["city"].value;
		var g=document.forms["adressForm"]["zip_code"].value;
		var h=document.forms["adressForm"]["country"].value;
	
        if (a==null || a=="", b==null || b=="", c==null || c=="",d==null || d=="", e==null || e=="", f==null || f=="", g==null || g=="", h==null || h=="")
        {
          alert("Please Fill All Required Field");
           return false;
        } 
}