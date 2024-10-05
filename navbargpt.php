<?php
session_start();

// Check if the user is signed in
$isSignedIn = isset($_SESSION['username']);

// Function to generate a navigation tab
function generateTab($text, $link) {
    echo '<li><a href="' . $link . '">' . $text . '</a></li>';
}

// Function to generate the navigation bar based on sign-in status
function generateNavBar($isSignedIn) {
    echo '<ul>';
    generateTab('Jobs', 'jobs.php');
    generateTab('Companies', 'companies.php');

    

    generateTab('Offer Job', 'postjob.php');

    if ($isSignedIn) {
        generateTab('Sign Out', 'signout.php');
        generateTab('Profile', 'profile.php');
    } else {
        generateTab('Sign In', 'login.php');
    }

    
    echo '</ul>';
}

// Generate the navigation bar
generateNavBar($isSignedIn);
?>
