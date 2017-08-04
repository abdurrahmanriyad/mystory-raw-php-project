<?php namespace Classes\ErrorMessage;

class ErrorMessage
{
    public function getAlertMessage($message = "")
    {
        return "<div class='alert alert-danger'>".$message."</div>";
    }

    public function getSuccessMessage($message = "")
    {
        return "<div class='alert alert-success'>".$message."</div>";
    }
}