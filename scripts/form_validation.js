function validate() {
    //ids for each of the form fields
    const emailId = '#email-input';
    const passwordId = '#password-input';
    const addressId = '#address-input';
    const phoneId = '#tel-input';
    const provinceId = '#province-input';
    const dobId = '#dob-input';

    //check for valid email
    if(!validateEmail(emailId)) {
        alert('Please enter a valid email.');
        invalidField(emailId);
        return false;
    } else {
        validField(emailId);
    }

    //check for valid password
    if(!validatePassword(passwordId)) {
        invalidField(passwordId);
        return false;
    } else {
        validField(passwordId);
    }

    //check for valid address
    if(!validateAddress(addressId)) {
        invalidField(addressId);
        return false;
    } else {
        validField(addressId);
    }

    //check for valid phone number
    if(!validatePhoneNumber(phoneId)) {
        alert("Please enter a valid 10 digit phone number, separed by '-' or whitespace");
        invalidField(phoneId);
        return false;
    } else {
        validField(phoneId);
    }

    //check for valid value selected from the dropdown list
    if(!validateProvince(provinceId)) {
        alert("Please select a value for Province.");
        invalidField(provinceId);
        return false;
    } else {
        validField(provinceId);
    }

    //check for valid dob
    if(!validateDob(dobId)) {
        alert("Please enter a valid date of birth.");
        invalidField(dobId);
        return false;
    } else {
        validField(dobId);
    }

    //all checks passed
    return true;
}

// checks if email is valid if it follows the regex expression
function validateEmail(emailId) {
    let email = $(emailId).val();

    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email.toLowerCase());
}

//checks if the password is of at least 6 characters, contains at least one uppercase
//and checks if a number is also included
function validatePassword(passwordId) {
    let password = $(passwordId).val();

    if(password.length < 6) {
        alert('Password must be at least 6 characters long.');
        return false;
    } else if (password.search(/[A-Z]/) < 0) {
        alert('Password must contain an uppercase letter');
        return false;
    } else if (password.search(/[0-9]/) < 0) {
        alert('Password must contain at least one digit');
        return false;
    } else if (password.search(/[@*-+!#$%&?]/) < 0) {
        alert('Password must contain at least one special character');
        return false;
    }

    return true;
}

//checks if address is none empty and contains letters
function validateAddress(addressId) {
    let address = $(addressId).val()
    if (address.length <= 0) {
        alert('Please enter a valid address');
        return false;
    } else if (address.search(/[a-z]/i) < 0) {
        alert('Address must contain a lower or uppercase character');
        return false;
    }
    return true;
}

//checks for 10 digit numbers separate by a '-' or whitespace
function validatePhoneNumber(phoneId) {
    let phoneNumber = $(phoneId).val();
    const re = /^\(?([0-9]{3})\)?[- ]?([0-9]{3})[- ]?([0-9]{4})$/
    return re.test(phoneNumber);
}

//checks if a value was selected for the dropdown list
function validateProvince(provinceId) {
    let province = $(provinceId).val();

    if (province === 'Select') {
        return false;
    } 

    return true;
}

//checks if the user was born at a date older than or equal to today
function validateDob(dobId) {
    let dob = new Date($(dobId).val());
    let today = new Date();
    today.setHours(0,0,0,0);

    return today >= dob;
}

//highlights a field to show that it is invalid
function invalidField(field_id) {
    $(field_id).css('border-color', 'red');
    $(field_id).css('border-width', 'medium');
}

//highlights afield to show that it is valid
function validField(field_id) {
    $(field_id).css('border-color', 'green');
    $(field_id).css('border-width', 'thick');
}
