<?php

// Phalcon Libraries
use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Text;

use Models\Groepen;
use Models\Middelen;

class SecurityPlugin extends Plugin
{
    public function beforeDispatch(Event $event, Dispatcher $dispatcher) {
        $auth = $this->session->get('auth');
        if (!$auth){
            $role = 'Guests';
        } else {
            $groep = Groepen::findFirstByGroepId( $this->session->get('auth')['groep_id']);

            $role = $groep->naam;
        }

        $namespace = $dispatcher->getNamespaceName();
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
        $acl = $this->getAcl($namespace);

        $allowed = $acl->isAllowed($role, $controller, $action);

        if ($allowed != Acl::ALLOW) {
            $dispatcher->forward(array(
                'namespace' => 'Helpers',
                'controller' => 'not_found',
                'action'     => 'notAllowed'
            ));
            return false;
        }

        return true;
    }

    private function getAcl($namespace) {
        //if (!isset($this->persistent->acl)) {
            // Create a new instantion of ACL
            $acl = new AclList();
            $acl->setDefaultAction(Acl::DENY);

            // Get groups for later use
            $groups = Groepen::find();

            // Get all available resources and add them to the acl resources
            foreach($this->getAvailableResources($namespace) as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            // Add groups to ACL roles
            foreach ($groups as $groep) {
                $acl->addRole($groep->naam);
            }

            // Allow groups to use resources assigned to them
            foreach($groups as $group) {
                foreach($this->getPermissions($group->groep_id) as $permission) {
                    foreach ($this->getAllowedResources($permission->permissie_id, $namespace) as $resource => $actions) {
                        foreach ($actions as $action){
                            $acl->allow($groep->naam, $resource, $action);
                        }
                    }
                }
            }

            //The acl is stored in session, APC would be useful here too
            $this->persistent->acl = $acl;
        //}
        return $this->persistent->acl;
    }

    private function getAvailableResources($namespace) {
        // Get resources
        $resources = Middelen::find(array(
            'conditions' => 'namespace = :namespace:',
            'bind' => array('namespace' => $namespace)
        ));

        $availableResources = array();

        foreach($resources as $resource) {
            $availableResources[Text::uncamelize($resource->controller)][] = $resource->action;
        }

        return $availableResources;
    }

    private function getPermissions($groupId) {
        $permissions = $this->modelsManager->createBuilder()
            ->from('Models\GroepPermissies')
            ->where('groep_id = :groupId:', array('groupId' => $groupId))
            ->getQuery()
            ->execute();

        return $permissions;
    }

    private function getAllowedResources($permissionId, $namespace) {
        $allowedResources = array();

        $resources = $this->modelsManager->createBuilder()
            ->from('Models\PermissieMiddelen')
            ->columns('Models\Middelen.*')
            ->innerJoin('Models\Middelen')
            ->where('permissie_id = :permissionId: AND namespace = :namespace:', array('permissionId' => $permissionId, 'namespace' => $namespace))
            ->getQuery()
            ->execute();

        foreach($resources as $resource) {
            $allowedResources[Text::uncamelize($resource->controller)][] = $resource->action;
        }

        return $allowedResources;
    }
}