<?php

namespace App\Model\Validators;

class MessageValidator implements ValidatorInterface
{
    private const NOT_EMPTY_FIELDS = ['message'];
    private const MIN_MESSAGE_LENGTH = 2;
    private const MAX_MESSAGE_LENGTH = 1000;

    public function validate(array $data): array
    {
        $errors = $this->validateNotEmpty($data);

        if (!empty($errors)) {
            return $errors;
        }

        return array_merge(
            $this->validateLengthMessage($data)
        );
    }

    private function validateNotEmpty(array $data): array
    {
        $errors = [];

        foreach (self::NOT_EMPTY_FIELDS as $fieldName) {
            $value = $data[$fieldName] ?? null;

            if (empty($value)) {
                $errors[$fieldName] = 'Поле "' . $fieldName . '" не должно быть пустым';
            }
        }

        return $errors;
    }

    private function validateLengthMessage(array $data): array
    {
        $messLength = mb_strlen($data['message']);

        if ($messLength < self::MIN_MESSAGE_LENGTH) {
            return [
                'message' => 'Тело не может быть меньше ' . self::MIN_MESSAGE_LENGTH . ' символов'
            ];
        }

        if ($messLength > self::MAX_MESSAGE_LENGTH) {
            return [
                'message' => 'Тело не может быть больше ' . self::MAX_MESSAGE_LENGTH . ' символов'
            ];
        }

        return [];
    }
}