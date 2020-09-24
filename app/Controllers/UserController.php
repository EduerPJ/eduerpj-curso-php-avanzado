<?php
namespace App\Controllers;

use App\Models\User;
use App\Controllers\BaseController;
use Respect\Validation\Validator as v;
 
class UserController extends BaseController
{
    public function create()
    {
        return $this->renderHTML('addUser.twig');
    }

    public function save($request)
    {
        $responseMessage = '';
        if ($request->getMethod() == 'POST') {
            $userData = $request->getParsedBody();
            
            $userValidator = v::key('email', v::email()->notEmpty())
            ->key('password', v::notEmpty()) ; // true
            
            try {
                $userValidator->assert($userData);
                $userData = $request->getParsedBody();
                
                $user = new User();
                $user->email = $userData['email'];
                $user->password = password_hash($userData['password'], PASSWORD_DEFAULT);
                $user->save();

                if ($user->save()) {
                    $responseMessage = 'User created successfully';
                }
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }
        return $this->renderHTML('saveUser.twig', [
            'user' => $user,
            'responseMessage' => $responseMessage
        ]);
    }
}
