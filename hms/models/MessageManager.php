<?php
/**
 *  MessageManager class has methods to show error message
 */
class MessageManager 
{
    // shows error messages
    public function addErrorMessage($message)
    {
        $_SESSION['error_message'] = $message;
    }
    // shows success messages
    public function addSuccessMessage($message)
    {
        $_SESSION['success_message'] = $message;
    }
    // shows warning messages
    public function addWarningMessage()
    {
        $_SESSION['warning_message'] = $message;
    }
    // gets error message
    public function getErrorMessage()
    {
        return $_SESSION['error_message'] ?? '';
    }
    // gets success message
    public function getSuccessMessage()
    {
        return $_SESSION['success_message'] ?? '';
    }
    // gets warning message
    public function getWarningMessage()
    {
        return $_SESSION['warning_message'] ?? '';
    }
    // returns success, error and warning messages
    public function getAllMessages()
    {
        return [
            'error' => $this->getErrorMessage(),
            'success' => $this->getSuccessMessage(),
            'warning' => $this->getWarningMessage(),
        ];
    }
    // used to clear messages
    public function unsetMessages()
    {
        $_SESSION['error_message'] = '';
        $_SESSION['success_message'] = '';
        $_SESSION['warning_message'] = '';
    }
}