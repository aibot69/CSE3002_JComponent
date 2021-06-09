var flag = false;
var reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/i;
function submitForm(e){
    $(e).submit();
}
function validateDetails(){
    var str = "";
    var u = document.forms["log"]["user"].value;
    var p = document.forms["log"]["pwd"].value;
    if (!u){
        str += "Email can't be blank!<br>";
    }
    else if (!reg.test(u)){
        str += "Not a valid email<br>";
    }
    if (!p){
        str += "Password can't be blank!<br>";
    }
    if (!str){
        return true;
    } else {
        $('#err').html(str);
        return false;
    }
}
function validateRegDetails(){
    var str = "";
    var f = document.forms["reg"]["fname"].value;
    var l = document.forms["reg"]["lname"].value;
    var u = document.forms["reg"]["user"].value;
    var p = document.forms["reg"]["pwd"].value;
    var cp = document.forms["reg"]["cp"].value;
    if (!f || !l){
        str += "Fill out your full name<br>";
    }
    if (!u){
        str += "Email can't be blank<br>";
    } else if (!reg.test(u)){
        str += "Not a valid email<br>";
    }
    if (!p){
        str += "Password can't be blank";
    } else if (p.length < 8){
        str += "What are you, a chimp? Make the password bigger<br>";  
    } else if (p.localeCompare(cp)){
        str += "Passwords don't match<br>";
    }

    if (str == ""){
        return true;
    } else {
        $('#er').html(str);
        return false;
    }
}
function resetForm(e){
    $("#err").html('');
    $("#er").html('');
    $(e).trigger('reset');
}
function getReg(){
    $('#regform').fadeIn();
    $('#form').fadeOut();
    $('#reg').trigger('reset');
}
function getLog(){
    $('#regform').fadeOut();
    $('#form').fadeIn();
    $('#log').trigger('reset');
}