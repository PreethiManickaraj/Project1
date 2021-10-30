<?php

/**
 *  MessageManager class has methods to show error message
 *  stores the messages in session variable.
 */
class MessageManager 
{
    /**
     *  Method for adding error message and store in SESSION variable.
     *  @param array $messages has the messages to display.
     */
    public function addErrorMessage($message)
    {
        $_SESSION['error_message'] = $message;
    }
    /**
     * Method for adding success messages and store in SESSION variable.
     * @param array $message has the messages to display.
     */
    public function addSuccessMessage($message)
    {
        $_SESSION['success_message'] = $message;
    }
    /**
     *  Method for adding warning messages and store in session variable.
     *  @var array $message has the messages to display.
     */
    public function addWarningMessage()
    {
        $_SESSION['warning_message'] = $message;
    }
    /**
     *  Method for getting error messages.
     *  @return string $_SESSION['error_message] returns the error message.
     */
    public function getErrorMessage()
    {
        return $_SESSION['error_message'] ?? '';
    }
    /**
     *  Method for getting success messages.
     *  @return string $_SESSION['success_message] returns the success message.
     */
    public function getSuccessMessage()
    {
        return $_SESSION['success_message'] ?? '';
    }
    /**
     *  Method for getting warning messages.
     *  @return string $_SESSION['warning_message] returns the warning message.
     */
    public function getWarningMessage()
    {
        return $_SESSION['warning_message'] ?? '';
    }
    /**
     * Method for getting all messages.
     * @return array returns the error,success,warning messages in associative array.
     */
    public function getAllMessages()
    {
        return [
            'error' => $this->getErrorMessage(),
            'success' => $this->getSuccessMessage(),
            'warning' => $this->getWarningMessage(),
        ];
    } 
    /**
     *  Method for clearing the messages.
     */
    public function unsetMessages()
    {
        $_SESSION['error_message'] = '';
        $_SESSION['success_message'] = '';
        $_SESSION['warning_message'] = '';
    }
}