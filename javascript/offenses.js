document.getElementById('offense').addEventListener('change', function() {
    const offense = this.value;
    let category = '';

    // Define minor offenses with full values
    const minorOffenses = [
        'Noncompliance of Academic Requirements - Attendance (exceeded allowable absences)',
        'Noncompliance of Academic Requirements - Habitual tardiness',
        'Noncompliance of Academic Requirements - Truancy or cutting classes',
        'Attitude inside the Classroom - Classroom mischief, failure to turn off or put on silent the mobile phone',
        'Attitude inside the Classroom - Disturbing other classes/activities through excessive noise',
        'Attitude inside the Classroom - Littering',
        'Behavior in Campus - Engaging in bullying',
        'Behavior in Campus - Not wearing the prescribed uniform',
        'Behavior in Campus - Violation on ID - Improper wearing of ID',
        'Behavior in Campus - Violation on ID - Tampering with ID',
        'Behavior in Campus - Violation on ID - Wearing someone else\'s ID',
        'Behavior in Campus - Violation on ID - Lending one\'s ID',
        'Behavior in Campus - With a cap/hat inside the classroom or school premises',
        'Behavior in Campus - Exposed tattoos',
        'Behavior in Campus - Piercings other than the ear lobes',
        'Behavior in Campus - Unauthorized use or charging of electric devices or gadgets',
        'Behavior in Campus - Students disrupting classes, school/institutional activities',
        'Behavior in Campus - Posting/Publishing unauthorized announcements',
        'Behavior in Campus - Inflicting harm physically, mentally, and emotionally on other person',
        'Behavior in Campus - Unauthorized use of LOA premises or facilities',
        'Behavior in Campus - Spitting on floors/walls',
        'Behavior in Campus - Littering',
        'Behavior in Campus - Loitering or staying in restricted areas',
    ];


    // Define major offenses (unchanged)
    const majorOffenses = [
        'Violation with Legal Implications - Possession use, or sale of illegal drugs (RA 9165) inside the school premises and entering the school while intoxicated',
        'Violation with Legal Implications - Possession, use, or sale of cigarettes (RA 9211) / e-cigarettes (Vape). Possession of alcoholic beverages or reporting inside the campus while intoxicated',
        'Violation with Legal Implications - Smoking within the school premises or approved off-campus activities (100 meters from perimeter to any point, RA 9211)',
        'Violation with Legal Implications - Possession/carrying or use of firearms, explosives, knives, or weapons that can cause harm (Presidential Decree No. 1866)',
        'Violation with Legal Implications - Use of the Internet or social media to malign fellow students or persons in authority (Cyberbullying, RA 10175)',
        'Violation with Legal Implications - Violation of RA 7877 (Anti-sexual Harassment)',
        'Violation with Legal Implications - Violation of RA 9995 (Anti-Photo and Video Voyeurism Act of 2009)',
        'Violation with Legal Implications - Violation of Article 364 of the Revised Penal Code (Intriguing against honor)',
        'Violation with Legal Implications - Violation of Article 172 of the Revised Penal Code (Falsification of Documents)',
        'Violation with Legal Implications - Violation of RA 10627 (Anti-Bullying Act)',
        'Violation with Legal Implications - Violation of the Criminal Code of the Philippines (Threatening, assaulting, or challenging others)',
        'Violation with Legal Implications - Violation of RA 8049 (Anti-Hazing Act)',
        'Indecency in Campus - Explicit sexual exposure using devices or social media (pornographic material)',
        'Indecency in Campus - Public display of affection (PDA) or immoral acts such as petting and necking',
        'Indecency in Campus - Affiliation with fraternities, sororities, gangs, or unauthorized organizations',
        'Indecency in Campus - Gambling in any form within the school premises',
        'Indecency in Campus - Vandalism or marking on walls, chairs, tables, or any school property',
        'Indecency in Campus - Distribution of provocative materials (e.g., pornographic or subversive)',
        'Misconduct in Lyceum Campus - Instigating or leading protests resulting in class disruption',
        'Misconduct in Lyceum Campus - Cheating, copying, or allowing copying of exams, projects, or papers',
        'Misconduct in Lyceum Campus - Preempting and disseminating confidential information (e.g., grades or awards)',
        'Misconduct in Lyceum Campus - Disregarding school rules, such as speeding or not following parking procedures',
        'Misconduct in Lyceum Campus - Soliciting money or donations without prior approval',
        'Misconduct in Lyceum Campus - Use of profane or obscene language; disrespectful language',
        'Misconduct in Lyceum Campus - False accusation against the Administration or staff through conspiracy or other means',
        'Violation by Representative - Misbehavior of representatives such as parents or guardians (e.g., raising voice, taunting, or carrying weapons)',
        'Violation by Representative - Sending threatening or harassing messages to LOA employees',
        'Violation by Representative - Physically abusive behavior toward LOA personnel or students',
        'Violation by Representative - Causing damage to LOA properties or moral harm to staff or institution image'
    ];

    if (minorOffenses.includes(offense)) {
        category = 'Minor';
    } else if (majorOffenses.includes(offense)) {
        category = 'Major';
    }

    document.getElementById('offenseCategory').value = category;
});