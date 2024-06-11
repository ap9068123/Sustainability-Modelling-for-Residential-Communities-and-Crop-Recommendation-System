<?php
// Get the current month and year
$currentMonthYear = date('Y-m');
$currentMonth = date('m');

// Calculate the previous month
$previousMonthYear = date('m-Y', strtotime('-2 month'));
$previousMonth = date('m', strtotime('-1 month'));

echo "Current month and year: " . $currentMonthYear . "\n";
echo "Previous month and year: " . $previousMonthYear . "\n";
echo "Previous month: " . $previousMonth;
?>
