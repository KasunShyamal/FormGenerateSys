<form id="studentForm" data-parsley-validate>
    <!-- Horizontal Stepper Navigation -->
    <ul class="nav nav-pills mb-4" id="stepper">
        <li class="nav-item">
            <a class="nav-link active" id="personal-info-tab" data-toggle="pill" href="#step-1">Personal Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-info-tab" data-toggle="pill" href="#step-2">Contact Info</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- Personal Info Step -->
        <div class="tab-pane fade show active" id="step-1">
            <h4>Personal Info</h4>
            <input type="hidden" name="id" value="">
            <div class="form-group">
                <label for="first_name">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="first_name" required 
                       data-parsley-pattern="^[a-zA-Z]+$"
                       data-parsley-pattern-message="First Name can only contain letters."
                       data-parsley-trigger="change">
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" class="form-control" name="middle_name">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="last_name" required 
                       data-parsley-pattern="^[a-zA-Z]+$"
                       data-parsley-pattern-message="Last Name can only contain letters."
                       data-parsley-trigger="change">
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" name="dob" required 
                       data-parsley-error-message="Date of Birth is required.">
            </div>
            <div class="form-group">
                <label>NIC Type <span class="text-danger">*</span></label><br>
                <input type="radio" name="nic_type" id="old_nic" value="old" required> Old NIC
                <input type="radio" name="nic_type" id="new_nic" value="new" required> New NIC
                <div class="invalid-feedback">You must select a NIC type.</div>
            </div>
            <div class="form-group">
            <label for="nic">NIC <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nic" name="nic" required 
                data-parsley-trigger="focusout change"
                data-parsley-pattern="^[0-9]{9}[Vv]$|^[0-9]{12}$"
                data-parsley-pattern-message="Enter a valid NIC (Old: 123456789V, New: 123456789109).">
                <small id="nicHint" class="form-text text-muted">Format: 1234567890V</small>
            </div>

            <div class="form-group">
                <label for="gender">Gender <span class="text-danger">*</span></label>
                <select class="form-control" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div class="invalid-feedback">Please select your gender.</div>
            </div>
            <div class="form-group">
                <label for="civil_status">Civil Status <span class="text-danger">*</span></label>
                <select class="form-control" name="civil_status" required>
                    <option value="">Select Civil Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                </select>
                <div class="invalid-feedback">Please select your civil status.</div>
            </div>
            <button type="button" class="btn btn-primary" id="next-to-contact">Next</button>
        </div>

        <!-- Contact Info Step -->
        <div class="tab-pane fade" id="step-2">
            <h4>Contact Info</h4>
            <div class="form-group">
                <label for="mobile">Mobile <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mobile" required 
                       data-parsley-pattern="^\d{10}$"
                       data-parsley-error-message="Enter a valid 10-digit mobile number.">
            </div>
            <div class="form-group">
                <label for="telephone">Telephone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="telephone" required 
                       data-parsley-pattern="^\d{10}$"
                       data-parsley-error-message="Enter a valid 10-digit telephone number.">
            </div>
            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" required 
                       data-parsley-type="email"
                       data-parsley-error-message="Enter a valid email address.">
                <small id="email-error" class="text-danger" style="display: none;"></small>
            </div>
            <div class="form-group">
                <label for="address">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="address" required 
                       data-parsley-error-message="Address is required.">
            </div>
            <div class="form-group">
                <label for="contact_person_name">Contact Person Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contact_person_name" required 
                       data-parsley-error-message="Contact Person Name is required.">
            </div>
            <div class="form-group">
                <label for="contact_person_mobile">Contact Person Mobile <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contact_person_mobile" required 
                       data-parsley-pattern="^\d{10}$"
                       data-parsley-error-message="Enter a valid 10-digit mobile number, different from your own mobile or telephone.">
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-secondary" id="prev-to-personal" style="display: none;">Back</button>
    <button type="submit" class="btn btn-primary" id="submit" style="display: none;">Submit</button>
</form>
