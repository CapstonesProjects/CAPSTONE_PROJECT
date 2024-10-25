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
    <!-- <h1 class="text-3xl font-bold mb-4 text-center">My Cases</h1> -->
    <div class="flex justify-center">
        <div class="flex-1 bg-white rounded-lg p-8 mx-auto" style="max-width: 1570px; width: 1580px; height: 870px;">
            <div class="overflow-auto max-h-full">
                <?php foreach ($cases as $case): ?>
                    <div class="border-b border-gray-300 pb-4 mb-6">
                        <h4 class="text-2xl text-gray-900 font-bold mb-4">Case ID: <?php echo htmlspecialchars($case['CaseID']); ?></h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Offense:</label>
                                <input type="text" value="<?php echo htmlspecialchars($case['Offense']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                                <input type="text" value="<?php echo htmlspecialchars($case['OffenseCategory']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                                <input type="text" value="<?php echo htmlspecialchars($case['Status']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed <?php echo strtolower($case['Status']) === 'resolved' ? 'text-green-500' : (strtolower($case['Status']) === 'ongoing' ? 'text-yellow-500' : 'text-red-500'); ?>" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Filed Date:</label>
                                <input type="text" value="<?php echo htmlspecialchars($case['FiledDate']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Sanction:</label>
                                <input type="text" value="<?php echo htmlspecialchars($case['Sanction']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Complainant:</label>
                                <input type="text" value="<?php echo htmlspecialchars($case['Complainant']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Complainant Number:</label>
                                <input type="text" value="<?php echo htmlspecialchars($case['ComplainantNumber']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Affiliation:</label>
                                <input type="text" value="<?php echo htmlspecialchars($case['Affiliation']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">School Year:</label>
                                <input type="text" value="<?php echo htmlspecialchars($case['SchoolYear']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Filed By:</label>
                                <input type="text" value="<?php echo htmlspecialchars($case['FiledBy']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                        </div>
                        <!-- <div class="mt-4">
                            <?php if (!empty($case['ReportAttachment'])): ?>
                                <a href="<?php echo htmlspecialchars($case['ReportAttachment']); ?>" target="_blank" class="text-blue-500 hover:underline flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 12a1 1 0 01.117 1.993L8 14H4a1 1 0 01-.117-1.993L4 12h4zm8-4a1 1 0 01.117 1.993L16 10H4a1 1 0 01-.117-1.993L4 8h12zm0-4a1 1 0 01.117 1.993L16 6H4a1 1 0 01-.117-1.993L4 4h12z"></path>
                                    </svg>
                                    View Report Attachment
                                </a>
                            <?php else: ?>
                                <p class="text-red-500">No Report Attachment available</p>
                            <?php endif; ?>
                        </div>
                        <div class="mt-2">
                            <?php if (!empty($case['WrittenReprimandAttachment'])): ?>
                                <a href="<?php echo htmlspecialchars($case['WrittenReprimandAttachment']); ?>" target="_blank" class="text-blue-500 hover:underline flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 12a1 1 0 01.117 1.993L8 14H4a1 1 0 01-.117-1.993L4 12h4zm8-4a1 1 0 01.117 1.993L16 10H4a1 1 0 01-.117-1.993L4 8h12zm0-4a1 1 0 01.117 1.993L16 6H4a1 1 0 01-.117-1.993L4 4h12z"></path>
                                    </svg>
                                    View Written Reprimand Attachment
                                </a>
                            <?php else: ?>
                                <p class="text-red-500">No Written Reprimand Attachment available</p>
                            <?php endif; ?>
                        </div>
                        <div class="mt-2">
                            <?php if (!empty($case['SanctionLetterAttachment'])): ?>
                                <a href="<?php echo htmlspecialchars($case['SanctionLetterAttachment']); ?>" target="_blank" class="text-blue-500 hover:underline flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 12a1 1 0 01.117 1.993L8 14H4a1 1 0 01-.117-1.993L4 12h4zm8-4a1 1 0 01.117 1.993L16 10H4a1 1 0 01-.117-1.993L4 8h12zm0-4a1 1 0 01.117 1.993L16 6H4a1 1 0 01-.117-1.993L4 4h12z"></path>
                                    </svg>
                                    View Sanction Letter Attachment
                                </a>
                            <?php else: ?>
                                <p class="text-red-500">No Sanction Letter Attachment available</p>
                            <?php endif; ?>
                        </div> -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>