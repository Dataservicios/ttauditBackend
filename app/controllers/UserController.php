<?php
use Auditor\Entities\User;
use Auditor\Managers\RegisterManager;
use Auditor\Repositories\UserRepo;
use Auditor\Managers\AccountManager;
use Auditor\Managers\UserManager;
use Auditor\Repositories\ContactStoreRepo;
use Auditor\Repositories\CreditDistributorRepo;


class UserController extends BaseController{

    protected $userRepo;
    protected $contactStoreRepo;
    protected $creditDistributorRepo;

    public function __construct(UserRepo $userRepo,ContactStoreRepo $contactStoreRepo,CreditDistributorRepo $creditDistributorRepo)
    {
        $this->userRepo = $userRepo;
        $this->contactStoreRepo = $contactStoreRepo;
        $this->creditDistributorRepo = $creditDistributorRepo;
    }


    public function listStoreAuditPalmeraNow(){
        $id = Input::only('id');
        $company_id = Input::only('company_id');
        if ($company_id['company_id']==47){
            $poll_id=627;
        }else{
            $poll_id=879;
        }

        $sql = "SELECT 
              `f`.`company_id`,
              `a`.`store_id`,
              `b`.`type`,
              `b`.`codclient`,
              `b`.`fullname`,
              `b`.`address`,
              `b`.`district`,
              `b`.`region`,
              `b`.`ubigeo`,
              `b`.`comment`,
              `b`.`ejecutivo`,
              `b`.`coordinador`,
              `e`.`fullname` AS `auditor`,
              DATE_FORMAT(`a`.`created_at`, '%d/%m/%Y') AS `fecha`,
              MIN(DATE_FORMAT(`a`.`created_at`, '%H:%i:%s')) AS `hora`
            FROM
              `poll_details` `a`
              LEFT OUTER JOIN `stores` `b` ON (`a`.`store_id` = `b`.`id`)
              LEFT OUTER JOIN `company_stores` `f` ON (`a`.`store_id` = `f`.`store_id`)
              LEFT OUTER JOIN `users` `e` ON (`a`.`auditor` = `e`.`id`)
            WHERE
              `f`.`company_id` = '".$company_id['company_id']."'  AND 
              `a`.`auditor` = '".$id['id']."' AND
              `a`.`poll_id` = '".$poll_id."' AND
              date_format(`a`.`created_at`, '%d/%m/%Y') = date_format(now(), '%d/%m/%Y') 
            GROUP BY
              `f`.`company_id`,
              `a`.`store_id`,
              `b`.`type`,
              `b`.`codclient`,
              `b`.`fullname`,
              `b`.`address`,
              `b`.`district`,
              `b`.`region`,
              `b`.`ubigeo`,
              `b`.`comment`,
              `b`.`latitude`,
              `b`.`longitude`,
              `b`.`ejecutivo`,
              `b`.`coordinador`,
              `e`.`fullname`,
              `b`.`distributor`,
              DATE_FORMAT(`a`.`created_at`, '%d/%m/%Y')
                ";

        $consulta=DB::select($sql);
        $success =1;

        return \Response::json([ 'success'=>$success ,"roadsDetail" => $consulta]);
    }

    public function listUsers()
    {
        $users =$this->userRepo->listUser();
        /*dd($category);*/
        return View::make('panelAdmin',compact('users'));
    }


    public function signUp()
    {
        $user_types = \Lang::get('utils.type');
        //dd($user_types);
        return View::make('users/sign-up', compact('user_types'));
    }

    public function register()
    {
        /*$data = Input::only(['fullname','email','password','password_confirmation']);*/
        /*$rules = [
            'fullname' => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed',
            'password_confirmation' => 'required'
        ];*/

        /*$validation = \Validator::make($data,$rules);*/

        /*if ($validation->passes())
        {
            //User::create($data);
            $user = new User($data);
            $user->type = 'auditor';
            $user->save();
            return Redirect::route('admin');
        }*/
        $user = $this->userRepo->newUser();
        //dd($user);
        $manager = new RegisterManager($user, Input::all());
        /*if ($manager->save())
        {
            return Redirect::route('admin');
        }*/
        $manager->save();
        return Redirect::route('admin');
        //return Redirect::back()->withInput()->withErrors($validation->messages());
        //return Redirect::back()->withInput()->withErrors($manager->getErrors());
    }

    public function account()
    {
        $user = Auth::user();
        $user_types = \Lang::get('utils.type');
        return View::make('users/account', compact('user','user_types'));
    }

    public function updateAccount()
    {
        $user = Auth::user();
        $manager = new AccountManager($user, Input::all());
        /*if ($manager->save())
        {
            return Redirect::route('admin');
        }*/
        //return Redirect::back()->withInput()->withErrors($validation->messages());

        /*try{
            $manager->save();
        } catch (\Auditor\Managers\ValidationException $e){
            dd($e->getErrors());
        }*/
        $manager->save();
        return Redirect::route('admin');

        //return Redirect::back()->withInput()->withErrors($manager->getErrors());
    }

    public function user($id)
    {
        $user = $this->userRepo->find($id);
        $user_types = \Lang::get('utils.type');
        return View::make('users/user', compact('user', 'user_types'));
    }

    public function updateUser($id)
    {
        $user = $this->userRepo->find($id);
        //dd(Input::all());
        $manager = new UserManager($user, Input::all());
        $manager->save();
        return Redirect::route('admin');
    }

    public function destroy($id)
    {
        $user = $this->userRepo->find($id);

        if (is_null ($user))
        {
            App::abort(404);
        }

        $user->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Usuario ' . $user->fullname . ' eliminado',
                'id'      => $user->id
            ));
        }
        else
        {
            return Redirect::route('admin');
        }
    }

    /*public function profile()
    {
        $user = Auth::user();
        return View::make('users/profile', compact('user'));
    }

    public function profileAccount()
    {
        $user = Auth::user();
        $manager = new AccountManager($user, Input::all());

        $manager->save();
        return Redirect::route('admin');
    }*/

    public function insertContact()
    {
        $valoresPost= Input::all();
        $store_id = $valoresPost['store_id'];
        $fullname = $valoresPost['fullname'];
        $cargo = $valoresPost['cargo'];
        $tipo = $valoresPost['tipo'];//principal(0) o secundario(1)
        $fnac = $valoresPost['fnac'];
        $phone = $valoresPost['phone'];
        $cel = $valoresPost['cel'];
        $email = $valoresPost['email'];
        $objUserRepo = $this->userRepo->getModel();
        $objUserRepo->type = 'contact';
        $objUserRepo->fullname = $fullname;
        $objUserRepo->cargo = $cargo;
        $objUserRepo->tipo_contact = $tipo;
        $objUserRepo->phone = $phone;
        $objUserRepo->celular = $cel;
        $objUserRepo->email = $email;
        $objUserRepo->active = 1;
        if ($fnac<>''){
            $objUserRepo->f_nac = $fnac;
        }
        $valueResult = $this->userRepo->verifyContactStore($objUserRepo);
        header('Access-Control-Allow-Origin: *');
        if ($valueResult)
        {
            if ($objUserRepo->save())
            {
                $objContact = $this->contactStoreRepo->getModel();
                $objContact->store_id = $store_id;
                $objContact->user_id = $objUserRepo->id;
                if ($objContact->save())
                {
                    return Response::json([ 'success'=> 1]);
                }else{
                    return Response::json([ 'success'=> 0]);
                }

            }else{
                return Response::json([ 'success'=> 0]);
            }
        }else{
            return Response::json([ 'success'=> 0]);
        }

    }

    public function listContacts()
    {
        $valoresPost= Input::all();
        $store_id = $valoresPost['store_id'];
        $lista_contacts = $this->contactStoreRepo->getModel();
        $contacts = $lista_contacts->where('store_id',$store_id)->get();
        $contacts_list =[];
        if (count($contacts)>0)
        {
            foreach ($contacts as $contact) {
                $objUser = $this->userRepo->find($contact->user_id);
                $contacts_list[] = $objUser;
            }
            return Response::json([ 'success'=> 1,'contacts'=>$contacts_list]);
        }else{
            return Response::json([ 'success'=> 0,'contacts'=>$contacts_list]);
        }

    }

    public function insertCreditDistributor()
    {
        $valoresPost= Input::all();
        $store_id = $valoresPost['store_id'];
        $user_id = $valoresPost['distributor_id'];
        $linea = $valoresPost['linea'];
        $plazo = $valoresPost['plazo'];
        $objCDRepo = $this->creditDistributorRepo->getModel();
        $objCDRepo->user_id = $user_id;
        $objCDRepo->store_id = $store_id;
        $objCDRepo->linea = $linea;
        $objCDRepo->plazo = $plazo;
        $valueResult = $this->creditDistributorRepo->updateInsertCreditDistributor($objCDRepo);
        header('Access-Control-Allow-Origin: *');
        return Response::json([ 'success'=> 1]);
    }

    public function listCreditDistributor()
    {
        $valoresPost= Input::all();
        $store_id = $valoresPost['store_id'];
        $lista_creditos = $this->creditDistributorRepo->listCreditDistributor($store_id);

        if (count($lista_creditos)>0)
        {
            return Response::json([ 'success'=> 1,'credits'=>$lista_creditos]);
        }else{
            return Response::json([ 'success'=> 0,'credits'=>[]]);
        }

    }

} 