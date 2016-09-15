<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * This command create 2 permissions is createQuestion, updateQuestion
     * create 2 roles is author and admin
     * Assign author to user id 101 (demo/demo) and admin to user id 100 (admin/admin)
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "updateQuestion" permission
        $updateQuestion = $auth->createPermission('updateQuestion');
        $updateQuestion->description = 'Update question';
        $auth->add($updateQuestion);

        // add "createQuestion" permission
        $createQuestion = $auth->createPermission('createQuestion');
        $createQuestion->description = 'Create question';
        $auth->add($createQuestion);

        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createQuestion);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateQuestion);
        $auth->addChild($admin, $author);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($author, 101);
        $auth->assign($admin, 100);
    }
}