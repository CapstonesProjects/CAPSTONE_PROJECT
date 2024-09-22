<!-- Modals -->
<template x-for="caseItem in cases" :key="caseItem.CaseID">
    <div class="modal fade" :id="'ViewCasesModal' + caseItem.CaseID" tabindex="-1" :aria-labelledby="'ViewCaseModalLabel' + caseItem.CaseID" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :id="'ViewCasesModalLabel' + caseItem.CaseID">
                        Cases for Student ID: <span x-text="caseItem.StudentID"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mx-auto p-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                                <input type="text" x-bind:value="caseItem.FullName" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                <input type="text" x-bind:value="caseItem.Email" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Offense:</label>
                                <input type="text" x-bind:value="caseItem.Offense" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Offense Category:</label>
                                <input type="text" x-bind:value="caseItem.OffenseCategory" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Sanction:</label>
                                <input type="text" x-bind:value="caseItem.Sanction" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Complainant:</label>
                                <input type="text" x-bind:value="caseItem.Complainant" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                                <input type="text" x-bind:value="caseItem.Status" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
                                <input type="text" x-bind:value="caseItem.Date" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Complainant Number:</label>
                                <input type="text" x-bind:value="caseItem.ComplainantNumber" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Affiliation:</label>
                                <input type="text" x-bind:value="caseItem.Affiliation" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">School Year:</label>
                                <input type="text" x-bind:value="caseItem.SchoolYear" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Filed By:</label>
                                <input type="text" x-bind:value="caseItem.FiledBy" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Report Attachment:</label>
                                <template x-if="caseItem.ReportAttachment">
                                    <a :href="caseItem.ReportAttachment" target="_blank" class="text-blue-500 hover:underline">View</a>
                                </template>
                                <template x-if="!caseItem.ReportAttachment">
                                    <span class="text-red-500">No file available</span>
                                </template>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Written Reprimand Attachment:</label>
                                <template x-if="caseItem.WrittenReprimandAttachment">
                                    <a :href="caseItem.WrittenReprimandAttachment" target="_blank" class="text-blue-500 hover:underline">View</a>
                                </template>
                                <template x-if="!caseItem.WrittenReprimandAttachment">
                                    <span class="text-red-500">No file available</span>
                                </template>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Sanction Letter Attachment:</label>
                                <template x-if="caseItem.SanctionLetterAttachment">
                                    <a :href="caseItem.SanctionLetterAttachment" target="_blank" class="text-blue-500 hover:underline">View</a>
                                </template>
                                <template x-if="!caseItem.SanctionLetterAttachment">
                                    <span class="text-red-500">No file available</span>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>