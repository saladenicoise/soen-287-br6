function validateInfo(){
           
            var name=document.getElementById("fname").value;
            var email_addr=document.getElementById("email").value;
            var billingAddr=document.getElementById("adr").value;
            var cityName=document.getElementById("city").value;
            var stateName=document.getElementById("state").value;
            var postal=document.getElementById("zip").value;
            var cardName=document.getElementById("cname").value;
            var cardNum=document.getElementById("ccnum").value;
            var expireMon=document.getElementById("expmonth").value;
            var expireY=document.getElementById("expyear").value;
            var CVV=document.getElementById("cvv").value;
            var submit=true;
            
            if(name==""||email_addr==""||billingAddr==""||cityName==""||stateName==""||postal==""||cardName==""||cardNum==""||expireMon==""||expireY==""||CVV==""){
                alert("You have to fill all the field!!");
                submit=false;
            }else{
                submit=true;
            }
            return submit;
}
var emailValid;
var validEmail=/\w+@\w+\.com/;
function validateEmail(){
    emailValid=true;
    var email_addr=document.getElementById("email").value; 
    var message=document.getElementById("emailErrorInfo");
    if(validEmail.test(email_addr)==false){
        message.innerHTML="You have to enter in the form of user@example.com!";
        emailValid=false;
    }else{
        message.innerHTML="";
        emailValid=true;
    }
     disablePlaceOrder();
    
}
var codeValid;
var validPostalCode=/[A-Z][0-9][A-Z]\s[0-9][A-Z][0-9]/;
function validatePostalCode(){
    codeValid=true;
    var postal=document.getElementById("zip").value;
    var message=document.getElementById("postalCodeErrorInfo");
    if(validPostalCode.test(postal)==false){
        message.innerHTML="The postal cose have to be in the form of: H7I 5F2!";
        codeValid=false;
    }else{
        message.innerHTML="";
        codeValid=true;
    }
     disablePlaceOrder();
}
var cNumValid;
var validCardNum=/[0-9]{4}\-[0-9]{4}\-[0-9]{4}\-[0-9]{4}/;
function validateCardNum(){
    cNumValid=true;
    var cardNum=document.getElementById("ccnum").value;
    var message=document.getElementById("ccnumErrorInfo");
    if(validCardNum.test(cardNum)==false){
        message.innerHTML="The card number you entered has to be in the form 0000-0000-0000-0000!";
        cNumValid=false;
    }else{
        message.innerHTML="";
        cNumValid=true;
    }
     disablePlaceOrder();
}
var expMValid;
var validExpMon=/[0-9]{2}/;
function validateExpMon(){
    expMValid=true;
    var expireMon=document.getElementById("expmonth").value;
    var message=document.getElementById("expMonthErrorInfo");
    if(validExpMon.test(expireMon)==false){
        message.innerHTML="The expire month has to be two digits!";
        expMValid=false;
    }else{
        message.innerHTML="";
        expMValid=true;
    }
     disablePlaceOrder();
}
var yearValid;
var validYear=/[0-9]{2}/;
function validateExpYear(){
    yearValid=true;
    var expireY=document.getElementById("expyear").value;
    var message=document.getElementById("expYearErrorInfo");
    if(validYear.test(expireY)==false){
        message.innerHTML="The expire year has to be two digits!";
        yearValid=false;
    }else{
        message.innerHTML="";
        yearValid=true;
    }
     disablePlaceOrder();
}
var cvvValid;
var validCvv=/[0-9]{3}/;
function validateCvv(){
    cvvValid=true;
    var CVV=document.getElementById("cvv").value;
    var message=document.getElementById("cvvErrorInfo");
    if(validCvv.test(CVV)==false){
        message.innerHTML="The cvv is the three digits on the back of your card!";
        cvvValid=false;
    }else{
       message.innerHTML=""; 
       cvvValid=true; 
    }
     disablePlaceOrder();
}

function disablePlaceOrder(){
    var targetBt=document.getElementById("placeOrder");
    if(emailValid&&codeValid&&cNumValid&&expMValid&&yearValid&&cvvValid){
       targetBt.disabled=false;
    }else{
        targetBt.disabled=true;
    }
}

