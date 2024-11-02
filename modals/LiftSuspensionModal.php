<div class="modal fade" id="liftSuspensionModal<?php echo $caseItem['CaseID']; ?>" tabindex="-1" aria-labelledby="liftSuspensionModalLabel<?php echo $caseItem['CaseID']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white rounded-lg shadow-lg">
            <div class="modal-header flex items-center justify-between p-4 border-b border-gray-200 bg-gray-100">
                <h5 class="modal-title text-lg font-semibold text-gray-800" id="liftSuspensionModalLabel<?php echo $caseItem['CaseID']; ?>">Lift Suspension</h5>
                <button type="button" class="btn-close text-gray-400 hover:text-gray-500" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-6">
                <form action="../phpfiles/Lifting.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="caseID" value="<?php echo htmlspecialchars($caseItem['CaseID']); ?>">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="form-section mb-4">
                            <label class="form-label block text-sm font-medium text-gray-700" for="liftingLetter">Lifting Suspension Letter</label>
                            <input type="file" id="liftingLetter" name="liftingLetter" class="form-file mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="form-section mb-4">
                            <label class="form-label block text-sm font-medium text-gray-700" for="liftingRemark">Lifting Remark</label>
                            <textarea id="liftingRemark" name="liftingRemark" class="form-textarea mt-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4" placeholder="Enter your remarks here..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer mt-4 flex justify-end space-x-2 p-4 border-t border-gray-200 bg-gray-100">
                        <button type="button" class="btn btn-secondary bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>