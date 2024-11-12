<?php
include('../config/db_connection.php');

$studentID = $_SESSION['StudentID'];

$query = "SELECT * FROM tblcases WHERE StudentID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $studentID);
$stmt->execute();
$result = $stmt->get_result();

$cases = [];
while ($row = $result->fetch_assoc()) {
    $cases[] = $row;
}
?>

<div class="container mx-auto p-4 m-0 ml-8">
    <div class="flex justify-center">
        <!-- <div class="flex-1 bg-white rounded-lg p-8 mx-auto shadow-lg" style="max-width: 1570px; width: 1580px; height: 870px;"> -->
            <div id="full-container" class="overflow-x-hidden" style="height: 100vh; justify-content: center; align-items: center; padding-top: 10px; padding-bottom: 110px;">
                <div class="tbl-lbl">
                <table class=" max-w-full bg-white border border-gray-300 shadow-lg rounded-lg">
                    <thead class=" text-white" style="background: teal;">
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-semibold">Case ID</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-semibold">Offense</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-semibold">Status</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-semibold">Filed Date</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-semibold">Filed By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cases as $case): ?>
                            <tr class="cursor-pointer hover:bg-gray-200" data-case='<?php echo json_encode($case); ?>'>
                                <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($case['CaseID']); ?></td>
                                <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($case['Offense']); ?></td>
                                <td class="py-2 px-4 border-b border-gray-300 <?php echo strtolower($case['Status']) === 'resolved' ? 'text-green-500' : (strtolower($case['Status']) === 'ongoing' ? 'text-yellow-500' : 'text-red-500'); ?>"><?php echo htmlspecialchars($case['Status']); ?></td>
                                <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($case['FiledDate']); ?></td>
                                <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($case['FiledBy']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        <!-- </div> -->
    </div>
</div>

<!-- Modal for Case Details -->
<div id="case-details-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
    <div id="modal-container" class="relative top-20 mx-auto p-5 border w-1/2  rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="case-id"></h3>
            <div class="mt-2">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Offense:</label>
                        <input type="text" id="case-offense" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                        <input type="text" id="case-category" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                        <input type="text" id="case-status" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Filed Date:</label>
                        <input type="text" id="case-filed-date" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Sanction:</label>
                        <input type="text" id="case-sanction" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Complainant:</label>
                        <input type="text" id="case-complainant" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Complainant Number:</label>
                        <input type="text" id="case-complainant-number" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Affiliation:</label>
                        <input type="text" id="case-affiliation" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">School Year:</label>
                        <input type="text" id="case-school-year" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Filed By:</label>
                        <input type="text" id="case-filed-by" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button id="close-modal" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const caseRows = document.querySelectorAll('tr[data-case]');
    const modal = document.getElementById('case-details-modal');
    const closeModal = document.getElementById('close-modal');

    caseRows.forEach(row => {
        row.addEventListener('click', function() {
            const caseData = JSON.parse(this.getAttribute('data-case'));

            document.getElementById('case-id').textContent = 'Case ID: ' + caseData.CaseID;
            document.getElementById('case-offense').value = caseData.Offense;
            document.getElementById('case-category').value = caseData.OffenseCategory;
            document.getElementById('case-status').value = caseData.Status;
            document.getElementById('case-filed-date').value = caseData.FiledDate;
            document.getElementById('case-sanction').value = caseData.Sanction;
            document.getElementById('case-complainant').value = caseData.Complainant;
            document.getElementById('case-complainant-number').value = caseData.ComplainantNumber;
            document.getElementById('case-affiliation').value = caseData.Affiliation;
            document.getElementById('case-school-year').value = caseData.SchoolYear;
            document.getElementById('case-filed-by').value = caseData.FiledBy;

            modal.style.display = 'block';
        });
    });

    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });
});
</script>