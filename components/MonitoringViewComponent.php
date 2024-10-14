<?php
include('../config/db_connection.php');

// Fetch case details based on caseID from the query parameter
$caseID = $_GET['caseID'];
$query = "SELECT * FROM tblcases WHERE CaseID = '$caseID'";
$result = mysqli_query($conn, $query);
$caseDetails = mysqli_fetch_assoc($result);



mysqli_close($conn);
?>

<style>
    .container {
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
        padding: 2rem;
        width: 1590px;
        max-width: 1620px;
        overflow: hidden;
        position: relative;
    }

    .back-button {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background-color: #38b2ac;
        color: white;
        font-weight: 700;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .back-button:hover {
        background-color: #2c7a7b;
        transform: scale(1.05);
    }

    .form-label {
        display: block;
        color: #4a5568;
        font-size: 0.875rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .form-input,
    .form-textarea,
    .form-file {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        width: 100%;
        padding: 0.75rem 1rem;
        color: #4a5568;
        line-height: 1.25;
        outline: none;
        transition: box-shadow 0.2s ease-in-out;
        background-color: #f7fafc;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-file:focus {
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
    }

    .form-button {
        background-color: #38b2ac;
        color: white;
        font-weight: 700;
        padding: 0.5rem 1.5rem;
        border-radius: 0.375rem;
        outline: none;
        transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .form-button:hover {
        background-color: #2c7a7b;
        transform: scale(1.05);
    }


    .form-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        text-align: center;
        color: #319795;
    }

    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .grid-container .full-width {
        grid-column: span 2;
    }
</style>

<div class="flex justify-center items-center mt-10">
    <div class="container">
        <a href="../OSA/OSA_Monitoring.php" class="back-button">Back</a>
        <h2 class="form-title">Suspended Student Details</h2>
        <form>
            <input type="hidden" name="caseID" value="<?php echo $caseDetails['CaseID']; ?>">
            <div class="grid-container">
                <div class="form-section">
                    <label class="form-label" for="caseID">Case ID</label>
                    <input type="text" id="caseID" class="form-input" value="<?php echo $caseDetails['CaseID']; ?>" readonly>
                </div>

                <div class="form-section">
                    <label class="form-label" for="studentName">Student Name</label>
                    <input type="text" id="studentName" class="form-input" value="<?php echo $caseDetails['FullName']; ?>" readonly>
                </div>

                <div class="form-section">
                    <label class="form-label" for="studentID">Student ID</label>
                    <input type="text" id="studentID" class="form-input" value="<?php echo $caseDetails['StudentID']; ?>" readonly>
                </div>

                <div class="form-section">
                    <label class="form-label" for="sanction">Sanction</label>
                    <input type="text" id="sanction" class="form-input" value="<?php echo $caseDetails['Sanction']; ?>" readonly>
                </div>

                <div class="form-section full-width">
                    <label class="form-label" for="offense">Offense</label>
                    <textarea id="offense" class="form-textarea" readonly><?php echo $caseDetails['Offense']; ?></textarea>
                </div>

                <div class="form-section">
                    <label class="form-label" for="startDate">Suspension Start Date</label>
                    <input type="date" id="startDate" name="startDate" class="form-input" value="<?php echo $caseDetails['StartDate']; ?>" readonly>
                </div>

                <div class="form-section">
                    <label class="form-label" for="endDate">Suspension End Date</label>
                    <input type="date" id="endDate" name="endDate" class="form-input" value="<?php echo $caseDetails['EndDate']; ?>" readonly>
                </div>

                <div class="form-section">
                    <label class="form-label" for="liftLetter">Lift Letter</label>
                    <?php if (!empty($caseDetails['LiftLetter'])): ?>
                        <a href="<?php echo $caseDetails['LiftLetter']; ?>" class="attachment" target="_blank">View Attachment</a>
                    <?php else: ?>
                        <span class="no-attachment">No attachment available</span>
                    <?php endif; ?>
                </div>

                <div class="form-section">
                    <label class="form-label" for="startLetter">Letter for Starting Suspension</label>
                    <?php if (!empty($caseDetails['StartLetter'])): ?>
                        <a href="<?php echo $caseDetails['StartLetter']; ?>" class="attachment" target="_blank">View Attachment</a>
                    <?php else: ?>
                        <span class="no-attachment">No attachment available</span>
                    <?php endif; ?>
                </div>
            </div>

            
        </form>
    </div>
</div>