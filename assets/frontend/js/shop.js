function addGiftID(id){
    $("#gift-id").val(id);
}
function validateGift(){
    if($("#namegift").val()==""){
        $("#namegift").removeClass("valid");
        $("#namegift").addClass("error");
        return false;
    }
    else{
        $("#namegift").removeClass("error");
        $("#namegift").addClass("valid");
    }
    if($("#emailgift").val()=="" || !checkEmail($("#emailgift").val())){
        $("#emailgift").removeClass("valid");
        $("#emailgift").addClass("error");
        return false;
    }
    else{
        $("#emailgift").removeClass("error");
        $("#emailgift").addClass("valid");
    }
    if($("#fromgift").val()==""){
        $("#fromgift").removeClass("valid");
        $("#fromgift").addClass("error");
        return false;
    }
    else{
        $("#fromgift").removeClass("error");
        $("#fromgift").addClass("valid");
    }
    if($("#textgift").val()==""){
        $("#textgift").removeClass("valid");
        $("#textgift").addClass("error");
        return false;
    }
    else{
        $("#textgift").removeClass("error");
        $("#textgift").addClass("valid");
    }
    return true;
}
function checkEmail(yemail){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(yemail)){
		return false;
	}
	else{
		return true;
	}
}
function sendGift(){
    if(validateGift()){
        var id = $("#gift-id").val();
        AddToCartGift(id);
        return true;
    }
    else{
        return false;
    }
}
function close_popup(){
    $('#backoverlay').hide();
    $('#show_popup').hide();
}