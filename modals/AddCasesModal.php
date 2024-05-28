<div class="modal fade" id="AddCasesModal" tabindex="-1" aria-labelledby="AddCasesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Add Cases">New Case</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="studentId" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="studentId" required>
                        </div>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="offenseCategory" class="form-label">Category of Offense</label>
                            <select class="form-select" id="offenseCategory" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="category1">Category 1</option>
                                <option value="category2">Category 2</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="offenseDescription" class="form-label">Description of Offense</label>
                            <textarea class="form-control" id="offenseDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="status1">Status 1</option>
                                <option value="status2">Status 2</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                <button type="button" class="btn btn-primary" style="color: black;">Save changes</button>
            </div>
        </div>
    </div>
</div>