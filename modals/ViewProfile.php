 <!-- Modal for each student -->
 <div class="modal fade" id="OSAViewProfileModal<?php echo $row['UserID']; ?>" tabindex="-1" aria-labelledby="OSAViewProfileLabel<?php echo $row['UserID']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header bg-gray-100">
                                        <h5 class="modal-title font-bold text-lg" id="OSAViewProfileLabel<?php echo $row['UserID']; ?>">View Profile</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body bg-gray-50">
                                        <form action="" method="POST">
                                            <div class="container mx-auto p-4">
                                                <!-- Basic Information Section -->
                                                <div class="mb-4 p-4 border border-gray-300 rounded-lg bg-white shadow-sm">
                                                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">Basic Information</h3>
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Student ID:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['StudentID']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>First Name:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['FirstName']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Last Name:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['LastName']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Middle Name:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['MiddleName']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Suffix:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Suffix']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Course:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Course']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Year Level:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['YearLevel']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Student Type:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['StudentType']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Email:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Email']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Phone Number:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['PhoneNumber']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Divider -->
                                                <hr class="my-4 border-t-2 border-gray-300">
                                                <!-- Personal Information Section -->
                                                <div class="mb-4 p-4 border border-gray-300 rounded-lg bg-white shadow-sm">
                                                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">Personal Information</h3>
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Date of Birth:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['DateBirth']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Address:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Address']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Gender:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Gender']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Nationality:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Nationality']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Emergency Contact:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['EmergencyContact']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Marital Status:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['MaritalStatus']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Guardian's Name:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['GuardiansName']; ?></p>
                                                        </div>
                                                        <div>
                                                            <label class="form-label font-semibold"><strong>Guardian's Contact:</strong></label>
                                                            <p class="bg-gray-100 p-2 rounded border"><?php echo $row['GuardiansContact']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-gray-100">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>