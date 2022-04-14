function validatePlateLicense(){
    var letters = /(^$)|(^[0-9a-zA-Z]+$)/;
    var lst = ["plate", "licence"];
    var i;

    for (i of lst){
        if (document.forms["form"][i].value.match(letters)){
            continue;
            }

        else{
            alert("ERROR - This field only accepts numbers and letters and does not accept spaces");
            document.forms["form"][i].value = "";
            return false;   
        }
    }

    if (document.forms["form"]["licence"].value.length>0 && document.forms["form"]["licence"].value.length<16){
        alert("ERROR - Driving license numbers are exactly 16 characters long, use a valid license number");
        document.forms["form"]["licence"].value = "";
    }
}

function validateName(){
    var name = document.forms["form"]["name"].value;
    var letters_name = /(^$)|(^[a-zA-Z\s]+$)/;
    if (!name.match(letters_name)){
        alert("ERROR - This field only accepts letters and spaces");
        document.forms["form"]["name"].value = "";
        return false;
        }
}

function validateType(){
    var type = document.forms["form"]["type"].value;
    var letters_type = /(^$)|(^[0-9a-zA-Z\s]+$)/;
    if (!type.match(letters_type)){
        alert("ERROR - This field only accepts letters, numbers and spaces");
        document.forms["form"]["type"].value = "";
        return false;
        }
}

function validateColour(){
    var colour = document.forms["form"]["colour"].value;
    var letters_colour = /(^$)|(^[a-zA-Z]+$)/;
    if (!colour.match(letters_colour)){
        alert("ERROR - This field only accepts letters spaces are not accepted");
        document.forms["form"]["colour"].value = "";
        return false;
        }
}

function validateDate(){
    var form_date = new Date(document.forms["new_report"]["date"].value);
    var today_date = new Date();
    
    if (form_date > today_date){
        alert("ERROR - You cannot have a date in the future");
        document.forms["form"]["date"].value = "";
    }
}


function validateForm(){
    validatePlateLicense();
    validateName();
    validateType();
    validateColour();
    validateDate();
}



function validateFine(){
    var numbers = /(^$)|(^[0-9]+$)/;
    var lst = ["charge", "points", "id"];
    var i;

    for (i of lst){
        if (document.forms["add_fine"][i].value.match(numbers)){
            continue;
            }

        else{
            alert("ERROR - This field only accepts numbers and does not accept spaces");
            document.forms["add_fine"][i].value = "";
            return false;}
    }

    if (document.forms["add_fine"]["points"].value > 12){
        alert("ERROR - Points cannot be greater than 12");
        document.forms["add_fine"]["points"].value = "";
        return false;

    }
}

function validateOfficer(){
    var letters = /(^$)|(^[a-zA-Z\s]+$)/;
    var name = document.forms["new_officer"]["name"].value

    if (!name.match(letters)){
        alert("ERROR - This field only accepts letters and spaces");
        document.forms["new_officer"]["name"].value = "";
        return false;
        }

    var spaces = /\s+/;
    var username = document.forms["new_officer"]["username"].value;
    if (username.match(spaces)){
        alert("ERROR - This field does not accept spaces");
        document.forms["new_officer"]["username"].value = "";
        return false;
        }
    }   


