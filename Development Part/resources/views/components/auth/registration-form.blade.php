<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr />
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="number" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control"
                                    type="password" />
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="handleRegistration()"
                                    class="btn mt-3 w-100  bg-gradient-primary">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const firstName = document.getElementById('firstName');
    const lastName = document.getElementById('lastName');
    const email = document.getElementById('email');
    const mobile = document.getElementById('mobile');
    const password = document.getElementById('password');

    const handleRegistration = async () => {
        const isEmailValid = FormValidation.checkEmail(email);
        const isPasswordValid = FormValidation.checkPassword(password);
        const isFirstNameValid = FormValidation.checkFirstName(firstName);
        const isLastNameValid = FormValidation.checkLastName(lastName);
        const isMobileNumberValid = FormValidation.checkMobileNumber(mobile);

        if (isEmailValid && isPasswordValid && isFirstNameValid && isLastNameValid && isMobileNumberValid) {
            showLoader();
            try {
                const res = await axios.post('/user-register', {
                    first_name: firstName.value.trim(),
                    last_name: lastName.value.trim(),
                    email: email.value.trim(),
                    mobile: mobile.value.trim(),
                    password: password.value.trim(),
                });
                // Save email in Session
                sessionStorage.setItem('email', email.value.trim())
                
                successToast(res['data']['message']);
                hideLoader();

                // Redirect to Login
                setTimeout(() => {
                    window.location.href = '/verify-reg-code'
                }, 1000)
            } catch (error) {
                errorToast(error.response.data.message);
                hideLoader();
            }
        }
    }
</script>
