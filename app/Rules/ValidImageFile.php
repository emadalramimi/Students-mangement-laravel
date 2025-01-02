<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class ValidImageFile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string = null): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value instanceof UploadedFile) {
            $fail('The :attribute must be a file.');
            return;
        }

        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Check MIME type
        $mimeType = $value->getMimeType();
        if (!in_array($mimeType, $allowedMimeTypes)) {
            $fail('The :attribute must be a file of type: jpeg, png, gif.');
            return;
        }

        // Check file extension
        $extension = strtolower($value->getClientOriginalExtension());
        if (!in_array($extension, $allowedExtensions)) {
            $fail('The :attribute must have an extension of: jpg, jpeg, png, gif.');
            return;
        }

        // Optional: Additional file size check
        if ($value->getSize() > 2048 * 1024) {
            $fail('The :attribute must not be larger than 2MB.');
        }
    }
}
