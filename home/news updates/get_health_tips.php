<?php
header('Content-Type: application/json');

$newsItems = [
    [
        'title' => 'New State-of-the-Art MRI Machine',
        'content' => 'Lifeline Hospital is proud to announce the installation of our new MRI machine, offering faster and more accurate diagnoses.',
        'date' => '2023-05-15'
    ],
    [
        'title' => 'Dr. Sarah Johnson Joins Our Cardiology Team',
        'content' => 'We are excited to welcome Dr. Sarah Johnson, a renowned cardiologist, to our growing team of specialists.',
        'date' => '2023-05-10'
    ],
    [
        'title' => 'Lifeline Hospital Recognized for Patient Safety',
        'content' => 'We are honored to receive the 2023 Patient Safety Excellence Award, recognizing our commitment to providing the highest quality care.',
        'date' => '2023-05-05'
    ]
];

echo json_encode($newsItems);