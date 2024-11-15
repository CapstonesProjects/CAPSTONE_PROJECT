<style>
    /* Adjust the width of the dropdown */
    #offense {
        width: 100%;
        /* Make the dropdown take full width of its container */
        max-width: 100%;
        /* Set a maximum width */
        white-space: normal;
        /* Enable text wrapping */
    }

    /* Optional: Adjust the width for individual options */
    #offense option {
        white-space: normal;
        /* Wrap text in options */
        word-wrap: break-word;
        /* Break long words to avoid overflow */
    }

    .modal-5xl {
        max-width: 95%;
        max-height: 90%;
    }
</style>



<div class="modal fade" id="AddCasesModal" tabindex="-1" aria-labelledby="AddCasesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-5xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddCasesModalLabel">New Case</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                        <path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path>
                    </svg></button>
            </div>
            <div class="modal-body">
                <form id="addCaseForm" action="../phpfiles/add_case.php" method="POST" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="mb-3">
                            <label for="studentId" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="studentId" name="StudentID" required>
                        </div>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control bg-gray-200 text-black cursor-not-allowed" id="fullName" name="FullName" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control bg-gray-200 text-black cursor-not-allowed" id="email" name="Email" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="Offense" class="form-label">Offense</label>
                            <select class="form-select " id="offense" name="Offense" required>
                                <option selected disabled value="">Choose...</option>
                                <!-- Minor Offenses Group -->
                                <optgroup label="Minor Offenses">
                                    <option value="Noncompliance of Academic Requirements - Attendance (exceeded allowable absences)">
                                        1.1 Noncompliance of Academic Requirements - Attendance (exceeded allowable absences)
                                    </option>
                                    <option value="Noncompliance of Academic Requirements - Habitual tardiness">
                                        1.2 Noncompliance of Academic Requirements - Habitual tardiness
                                    </option>
                                    <option value="Noncompliance of Academic Requirements - Truancy or cutting classes">
                                        1.3 Noncompliance of Academic Requirements - Truancy or cutting classes
                                    </option>
                                    <option value="Attitude inside the Classroom - Classroom mischief, failure to turn off or put on silent the mobile phone">
                                        2.1 Attitude inside the Classroom - Classroom mischief, failure to turn off or put on silent the mobile phone
                                    </option>
                                    <option value="Attitude inside the Classroom - Disturbing other classes/activities through excessive noise">
                                        2.2 Attitude inside the Classroom - Disturbing other classes/activities through excessive noise
                                    </option>
                                    <option value="Attitude inside the Classroom - Littering">
                                        2.3 Attitude inside the Classroom - Littering
                                    </option>
                                    <option value="Behavior in Campus - Engaging in bullying">
                                        3.1 Behavior in Campus - Engaging in bullying
                                    </option>
                                    <option value="Behavior in Campus - Not wearing the prescribed uniform">
                                        3.2 Behavior in Campus - Not wearing the prescribed uniform
                                    </option>
                                    <option value="Behavior in Campus - Violation on ID - Improper wearing of ID">
                                        3.3.1 Behavior in Campus - Violation on ID - Improper wearing of ID
                                    </option>
                                    <option value="Behavior in Campus - Violation on ID - Tampering with ID">
                                        3.3.2 Behavior in Campus - Violation on ID - Tampering with ID
                                    </option>
                                    <option value="Behavior in Campus - Violation on ID - Wearing someone else's ID">
                                        3.3.3 Behavior in Campus - Violation on ID - Wearing someone else's ID
                                    </option>
                                    <option value="Behavior in Campus - Violation on ID - Lending one's ID">
                                        3.3.4 Behavior in Campus - Violation on ID - Lending one's ID
                                    </option>
                                    <option value="Behavior in Campus - With a cap/hat inside the classroom or school premises">
                                        3.4 Behavior in Campus - With a cap/hat inside the classroom or school premises
                                    </option>
                                    <option value="Behavior in Campus - Exposed tattoos">
                                        3.5 Behavior in Campus - Exposed tattoos
                                    </option>
                                    <option value="Behavior in Campus - Piercings other than the ear lobes">
                                        3.6 Behavior in Campus - Piercings other than the ear lobes
                                    </option>
                                    <option value="Behavior in Campus - Unauthorized use or charging of electric devices or gadgets">
                                        3.7 Behavior in Campus - Unauthorized use or charging of electric devices or gadgets
                                    </option>
                                    <option value="Behavior in Campus - Students disrupting classes, school/institutional activities">
                                        3.8 Behavior in Campus - Students disrupting classes, school/institutional activities
                                    </option>
                                    <option value="Behavior in Campus - Posting/Publishing unauthorized announcements">
                                        3.9 Behavior in Campus - Posting/Publishing unauthorized announcements
                                    </option>
                                    <option value="Behavior in Campus - Inflicting harm physically, mentally, and emotionally on other person">
                                        3.10 Behavior in Campus - Inflicting harm physically, mentally, and emotionally on other person
                                    </option>
                                    <option value="Behavior in Campus - Unauthorized use of LOA premises or facilities">
                                        3.11 Behavior in Campus - Unauthorized use of LOA premises or facilities
                                    </option>
                                    <option value="Behavior in Campus - Spitting on floors/walls">
                                        3.12 Behavior in Campus - Spitting on floors/walls
                                    </option>
                                    <option value="Behavior in Campus - Littering">
                                        3.13 Behavior in Campus - Littering
                                    </option>
                                    <option value="Behavior in Campus - Loitering or staying in restricted areas">
                                        3.14 Behavior in Campus - Loitering or staying in restricted areas
                                    </option>
                                </optgroup>

                                <!-- Major Offenses Group -->
                                <optgroup label="Major Offenses">
                                    <!-- Major Offenses -->
                                    <option value="Violation with Legal Implications - Possession use, or sale of illegal drugs (RA 9165) inside the school premises and entering the school while intoxicated">1.1 Violation with Legal Implications - Possession use, or sale of illegal drugs (RA 9165) inside the school premises and entering the school while intoxicated</option>
                                    <option value="Violation with Legal Implications - Possession, use, or sale of cigarettes (RA 9211) / e-cigarettes (Vape). Possession of alcoholic beverages or reporting inside the campus while intoxicated">1.2 Violation with Legal Implications - Possession, use, or sale of cigarettes (RA 9211) / e-cigarettes (Vape). Possession of alcoholic beverages or reporting inside the campus while intoxicated</option>
                                    <option value="Violation with Legal Implications - Smoking within the school premises or approved off-campus activities (100 meters from perimeter to any point, RA 9211)">1.3 Violation with Legal Implications - Smoking within the school premises or approved off-campus activities (100 meters from perimeter to any point, RA 9211)</option>
                                    <option value="Violation with Legal Implications - Possession/carrying or use of firearms, explosives, knives, or weapons that can cause harm (Presidential Decree No. 1866)">1.4 Violation with Legal Implications - Possession/carrying or use of firearms, explosives, knives, or weapons that can cause harm (Presidential Decree No. 1866)</option>
                                    <option value="Violation with Legal Implications - Use of the Internet or social media to malign fellow students or persons in authority (Cyberbullying, RA 10175)">1.5 Violation with Legal Implications - Use of the Internet or social media to malign fellow students or persons in authority (Cyberbullying, RA 10175)</option>
                                    <option value="Violation with Legal Implications - Violation of RA 7877 (Anti-sexual Harassment)">1.6 Violation with Legal Implications - Violation of RA 7877 (Anti-sexual Harassment)</option>
                                    <option value="Violation with Legal Implications - Violation of RA 9995 (Anti-Photo and Video Voyeurism Act of 2009)">1.7 Violation with Legal Implications - Violation of RA 9995 (Anti-Photo and Video Voyeurism Act of 2009)</option>
                                    <option value="Violation with Legal Implications - Violation of Article 364 of the Revised Penal Code (Intriguing against honor)">1.8 Violation with Legal Implications - Violation of Article 364 of the Revised Penal Code (Intriguing against honor)</option>
                                    <option value="Violation with Legal Implications - Violation of Article 172 of the Revised Penal Code (Falsification of Documents)">1.9 Violation with Legal Implications - Violation of Article 172 of the Revised Penal Code (Falsification of Documents)</option>
                                    <option value="Violation with Legal Implications - Violation of RA 10627 (Anti-Bullying Act)">1.10 Violation with Legal Implications - Violation of RA 10627 (Anti-Bullying Act)</option>
                                    <option value="Violation with Legal Implications - Violation of the Criminal Code of the Philippines (Threatening, assaulting, or challenging others)">1.11 Violation with Legal Implications - Violation of the Criminal Code of the Philippines (Threatening, assaulting, or challenging others)</option>
                                    <option value="Violation with Legal Implications - Violation of RA 8049 (Anti-Hazing Act)">1.12 Violation with Legal Implications - Violation of RA 8049 (Anti-Hazing Act)</option>

                                    <!-- Indecency in Campus -->
                                    <option value="Indecency in Campus - Explicit sexual exposure using devices or social media (pornographic material)">2.1 Indecency in Campus - Explicit sexual exposure using devices or social media (pornographic material)</option>
                                    <option value="Indecency in Campus - Public display of affection (PDA) or immoral acts such as petting and necking">2.2 Indecency in Campus - Public display of affection (PDA) or immoral acts such as petting and necking</option>
                                    <option value="Indecency in Campus - Affiliation with fraternities, sororities, gangs, or unauthorized organizations">2.3 Indecency in Campus - Affiliation with fraternities, sororities, gangs, or unauthorized organizations</option>
                                    <option value="Indecency in Campus - Gambling in any form within the school premises">2.4 Indecency in Campus - Gambling in any form within the school premises</option>
                                    <option value="Indecency in Campus - Vandalism or marking on walls, chairs, tables, or any school property">2.5 Indecency in Campus - Vandalism or marking on walls, chairs, tables, or any school property</option>
                                    <option value="Indecency in Campus - Distribution of provocative materials (e.g., pornographic or subversive)">2.6 Indecency in Campus - Distribution of provocative materials (e.g., pornographic or subversive)</option>

                                    <!-- Misconduct in Lyceum Campus -->
                                    <option value="Misconduct in Lyceum Campus - Instigating or leading protests resulting in class disruption">3.1 Misconduct in Lyceum Campus - Instigating or leading protests resulting in class disruption</option>
                                    <option value="Misconduct in Lyceum Campus - Cheating, copying, or allowing copying of exams, projects, or papers">3.2 Misconduct in Lyceum Campus - Cheating, copying, or allowing copying of exams, projects, or papers</option>
                                    <option value="Misconduct in Lyceum Campus - Preempting and disseminating confidential information (e.g., grades or awards)">3.3 Misconduct in Lyceum Campus - Preempting and disseminating confidential information (e.g., grades or awards)</option>
                                    <option value="Misconduct in Lyceum Campus - Disregarding school rules, such as speeding or not following parking procedures">3.4 Misconduct in Lyceum Campus - Disregarding school rules, such as speeding or not following parking procedures</option>
                                    <option value="Misconduct in Lyceum Campus - Soliciting money or donations without prior approval">3.5 Misconduct in Lyceum Campus - Soliciting money or donations without prior approval</option>
                                    <option value="Misconduct in Lyceum Campus - Use of profane or obscene language; disrespectful language">3.6 Misconduct in Lyceum Campus - Use of profane or obscene language; disrespectful language</option>
                                    <option value="Misconduct in Lyceum Campus - False accusation against the Administration or staff through conspiracy or other means">3.7 Misconduct in Lyceum Campus - False accusation against the Administration or staff through conspiracy or other means</option>

                                    <!-- Violation Committed by a Representative of the Student -->
                                    <option value="Violation by Representative - Misbehavior of representatives such as parents or guardians (e.g., raising voice, taunting, or carrying weapons)">4.1 Violation by Representative - Misbehavior of representatives such as parents or guardians (e.g., raising voice, taunting, or carrying weapons)</option>
                                    <option value="Violation by Representative - Sending threatening or harassing messages to LOA employees">4.2 Violation by Representative - Sending threatening or harassing messages to LOA employees</option>
                                    <option value="Violation by Representative - Physically abusive behavior toward LOA personnel or students">4.3 Violation by Representative - Physically abusive behavior toward LOA personnel or students</option>
                                    <option value="Violation by Representative - Causing damage to LOA properties or moral harm to staff or institution image">4.4 Violation by Representative - Causing damage to LOA properties or moral harm to staff or institution image</option>

                                </optgroup>
                            </select>
                            <div id="offenseCount" class="text-green-600 mt-2"></div>
                            <div id="sanction" class="text-red-600 mt-2"></div>
                            <input type="hidden" id="sanctionInput" name="Sanction">
                        </div>

                        <div class="mb-3">
                            <label for="offenseCategory" class="form-label">Category of Offense</label>
                            <input type="text" class="form-control bg-gray-200 text-black cursor-not-allowed " id="offenseCategory" name="OffenseCategory" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="Complainant" class="form-label">Complainant Name</label>
                            <input type="text" class="form-control" id="complainant" name="Complainant" required>
                        </div>
                        <div class="mb-3">
                            <label for="ComplainantNumber" class="form-label">Complainant Phone Number</label>
                            <input type="text" class="form-control" id="complainantnumber" name="ComplainantNumber" required>
                        </div>

                        <div class="mb-3">
                            <label for="Affiliation" class="form-label">LOA Affiliation</label>
                            <input type="text" class="form-control" id="affiliation" placeholder="(e.g. Student/Faculty/Staff/Community Member)" name="Affiliation" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control bg-gray-200 text-black cursor-not-allowed" id="status" name="Status" value="Ongoing" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="FiledDate" class="form-label">Filed Date</label>
                            <input type="date" class="form-control bg-gray-200 text-black cursor-not-allowed" id="fileddate" name="FiledDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="schoolYear" class="form-label">School Year</label>
                            <input type="text" class="form-control bg-gray-200 text-black cursor-not-allowed" id="schoolYear" name="SchoolYear" value="<?php echo $current_school_year; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="Semester" class="form-label">Semester</label>
                            <input type="text" class="form-control bg-gray-200 text-black cursor-not-allowed" id="semester" name="semester" value="<?php echo $current_semester; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="FiledBy" class="form-label">Filed By</label>
                            <input type="text" class="form-control bg-gray-200 text-black cursor-not-allowed" id="filedby" name="FiledBy" readonly value="<?php echo $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="reportAttachment" class="form-label">Report Attachment</label>
                            <input type="file" class="form-control" id="reportAttachment" name="ReportAttachment" accept=".pdf" required>
                        </div>
                        <div class="mb-3" id="writtenReprimandAttachmentContainer">
                            <label for="writtenReprimandAttachment" class="form-label">Written Reprimand Attachment</label>
                            <input type="file" class="form-control" id="writtenReprimandAttachment" name="WrittenReprimandAttachment" accept=".pdf">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="sanctionLetterAttachment" class="form-label">Sanction Letter Attachment</label>
                            <input type="file" class="form-control" id="sanctionLetterAttachment" name="SanctionLetterAttachment" accept=".pdf">
                        </div> -->
                    </div>
                    <div class="modal-footer" id="sanctionLetterAttachmentContainer">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" name="btnadd_case">Add Case</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="../javascript/offenses.js"></script>
<script>
    function disableSubmitButton() {
        document.getElementById('submitBtn').disabled = true;
    }
</script>