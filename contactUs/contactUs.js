const PHONE_CHAR_LIMIT = 12;


/* Function that makes all the fields empty in the contact form*/
function ClearForm() {
    document.getElementById("name").value = "";
    document.getElementById("phone").value = "";
    document.getElementById("email").value = "";
    document.getElementById("address").value = "";
    document.getElementById("subject").value = "";
    document.getElementById("message").value = "";
    document.getElementById("name").value = "";
}

/* Function that checks the form. If not good, alerts the user. If it is good, sends it to the DB*/
function VerifyForm() {
    var error = CheckParams();

    if (error == "no error") {
        // TODO: actually submit the form to the DB
        alert("your form has been submitted");
    } else {
        alert(error);
    }
}

/* Function that checks if a field is empty */
function IsEmpty(fieldID) {
    if (fieldID == "") {
        return true;
    }

    return false;
}

/* Function that checks if the phone is in the proper format*/
function IsPhoneValid(fieldID) {
    /* get the phone number */
    var phoneString = fieldID;

    /* phone number is not the right length */
    if (phoneString.length < PHONE_CHAR_LIMIT) {
        return "Error: Phone number is not the right length";
    }


    /* there is a phone number with the appropriate amount of characters */
    if (!IsEmpty(phoneString)) {

        /* seperate the phone number into individual characters */
        var phoneAr = phoneString.split("");

        /* verifying each number */
        for (i = 0; i < (2 * PHONE_CHAR_LIMIT); i++) {

            /* the character is not a number*/
            if (isNaN(phoneAr[i])) {
                /* the character a seperator in the right spot */
                if (phoneAr[i] == "-" && (i == 3 || i == 7)) {

                }
                /* phone number contains a non-number character */
                else {
                    return "Error: Non-number character in phone number";
                }
            }

            return "no error";
        }
    }
    /* Phone Number is empty */
    else {
        return "Error: Phone number is empty";
    }

}

function CheckParams() {
    /* check name */
    if (IsEmpty(document.getElementById("name").value)) {
        return "Error: Name is empty";
    }

    /* check phone */
    var phoneError = IsPhoneValid(document.getElementById("phone").value);

    if (phoneError != "no error") {
        return phoneError;
    }

    if (IsEmpty(document.getElementById("email").value)) {
        return "Error: Email is empty";
    }

    if (IsEmpty(document.getElementById("subject").value)) {
        return "Error: Subject is empty";
    }

    if (IsEmpty(document.getElementById("message").value)) {
        return "Error: Message is empty";
    }

    return "no error";
}