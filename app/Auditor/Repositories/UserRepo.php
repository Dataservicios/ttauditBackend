<?php
/**
 * Created by PhpStorm.
 * User: Webmaster
 * Date: 18/12/2014
 * Time: 04:24 PM
 */

namespace Auditor\Repositories;
use Auditor\Entities\User;


class UserRepo extends BaseRepo{

    public function getModel()
    {
        return new User;
    }

    public function newUser()
    {
        $user = new User();
        //$user->type = 'auditor';
        return $user;
    }

    public function getUserForPhone($imei)
    {
        return User::where('imei',$imei)->first();
    }


    public function listUser()
    {
        $users = User::paginate();
        return $users;
    }

    public function listUserCondition($type,$customer_id="0")
    {
        if ($customer_id=="0")
        {
            $users = User::where('type', $type)->orderBy('fullname','ASC')->get();
        }else{
            $sql = "SELECT 
  `users`.`id`,
  `users`.`fullname`,
  `users`.`type`,
  `users`.`email`
FROM
  `user_customers`
  INNER JOIN `customers` ON (`user_customers`.`customer_id` = `customers`.`id`)
  INNER JOIN `users` ON (`user_customers`.`user_id` = `users`.`id`)
  INNER JOIN `companies` ON (`customers`.`id` = `companies`.`customer_id`)
WHERE
  `companies`.`id` = '".$customer_id."' AND 
  `users`.`type` = '".$type."' ORDER BY  `users`.`fullname` ASC";
            $users=\DB::select($sql);
        }

        return $users;
    }

    public function listUserCustomer($customer_id)
    {
        $sql = "SELECT
 `stores`.`id`, `stores`.`ejecutivo`
FROM
  `company_stores`
  INNER JOIN `stores` ON (`company_stores`.`store_id` = `stores`.`id`)
  INNER JOIN `companies` ON (`company_stores`.`company_id` = `companies`.`id`)
  INNER JOIN `customers` ON (`companies`.`customer_id` = `customers`.`id`)
WHERE
  `customers`.`id` = '".$customer_id."' AND
  `stores`.`test` = 0 and  stores.ejecutivo <>''
group by stores.ejecutivo
order by stores.ejecutivo asc";
        $users=\DB::select($sql);
        return $users;
    }

    public function getUserForEmail($email,$customer_id)
    {
        return  User::where('email', $email)->where('customer_id',$customer_id)->first();
    }

    public function getUsersForType($typeUser,$customer_id,$company_id)
    {
        $regResult = \DB::table('roles_users')->join('roles','roles_users.rol_id','=','roles.id')->join('users','roles_users.user_id','=','users.id')->select('roles_users.user_id', 'roles_users.rol_id','users.fullname','users.type','users.customer_id','users.codigo')->where('roles.type', $typeUser)->where('users.customer_id', $customer_id)->where('roles_users.company_id', $company_id)->get();
        return $regResult;
    }

} 