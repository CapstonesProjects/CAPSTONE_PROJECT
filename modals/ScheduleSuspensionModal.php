<div class="modal fade" id="scheduleSuspensionModal<?php echo $caseItem['CaseID']; ?>" tabindex="-1" aria-labelledby="scheduleSuspensionModalLabel<?php echo $caseItem['CaseID']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white rounded-lg shadow-lg">
            <div class="modal-header flex items-center justify-between p-4 border-b border-gray-200 bg-gray-100">
                <h5 class="modal-title text-lg font-semibold" id="scheduleSuspensionModalLabel<?php echo $caseItem['CaseID']; ?>">Schedule Suspension</h5>
                <button type="button" class="btn-close text-gray-400 hover:text-gray-500" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-6">
                <form action="../phpfiles/Monitoring.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="caseID" value="<?php echo htmlspecialchars($caseItem['CaseID']); ?>">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="form-section mb-4">
                            <label class="form-label block text-sm font-medium text-gray-700" for="startDate">Suspension Start Date</label>
                            <input type="date" id="startDate" name="startDate" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="<?php echo isset($suspensionDetails['StartDate']) ? $suspensionDetails['StartDate'] : ''; ?>">
                        </div>

                        <div class="form-section mb-4">
                            <label class="form-label block text-sm font-medium text-gray-700" for="endDate">Suspension End Date</label>
                            <input type="date" id="endDate" name="endDate" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="<?php echo isset($suspensionDetails['EndDate']) ? $suspensionDetails['EndDate'] : ''; ?>">
                        </div>

                        <div class="form-section mb-4">
                            <label class="form-label block text-sm font-medium text-gray-700" for="startLetter">Letter for Starting Suspension</label>
                            <input type="file" id="startLetter" name="startLetter" class="form-file mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                    </div>

                    <div class="modal-footer mt-4 flex justify-end space-x-2 p-4 border-t border-gray-200 bg-gray-100">
                        <button type="button" class="btn btn-secondary bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>