<?php

namespace CMW\Controller\Users;

use CMW\Controller\Core\CoreController;
use CMW\Model\Users\PermissionsModel;
use CMW\Model\Users\RolesModel;
use CMW\Model\Users\UsersModel;
use CMW\Router\Link;
use CMW\Utils\Utils;
use CMW\Utils\View;
use JetBrains\PhpStorm\NoReturn;
use JsonException;

/**
 * Class: @rolesController
 * @package Users
 * @author CraftMyWebsite Team <contact@craftmywebsite.fr>
 * @version 1.0
 */
class RolesController extends CoreController
{


    private UsersModel $userModel;
    private RolesModel $roleModel;
    private PermissionsModel $permissionsModel;


    public function __construct($theme_path = null)
    {
        parent::__construct($theme_path);
        $this->userModel = new UsersModel();
        $this->roleModel = new RolesModel();
        $this->permissionsModel = new PermissionsModel();
    }

    #[Link(path: "/", method: Link::GET, scope: "/cmw-admin/roles")]
    #[Link("/manage", Link::GET, [], "/cmw-admin/roles")]
    public function adminRolesManage(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "users.roles");

        $rolesList = $this->roleModel->getRoles();
        $permissionController = new PermissionsController();
        $permissionModel = new PermissionsModel();
        $rolesModel = new RolesModel();

        //Try to improve that ?
        require_once(Utils::getEnv()->getValue("DIR") . "app/package/users/functions/loadPermissions.php");


        View::createAdminView("users", "roles")
            ->addScriptBefore("app/package/users/views/assets/js/manageRoles.js")
            ->addVariableList(["rolesList" => $rolesList, "permissionController" => $permissionController,
                "permissionModel" => $permissionModel, "rolesModel" => $rolesModel])
            ->view();
    }

    #[Link("/add", Link::GET, [], "/cmw-admin/roles")]
    public function adminRolesAdd(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "users.roles");

        $permissionController = new PermissionsController();
        $permissionModel = new PermissionsModel();

        //Try to improve that ?
        require_once(getenv("DIR") . "app/package/users/functions/loadPermissions.php");


        View::createAdminView("users", "roles.add")->addVariableList(array(
            "permissionController" => $permissionController,
            "permissionModel" => $permissionModel
        ))
            ->view();
    }

    #[Link("/add", Link::POST, [], "/cmw-admin/roles")]
    #[NoReturn] public function adminRolesAddPost(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "users.roles");

        $role = new RolesModel();
        $roleName = filter_input(INPUT_POST, "name");
        $roleDescription = filter_input(INPUT_POST, "description");
        $permList = $_POST['perms'];
        $roleWeight = filter_input(INPUT_POST, "weight", FILTER_SANITIZE_NUMBER_INT);
        $role->createRole($roleName, $roleDescription, $roleWeight, $permList);


        $_SESSION['toaster'][0]['title'] = "USERS_TOASTER_TITLE";
        $_SESSION['toaster'][0]['type'] = "bg-success";
        $_SESSION['toaster'][0]['body'] = "USERS_ROLE_ADD_TOASTER_SUCCESS";

        header("location: " . $_SERVER['HTTP_REFERER']);
    }

    #[Link("/edit/:id", Link::GET, ["id" => "[0-9]+"], "/cmw-admin/roles")]
    public function adminRolesEdit(int $id): void
    {
        $roleModel = new RolesModel();
        $role = $this->roleModel->getRoleById($id);
        $permissionController = new PermissionsController();
        $permissionModel = new PermissionsModel();

        //Try to improve that ?
        require_once(getenv("DIR") . "app/package/users/functions/loadPermissions.php");

        View::createAdminView("users", "roles.edit")->addVariableList(array(
            "permissionController" => $permissionController,
            "permissionModel" => $permissionModel,
            "roleModel" => $roleModel,
            "role" => $role
        ))
            ->view();
    }

    #[Link("/edit/:id", Link::POST, ["id" => "[0-9]+"], "/cmw-admin/roles")]
    #[NoReturn] public function adminRolesEditPost(int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "users.roles");

        $roleName = filter_input(INPUT_POST, "name");
        $roleDescription = filter_input(INPUT_POST, "description");
        $permList = $_POST['perms'];
        $roleWeight = filter_input(INPUT_POST, "weight", FILTER_SANITIZE_NUMBER_INT);

        $this->roleModel->updateRole($roleName, $roleDescription, $id, $roleWeight, $permList);

        //Todo Try to remove that
        $_SESSION['toaster'][0]['title'] = "USERS_TOASTER_TITLE";
        $_SESSION['toaster'][0]['type'] = "bg-success";
        $_SESSION['toaster'][0]['body'] = "USERS_ROLE_EDIT_TOASTER_SUCCESS";

        header("location: " . $_SERVER['HTTP_REFERER']);
    }

    #[Link("/delete/:id", Link::GET, ["id" => "[0-9]+"], "/cmw-admin/roles")]
    #[NoReturn] public function adminRolesDelete(int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "users.roles");

        $this->roleModel->deleteRole($id);

        //Todo Try to remove that
        $_SESSION['toaster'][0]['title'] = "USERS_TOASTER_TITLE";
        $_SESSION['toaster'][0]['type'] = "bg-success";
        $_SESSION['toaster'][0]['body'] = "USERS_ROLE_EDIT_TOASTER_SUCCESS";

        header("location: " . $_SERVER['HTTP_REFERER']);
    }

    #[Link("/getRole/:id", Link::GET, ["id" => "[0-9]+"], "/cmw-admin/roles")]
    public function admingetRole(int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "users.roles");

        $_SESSION['editRoleId'] = $id;

        $role = (new RolesModel())->getRoleById($id);

        $rolePermissions = [];

        foreach ($role?->getPermissions() as $permission) {
            if ($permission->hasParent()) {
                $rolePermissions[$permission->getId()] = $permission->getParent()?->getCode();
            }
            $rolePermissions[$permission->getId()] = $permission->getCode();
        }

        $data = [
            "id" => $role?->getId(),
            "name" => $role?->getName(),
            "weight" => $role?->getWeight(),
            "description" => $role?->getDescription(),
            "permissions" => $rolePermissions
        ];

        try {
            print_r(json_encode($data, JSON_THROW_ON_ERROR));
        } catch (JsonException) {
            print("ERROR");
        }
    }

}