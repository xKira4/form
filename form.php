<?php

if (isset($_POST['s1'])) {

    // ================================================
    // 1) Check that required fields exist and are not empty
    //    before using them, to avoid Warnings or saving empty data
    // ================================================
    $required = ['name', 'phone', 'id', 'email'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            die("Please fill in all required fields.");
        }
    }

    // ================================================
    // 2) Sanitize all user input
    //    to prevent malicious code injection (XSS / Header Injection)
    //    strip_tags: removes any HTML/JS submitted
    //    trim: removes extra whitespace from start/end
    // ================================================
    $name     = trim(strip_tags($_POST['name']));
    $phone    = trim(strip_tags($_POST['phone']));
    $id       = trim(strip_tags($_POST['id']));
    $email    = trim(strip_tags($_POST['email']));
    $optional = isset($_POST['optional']) ? trim(strip_tags($_POST['optional'])) : '';

    // ================================================
    // 3) Validate that the email format is actually correct
    // ================================================
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address.");
    }

    // ================================================
    // 4) The file was named data.xls but it wasn't a real Excel file
    //    (it was plain text with the wrong extension) — changed to .csv
    //    so it opens correctly in Excel and is properly formatted
    // ================================================
    $myfile = fopen("data.csv", "a") or die("Unable to open file");

    // ================================================
    // 5) Instead of writing each field on its own line (repeated fwrite calls),
    //    combine all data into one CSV-formatted row (comma-separated)
    //    This is easier to read and more organized when opened in Excel
    // ================================================
    $row = [$name, $phone, $id, $email, $optional, date('Y-m-d H:i:s')];
    fputcsv($myfile, $row);

    fclose($myfile);

    echo "Thanks for submitting your information. We will contact you as soon as possible.";
}
