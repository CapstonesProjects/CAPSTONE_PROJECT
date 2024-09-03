<div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Add Cases">New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../phpfiles/add_student.php" method="POST">
                    <!-- Basic Information -->
                    <div class="border p-3 mb-3">
                        <h6 class="mb-3">Basic Information</h6>
                        <div class="row mb-3">
                            <!-- <div class="col-md-4">
                                <label for="userId" class="form-label">User ID</label>
                                <input type="text" class="form-control" id="userId" name="UserID" required>
                            </div> -->
                            <div class="col-md-4">
                                <label for="studentId" class="form-label">Student ID</label>
                                <input type="text" class="form-control" id="studentId" name="StudentID" required>
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
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="course" class="form-label">Course</label>
                                <select class="form-select" id="course" name="Course" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Business Administration">Business Administration</option>
                                    <option value="Nursing">Nursing</option>
                                    <option value="Education">Education</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="yearLevel" class="form-label">Year Level</label>
                                <select class="form-select" id="yearLevel" name="YearLevel" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                    <option value="5">5th Year</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="studentType" class="form-label">Student Type</label>
                                <select class="form-select" id="studentType" name="StudentType" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Irregular">Irregular</option>
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
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input type="text" class="form-control" id="nationality" name="Nationality" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="emergencyContact" class="form-label">Emergency Contact</label>
                                <input type="tel" class="form-control" id="emergencyContact" name="EmergencyContact" required>
                            </div>
                            <div class="col-md-4">
                                <label for="maritalStatus" class="form-label">Marital Status</label>
                                <select class="form-select" id="maritalStatus" name="MaritalStatus" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="guardianName" class="form-label">Guardian's Name</label>
                                <input type="text" class="form-control" id="guardianName" name="GuardiansName" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="guardianContact" class="form-label">Guardian's Contact</label>
                                <input type="tel" class="form-control" id="guardianContact" name="GuardiansContact" required>
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
                        <button type="submit" name="btnadd_student" value="Add Student" class="btn btn-primary" style="color: black;">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>