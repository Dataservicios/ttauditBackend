<?php

/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 28/07/2017
 * Time: 10:33
 */
class PruebaController extends BaseController
{

    public function pruebaHome()
    {


        $menus=null; // = $this->generateMenusBayer($company_id,$audit_id,3);

        return View::make('pruebas/pruebaHome',compact('menus'));
        //return View::make('report/bayer/trademarkReportBayerPrueba',compact('menus'));

    }

    public function filtroPeriodos()
    {


        $menus=null; // = $this->generateMenusBayer($company_id,$audit_id,3);

        return View::make('pruebas/filtroPeriodos',compact('menus'));
        //return View::make('report/bayer/trademarkReportBayerPrueba',compact('menus'));

    }
    public function traderMarkReportPrueba($company_id="0")
    {


        $menus=null; // = $this->generateMenusBayer($company_id,$audit_id,3);

        return View::make('pruebas/trademarkReportBayerPrueba',compact('menus'));

    }


    /*
     * Prueba de descarga de excel poor ajax
     */
    public function pruebaDowloadExcelAjax()
    {


        $menus=null; // = $this->generateMenusBayer($company_id,$audit_id,3);

        return View::make('pruebas/excelDownloadPrueba',compact('menus'));
        //return View::make('report/bayer/trademarkReportBayerPrueba',compact('menus'));

    }

}