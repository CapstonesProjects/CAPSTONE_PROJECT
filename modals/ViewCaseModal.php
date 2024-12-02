<?php
include('../config/db_connection.php');

// Fetch data from tblcases
$query = "SELECT * FROM tblcases";
$result = mysqli_query($conn, $query);

$cases = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cases[] = $row;
}

mysqli_close($conn);
?>

<style>
    .modaly {
        width: 100%;
        max-width: 90%;
    }
</style>

<!-- Modals -->
<?php foreach ($cases as $caseItem): ?>
    <div class="modal fade" id="ViewCasesModal<?php echo $caseItem['CaseID']; ?>" tabindex="-1" aria-labelledby="ViewCaseModalLabel<?php echo $caseItem['CaseID']; ?>" aria-hidden="true">
        <div class="modal-dialog  modaly modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex">
                    <h5 class="modal-title me-5" id="ViewCasesModalLabel<?php echo $caseItem['CaseID']; ?>">
                        <span class="font-bold">Cases for Student ID:</span> <span class="text-red-500"><?php echo htmlspecialchars($caseItem['StudentID']); ?></span>
                    </h5>
                    <h5 class="modal-title" id="ViewCasesModalLabel<?php echo $caseItem['CaseID']; ?>">
                        <span class="font-bold">Cases ID:</span> <span class="text-red-500"><?php echo htmlspecialchars($caseItem['CaseID']); ?></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg></button>
                </div>
                <div class="modal-body">
                    <div class="container mx-auto p-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['FullName']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['Email']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Offense:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['Offense']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Offense Category:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['OffenseCategory']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Sanction:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['Sanction']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Complainant:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['Complainant']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['Status']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['FiledDate']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Complainant Number:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['ComplainantNumber']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Affiliation:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['Affiliation']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">School Year:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['SchoolYear']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Semester:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['Semester']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Filed By:</label>
                                <input type="text" value="<?php echo htmlspecialchars($caseItem['FiledBy']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Report Attachment:</label>
                                <?php if ($caseItem['ReportAttachment']): ?>
                                    <a href="<?php echo htmlspecialchars($caseItem['ReportAttachment']); ?>" target="_blank" class="text-blue-500 hover:underline">View</a>
                                <?php else: ?>
                                    <span class="text-red-500">No file available</span>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Written Reprimand Attachment:</label>
                                <?php if ($caseItem['WrittenReprimandAttachment']): ?>
                                    <a href="<?php echo htmlspecialchars($caseItem['WrittenReprimandAttachment']); ?>" target="_blank" class="text-blue-500 hover:underline">View</a>
                                <?php else: ?>
                                    <span class="text-red-500">No file available</span>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Resolution Attachment:</label>
                                <?php if ($caseItem['ResolutionAttachment']): ?>
                                    <a href="<?php echo htmlspecialchars($caseItem['ResolutionAttachment']); ?>" target="_blank" class="text-blue-500 hover:underline">View</a>
                                <?php else: ?>
                                    <span class="text-red-500">No file available</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="flex justify-center" style="margin-top: -5%;">
                        <form action="../phpfiles/update_case_status.php" method="POST" onsubmit="return confirmAndDisableButton(event);">
                            <input type="hidden" name="caseID" value="<?php echo htmlspecialchars($caseItem['CaseID']); ?>">
                            <button
                                type="submit"
                                class="text-white px-4 py-2 rounded-md flex items-center <?php echo $caseItem['Status'] !== 'Resolved' ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-500 cursor-not-allowed'; ?>"
                                <?php echo $caseItem['Status'] === 'Resolved' ? 'disabled' : ''; ?>>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a 1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span><?php echo $caseItem['Status'] === 'Resolved' ? 'Resolved' : 'Mark as Resolved'; ?></span>
                            </button>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Confirmation Modal -->


<script>
    function confirmAndDisableButton(event) {
        if (!confirm('Are you sure you want to mark this case as resolved?')) {
            event.preventDefault();
            return false;
        }
        event.target.querySelector('button[type="submit"]').disabled = true;
        return true;
    }

    function closeModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }

    document.getElementById('confirmationForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Handle form submission logic here
        closeModal();
    });
</script>