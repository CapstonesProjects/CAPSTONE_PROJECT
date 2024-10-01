<!-- Modals -->
<template x-for="caseItem in cases" :key="caseItem.CaseID">
    <div class="modal fade" :id="'ViewCasesModal' + caseItem.CaseID" tabindex="-1" :aria-labelledby="'ViewCaseModalLabel' + caseItem.CaseID" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex">
                    <h5 class="modal-title me-5" :id="'ViewCasesModalLabel' + caseItem.CaseID">
                        <span class="font-bold">Cases for Student ID:</span> <span x-text="caseItem.StudentID" class="text-red-500"></span>
                    </h5>
                    <h5 class="modal-title" :id="'ViewCasesModalLabel' + caseItem.CaseID">
                        <span class="font-bold">Cases ID:</span> <span x-text="caseItem.CaseID" class="text-red-500"></span>
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
                    <div class="flex justify-center" style="margin-top: -14%;">
                        <form action="../phpfiles/update_case_status.php" method="POST" @submit="confirmAndDisableButton($event)">
                            <input type="hidden" name="caseID" :value="caseItem.CaseID">
                            <button
                                type="submit"
                                :class="{
                'bg-green-500 hover:bg-green-600': caseItem.Status !== 'Resolved',
                'bg-gray-500 cursor-not-allowed': caseItem.Status === 'Resolved'
            }"
                                class="text-white px-4 py-2 rounded-md flex items-center"
                                :disabled="caseItem.Status === 'Resolved'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span x-text="caseItem.Status === 'Resolved' ? 'Resolved' : 'Mark as Resolved'"></span>
                            </button>
                        </form>
                    </div>
                    <!-- <div class="modal-footer">
                        
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Confirmation Modal -->
<div x-data="{ showModal: false }" x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
    <div class="bg-white p-6 rounded-lg">
        <h2 class="text-lg font-bold mb-4">Confirm Action</h2>
        <form @submit.prevent="confirmAction">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" x-model="username" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" x-model="password" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="flex justify-end">
                <button type="button" @click="showModal = false" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Confirm</button>
            </div>
        </form>
    </div>
</div>

<script>
    function disableButton(event) {
        event.target.querySelector('button[type="submit"]').disabled = true;
    }

    function confirmAndDisableButton(event) {
        if (!confirm('Are you sure you want to mark this case as resolved?')) {
            event.preventDefault();
            return;
        }
        event.target.querySelector('button[type="submit"]').disabled = true;
    }
</script>