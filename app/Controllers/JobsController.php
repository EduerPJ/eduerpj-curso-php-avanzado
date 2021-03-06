<?php
namespace App\Controllers;

use App\Models\Job;
use App\Controllers\BaseController;
use Respect\Validation\Validator as v;

class JobsController extends BaseController
{
    public function getAddJobAction($request)
    {
        $responseMessage = '';
        if ($request->getMethod() == 'POST') {
            $postData = $request->getParsedBody();

            $jobValidator = v::key('title', v::stringType()->notEmpty())
            ->key('description', v::stringType()->notEmpty());

            try {
                $jobValidator->assert($postData); // true
                $postData = $request->getParsedBody();

                $files = $request->getUploadedFiles();
                $logo = $files['logo'];

                if ($logo->getError() == UPLOAD_ERR_OK) {
                    $fileName = $logo->getClientFilename();
                    $logo->moveTo("uploads/$fileName");
                }

                $job  = new Job();
                $job->title = $postData['title'];
                $job->description = $postData['description'];
                $job->visible = true;
                $job->months = 16;
                $job->file = $fileName;
                $job->save();
                $responseMessage = 'Saved';
            } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
            }
        }
        return $this->renderHTML('addJob.twig', [
            'responseMessage' => $responseMessage
        ]);
    }
}
