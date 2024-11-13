<div class="modal fade" id="AddOSAModal" tabindex="-1" aria-labelledby="AddOSAModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Add Cases">New OSA User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../phpfiles/add_osa.php" method="POST">
                    <!-- Basic Information -->
                    <div class="border p-3 mb-3">
                        <h6 class="mb-3">Basic Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="osaNumber" class="form-label">OSA Number</label>
                                <input type="text" class="form-control" id="osaNumber" name="OSA_number" required>
                            </div>
                            <div class="col-md-4">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="FirstName" required>
                            </div>
                            <div class="col-md-4">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="LastName" required>
                            </div>
                            <div class="col-md-4">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middleName" name="MiddleName" required>
                            </div>
                            <div class="col-md-4">
                                <label for="suffix" class="form-label">Suffix</label>
                                <select class="form-select" id="suffix" name="Suffix" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Jr">Jr.</option>
                                    <option value="Sr">Sr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="border p-3 mb-3">
                        <h6 class="mb-3">Personal Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="Email" required>
                            </div>
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="PhoneNumber" required>
                            </div>
                            <div class="col-md-4">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="DateBirth" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="Address" required>
                            </div>
                            <div class="col-md-4">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="Gender" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input type="text" class="form-control" id="nationality" name="Nationality" required>
                            </div>
                            <div class="col-md-4">
                                <label for="maritalStatus" class="form-label">Marital Status</label>
                                <select class="form-select" id="maritalStatus" name="MaritalStatus" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="border p-3 mb-3">
                        <h6 class="mb-3">Account Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="Username" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="Password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="Role" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Admin">Admin</option>
                                    <option value="OSA">OSA</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="Status" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                        <button type="submit" name="btnadd_osa" value="Add OSA" class="btn btn-primary" style="color: black;">Add OSA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>