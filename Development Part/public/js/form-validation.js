// Class for form validation methods
class FormValidation {

    static checkEmail(emailElement) {
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (emailElement.value === '') {
            errorToast('Email is required');
            return false;
        } else if (!emailRegex.test(emailElement.value)) {
            errorToast('Email is not valid');
            return false;
        } else {
            return true;
        }
    }

    static checkPassword(PasswordElement) {
        if (PasswordElement.value === '') {
            errorToast('Password is required');
            return false;
        } else if (PasswordElement.value.trim().length < 6) {
            errorToast('Password must be at least 6 character');
            return false;
        } else {
            return true;
        }
    }

    static checkFirstName(firstNameElement) {
        if (firstNameElement.value.trim() === '') {
            errorToast('First name is required');
            return false;
        } else {
            return true;
        }
    }

    static checkLastName(lastNameElement) {
        if (lastNameElement.value.trim() === '') {
            errorToast('Last name is required');
            return false;
        } else {
            return true;
        }
    }

    static checkMobileNumber(mobileNumberElement) {
        if (mobileNumberElement.value.trim() === '') {
            errorToast('Mobile number is required');
            return false;
        } else if (mobileNumberElement.value.trim().length != 11) {
            errorToast('Mobile number must be have 11 digits.');
            return false;
        } else {
            return true;
        }
    }

    static checkOtp(otpElement) {
        if (otpElement.value.trim().length === 0) {
            errorToast('Verification Code is required');
            return false;
        } else if (otpElement.value.trim().length < 6 || otpElement.value.trim().length > 6) {
            errorToast('Verification Code length must be 6 digit');
            return false;
        } else {
            return true;
        }
    }
}