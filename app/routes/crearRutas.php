<?php
//-------------------- Excell Alicorp Regular-----------------------------------

Route::post('insertRoadsBT', ['as' =>'insertRoadsBT', function(){
//Bayer Transferencista
    $mytime = Carbon\Carbon::now();
    $mytime->setTimezone('America/Lima');
    $mercado=15987;
    $visit_id=2;
    $company_id=164;
    $road_id=9152;
    $horaSistema = $mytime->toDateTimeString();$c=0;

    $sql1="SELECT id FROM stores where id in (184472,
184488,
185036)";
    $consulta1 = DB::select($sql1);
    if (count($consulta1)>0){
        foreach ($consulta1 as $valor) {

            DB::insert("INSERT INTO road_details (company_id,store_id, audit, road_id,nivel, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($company_id,$valor->id,0,$road_id,1,$horaSistema,$horaSistema));

            $sql11="SELECT id,visits FROM stores c where id='".$valor->id."'";
            $consultaStores = DB::select($sql11);
            if (count($consultaStores)>0){
                if ($visit_id==$consultaStores[0]->visits)
                {
                    DB::update("UPDATE  company_stores set ruteado= 1, updated_at=? where  store_id = ? and company_id= ?" , array($horaSistema,$valor->id,$company_id));
                }
            }

            $sql2="SELECT audit_id FROM company_audits c where company_id='".$company_id."'";
            $consulta2 = DB::select($sql2);
            foreach ($consulta2 as $valor1) {
                DB::insert("INSERT INTO audit_road_stores (company_id,road_id, audit_id,store_id,audit,visit_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($company_id,$road_id, $valor1->audit_id,$valor->id,0,$visit_id,$horaSistema,$horaSistema));
            }
            $c=$c+1;
            DB::insert("INSERT INTO visit_stores (company_id, store_id, visit_id,road_id,ruteado, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($company_id,$valor->id,$visit_id,$road_id,0,$horaSistema,$horaSistema));

            $sql12="SELECT road_id FROM visit_stores c where store_id='".$valor->id."' and visit_id='1' and ruteado='0' and company_id='".$company_id."'";
            $consulta11 = DB::select($sql12);
            if (count($consulta11)<>0){
                foreach ($consulta11 as $valor1) {
                    $road_id_ant=$valor1->road_id;
                }
                DB::update("UPDATE  visit_stores set ruteado= 1, updated_at=? where visit_id = ? and store_id = ? and company_id= ? and road_id= ?" , array($horaSistema,1,$valor->id,$company_id,$road_id_ant));
            }

        }
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }
}]);
Route::post('insertRoadsCamiseta', ['as' =>'insertRoadsCamiseta', function(){
//Bayer Transferencista
    $mytime = Carbon\Carbon::now();
    $mytime->setTimezone('America/Lima');
    $mercado=15987;
    $visit_id=2;
    $company_id=170;
    $road_id=9747;
    $horaSistema = $mytime->toDateTimeString();$c=0;

    $sql1="SELECT id FROM stores where id in (180173,
180177,
180179,
193313,
180157,
193319,
180178,
180183,
180184,
180161,
180158,
193318,
180156,
180171,
180180,
180172,
193321,
180185,
180175)";
    $consulta1 = DB::select($sql1);
    if (count($consulta1)>0){
        foreach ($consulta1 as $valor) {

            DB::insert("INSERT INTO road_details (company_id,store_id, audit, road_id,nivel, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($company_id,$valor->id,0,$road_id,1,$horaSistema,$horaSistema));

            DB::update("UPDATE  company_stores set ruteado= 1, updated_at=? where  store_id = ? and company_id= ?" , array($horaSistema,$valor->id,$company_id));

            $sql2="SELECT audit_id FROM company_audits c where company_id='".$company_id."'";
            $consulta2 = DB::select($sql2);
            foreach ($consulta2 as $valor1) {
                DB::insert("INSERT INTO audit_road_stores (company_id,road_id, audit_id,store_id,audit, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($company_id,$road_id, $valor1->audit_id,$valor->id,0,$horaSistema,$horaSistema));
            }
            $c=$c+1;


        }
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }
}]);