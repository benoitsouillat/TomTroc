<?php

declare(strict_types=1);
class userFormValidator
{
    public static function checkPseudo(string $pseudo): array
    {
        $errors = [];
        if (empty($pseudo)) {
            $errors[] = "Votre pseudo est obligatoire";
        }
        return $errors;
    }
    public static function checkPassword(string $newPassword, string $passwordConfirmation, ?string $oldPassword = null): array
    {
        $errors = [];
        if (isset($oldPassword)) {
            $userRepository = new UserRepository();
            $user = $userRepository->getUserByEmail($_SESSION['user']['email']);
            if (!password_verify($oldPassword, $user->password)) {
                $errors[] = "Mot de passe incorrect";
            }
        }
        if (strlen($newPassword) < 8) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
        }
        if ($newPassword !== $passwordConfirmation) {
            $errors[] = "Les mots de passe ne sont pas identiques.";
        }
        return $errors;
    }
    public static function checkEmail(?string $email = null, ?int $id = null): array
    {
        $errors = [];
        $userRepository = new UserRepository();
        $user = $userRepository->getUserByEmail($email);
        if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Vous devez entrer un email valide";
        }
        if (!isset($id)) {
            if ($userRepository->getUserByEmail($email))
                $errors[] = "Ce compte existe déjà.";
        } else {
            if (isset($user) && $user->id != $id) {
                $errors[] = "Cet email est déjà utilisé";
            }
        }
        return $errors;
    }
    public static function checkRegister(string $newPassword, string $passwordConfirmation, string $email): array
    {
        return array_merge(self::checkPassword($newPassword, $passwordConfirmation), self::checkEmail($email));
    }
}
