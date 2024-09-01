<div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Add Cases">New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Basic Information -->
                    <div class="border p-3 mb-3">
                        <h6 class="mb-3">Basic Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="studentId" class="form-label">Student ID</label>
                                <input type="text" class="form-control" id="studentId" required>
                            </div>
                            <div class="col-md-4">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" required>
                            </div>
                            <div class="col-md-4">
                                <label for="course" class="form-label">Course</label>
                                <input type="text" class="form-control" id="course" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="yearLevel" class="form-label">Year Level</label>
                                <input type="text" class="form-control" id="yearLevel" required>
                            </div>
                            <div class="col-md-4">
                                <label for="studentType" class="form-label">Student Type</label>
                                <select class="form-select" id="studentType" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="fullTime">Full-Time</option>
                                    <option value="partTime">Part-Time</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="section" class="form-label">Section</label>
                                <input type="text" class="form-control" id="section" required>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="border p-3 mb-3">
                        <h6 class="mb-3">Personal Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" required>
                            </div>
                            <div class="col-md-4">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" required>
                            </div>
                            <div class="col-md-4">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input type="text" class="form-control" id="nationality" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="emergencyContact" class="form-label">Emergency Contact</label>
                                <input type="tel" class="form-control" id="emergencyContact" required>
                            </div>
                            <div class="col-md-4">
                                <label for="relationship" class="form-label">Relationship</label>
                                <input type="text" class="form-control" id="relationship" required>
                            </div>
                            <div class="col-md-4">
                                <label for="guardianName" class="form-label">Guardian's Name</label>
                                <input type="text" class="form-control" id="guardianName" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="guardianContact" class="form-label">Guardian's Contact</label>
                                <input type="tel" class="form-control" id="guardianContact" required>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="border p-3 mb-3">
                        <h6 class="mb-3">Account Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                <button type="button" class="btn btn-primary" style="color: black;">Add Student</button>
            </div>
        </div>
    </div>
</div>