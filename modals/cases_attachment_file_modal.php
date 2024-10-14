<?php
include('../config/db_connection.php');

$query = "SELECT * FROM tblcases";
$result = mysqli_query($conn, $query);

$cases = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cases[] = $row;
}

mysqli_close($conn);
?>

<style>
    .modal-5xl {
    max-width: 70%; 
}
</style>

<!-- Modals -->
<?php foreach ($cases as $caseItem): ?>
    <div class="modal fade" id="CaseAttachmentFileModal<?php echo $caseItem['CaseID']; ?>" tabindex="-1" aria-labelledby="CaseAttachmentFileModalLabel<?php echo $caseItem['CaseID']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-5xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-row gap-5">
                        <h5 class="modal-title" id="CaseAttachmentFileModalLabel<?php echo $caseItem['CaseID']; ?>">
                            <span class="font-weight-bold text-sm">Resolution for Case ID:</span> <span class="text-primary"><?php echo htmlspecialchars($caseItem['CaseID']); ?></span>
                        </h5>
                        <h5 class="modal-title" id="CaseAttachmentFileModalLabel<?php echo $caseItem['CaseID']; ?>">
                            <span class="font-weight-bold text-sm">Resolution for Student ID:</span> <span class="text-primary"><?php echo htmlspecialchars($caseItem['StudentID']); ?></span>
                        </h5>
                        <h5 class="modal-title" id="CaseAttachmentFileModalLabel<?php echo $caseItem['CaseID']; ?>">
                            <span class="font-weight-bold text-sm">Sanction:</span> <span class="text-primary"><?php echo htmlspecialchars($caseItem['Sanction']); ?></span>
                        </h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg></button>
                </div>
                <div class="modal-body">

                    <form action="../phpfiles/update_case_resolution.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="caseID" value="<?php echo htmlspecialchars($caseItem['CaseID']); ?>">

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Attach Resolution File:</label>
                            <input type="file" name="resolutionAttachment" class="w-full px-3 py-2 border border-gray-300 rounded-md" accept=".pdf" required>
                        </div>

                        <?php if ($caseItem['Sanction'] == 'Second offense - Written reprimand'): ?>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Attach Written Reprimand File:</label>
                            <input type="file" name="writtenReprimandAttachment" class="w-full px-3 py-2 border border-gray-300 rounded-md" accept=".pdf" required>
                        </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Case Resolution:</label>
                            <select name="caseResolution" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                <option value="" disabled selected>Select resolution</option>
                                <optgroup label="Minor Offenses">
                                    <option value="Resolved - Verbal Reprimand">Resolved - Verbal Reprimand or Censure</option>
                                    <option value="Resolved - Written Reprimand">Resolved - Written Reprimand</option>
                                    <option value="Resolved - Parent Conference">Resolved - Parent/Guardian Conference</option>
                                    <option value="Resolved - Suspension">Resolved - Suspension for a Prescribed Period</option>
                                    <option value="Resolved - Suspension">Resolved - Qualifies for a Major Offense</option>
                                </optgroup>
                                <optgroup label="Major Offenses">
                                    <option value="Resolved - Suspension 5 Days">Resolved - Suspension for a Period of Not Less Than Five Days</option>
                                    <option value="Resolved - Suspension 1-2 Weeks">Resolved - Suspension for a Period of 1 - 2 Weeks</option>
                                    <option value="Resolved - Suspension 1 Semester">Resolved - Suspension for One Semester</option>
                                    <option value="Resolved - Exclusion or Immediate Dismissal">Resolved - Exclusion or Immediate Dismissal and Non-Admission in Lyceum of Alabang</option>
                                </optgroup>
                                <option value="Resolved - Dismissed (Lack of Evidence)">Resolved - Dismissed (Lack of Evidence)</option>
                                <option value="Resolved - Complainant Canceled">Resolved - Complainant Canceled</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Remarks:</label>
                            <textarea name="remarks" class="w-full px-3 py-2 border border-gray-300 rounded-md" rows="4" required></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>