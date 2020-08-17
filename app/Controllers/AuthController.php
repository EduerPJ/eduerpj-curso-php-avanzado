<?php
namespace App\Controllers;

use App\Models\User;
use App\Controllers\BaseController;
use Respect\Validation\Validator as v;
use Laminas\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController
{
    public function getLogin()
    {
        return $this->renderHTML('login.twig');
    }

    public function postLogin($request)
    {
        $postData = $request->getParsedBody();
        $responseMessage = null;

        $user = User::where('email', $postData['email'])->first();

        if ($user) {
            if (password_verify($postData['password'], $user->password)) {
                $_SESSION['userId'] = $user->id;
                return new RedirectResponse('/platzi_php/admin');
            } else {
                $responseMessage = 'Bad credentials 🙁';
            }
        } else {
            $responseMessage = 'Bad credentials 🙁';
        }

        return $this->renderHTML('login.twig', [
             'responseMessage' => $responseMessage
         ]);
    }

    public function getLogout()
    {
        unset($_SESSION['userId']);
        return new RedirectResponse('/platzi_php/login');
    }
}