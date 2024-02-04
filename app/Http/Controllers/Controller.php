<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function logAuthentication(string $user, string $message = "Authentication successful.")
    {
        Log::info("User: {$user} - {$message}");
    }

    public function logAuthenticationError(string $email, string $message = "Authentication error.")
    {
        Log::error("Email: {$email} - {$message}");
    }

    public function logCreated(string $user, string $object, string $objectId)
    {
        Log::info("User: {$user} - {$object}: {$objectId} - {$object} created successfully.");
    }

    public function logUpdated(string $user, string $object, string $objectId)
    {
        Log::info("User: {$user} - {$object}: {$objectId} - {$object} updated successfully.");
    }

    public function logDeleted(string $user, string $object, string $objectId)
    {
        Log::info("User: {$user} - {$object}: {$objectId} - {$object} deleted successfully.");
    }

    public function logRestored(string $user, string $object, string $objectId)
    {
        Log::info("User: {$user} - {$object}: {$objectId} - {$object} restored successfully.");
    }

    public function logQuery(string $user, string $object, string $message = "")
    {
        Log::info("User: {$user} - {$object} {$message}");
    }

    public function logLoadView(string $user, string $object, string $message = "Load view.")
    {
        Log::notice("User: {$user} - {$object} - {$message}");
    }

    public function logError(string $user, string $object, string $message = "Error general.")
    {
        Log::error("User: {$user} - {$object} - {$message}");
    }

    public function logException(string $user, string $object, string $message = "Exception.")
    {
        Log::critical("User: {$user} - {$object} - {$message}");
    }

    public function logInfo(string $user, string $message)
    {
        Log::info("User: {$user} - {$message}.");
    }
}
