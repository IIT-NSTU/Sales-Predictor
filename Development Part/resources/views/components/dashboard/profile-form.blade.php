<div class="container">
    <div class="row ">
        <div class="col-md-6 mt-3">
            <div class="card animated fadeIn w-100 p-4">
                <div class="card-body">
                <form id="save-form">
                    <h4>User Profile</h4>
                    <hr />
                    <label>Email Address</label>
                    <input readonly id="email" placeholder="User Email" class="form-control"
                        type="email" />
                    <br />    
                        <div class="row">
                            <div class="col">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text" />
                            </div>
                            <div class="col">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text" />
                            </div>
                        </div>
                    <br />   
                    <label>Mobile Number</label>
                    <input id="mobile" placeholder="Mobile" class="form-control" type="number" />
                    <br />   
                    <label for="logoImg">
                        <img class="w-15 rounded-sm" id="previewImg"
                            src="{{ asset('images/default.jpg') }}" />
                    </label>
                    <br />

                    <label class="form-label">Image</label>
                    <input accept="image/jpeg,image/jpg, image/png, image/webp" oninput="handleLogoImgPreviw(event)"
                        type="file" class="form-control" id="logoImg">

                    <br />
                    <button onclick="handleUpdate()" class="btn w-100  bg-gradient-primary">Update
                        Profile</button>
                </form>        
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="card animated fadeIn w-100 p-4">
                <div class="card-body">
                    <h4>User Password</h4>
                    <hr />
                    <label>Previous Password</label>
                    <input id="previousPassword" placeholder="Previous Password" class="form-control" type="password" />
                    <br />
                    <label>New Password</label>
                    <input id="newPassword" placeholder="New Password" class="form-control" type="password" />
                    <br />
                    <label>Confirm Password</label>
                    <input id="confirmPassword" placeholder="Confirm Password" class="form-control" type="password" />
                    <br />
                    <button onclick="handlePasswordUpdate()" class="btn w-100  bg-gradient-primary">Update Password</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const email = document.getElementById('email');
    const firstName = document.getElementById('firstName');
    const lastName = document.getElementById('lastName');
    const mobile = document.getElementById('mobile');
    const previousPassword = document.getElementById('previousPassword');
    const newPassword = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    const previewImg = document.getElementById('previewImg');
    
    const getProfileDetails = async () => {
        showLoader();
        try {
            const res = await axios.get('/user-profile-details');
            const user = res['data']['data'];

            email.value = user['email'];
            firstName.value = user['first_name'];
            lastName.value = user['last_name'];
            mobile.value = user['mobile'];
            previewImg.src = user['logo_url'];

            hideLoader();
        } catch (error) {
            hideLoader();
            errorToast('Something went wrong');
            setTimeout(() => {
                window.location.href = document.referrer
            }, 1000);

        }

    }
    getProfileDetails();

    const handleUpdate = async () => {
        const isEmailValid = FormValidation.checkEmail(email);
        const isFirstNameValid = FormValidation.checkFirstName(firstName);
        const isLastNameValid = FormValidation.checkLastName(lastName);
        const isMobileNumberValid = FormValidation.checkMobileNumber(mobile);
        const logoImg = document.getElementById('logoImg').files[0];

        // Genarate Form Data
        const formData = new FormData();
        if (logoImg) {
            formData.append('img', logoImg);
        }
        formData.append('first_name', firstName.value.trim());
        formData.append('last_name', lastName.value.trim());
        formData.append('email', email.value.trim());
        formData.append('mobile', mobile.value.trim());

        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        };

        if (isEmailValid  && isFirstNameValid && isLastNameValid && isMobileNumberValid) {
            showLoader();
            try {
                const res = await axios.post('/user-update', formData, config);
                document.getElementById("previewImg").src = "images/default.jpg";
                successToast(res['data']['message']);
                hideLoader();

            } catch (error) {
                errorToast('Profile update failed');
                hideLoader();
            }
        }
    }

    const handlePasswordUpdate = async () => {
        if (previousPassword.value === '') {
            errorToast('Previous Password is required');
            return;
        } else if (previousPassword.value.trim().length < 6) {
            errorToast('Previous Password must be at least 6 character');
            return;
        }

        if (newPassword.value === '') {
            errorToast('New Password is required');
            return;
        } else if (newPassword.value.trim().length < 6) {
            errorToast('New Password must be at least 6 character');
            return;
        }

        if (newPassword.value !== confirmPassword.value) {
            errorToast('Confirm password didn\'t matched');
        } else {
            showLoader();
            try {
                const res = await axios.post('/update-password', {
                    previousPassword: previousPassword.value.trim(),
                    password: newPassword.value.trim()
                });

                successToast(res['data']['message']);
                hideLoader();

                previousPassword.value = '';
                newPassword.value = '';
                confirmPassword.value = '';
            } catch (error) {
                errorToast(error.response.data.message);
                hideLoader();
            }
        }
    }

    const handleLogoImgPreviw = (e) => {
        const previwImg = document.getElementById('previewImg');
        const imgUrl = window.URL.createObjectURL(e.target.files[0]);
        previwImg.src = imgUrl;
    }
</script>
