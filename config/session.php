<?php
function startSession() {
    // Check if session is already started
    if (session_status() == PHP_SESSION_NONE) {
        // Start the session
        session_start();
    }
}
?>