<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LeafletPage;
use App\Model\Leaflet;
use DB;
use View;

class LeafletController extends Controller
{
public function getLeaflet(Request $request){

    $data['title'] = 'Customer';

    if ($request->ajax()) {
        $data = Leaflet::orderBy('name','asc');

        return datatables($data)
            ->addColumn('actions', function ($item) {
                $edit_url = route('getLeafletEdit',['id'=>encrypt($item->id)]);
                $pdf_url = route('getLeafletPdf',['id'=>encrypt($item->id)]);

                return '<a class="btn btn-success btn-circle btn-sm" href="'.$edit_url.'">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <a class="btn btn-success btn-circle btn-sm" target="_blank" href="'.$pdf_url.'">
                <i class="fas fa-pdf"></i>
              </a>
              <a class="btn btn-danger btn-circle btn-sm" href="#edit_modal" data-toggle="modal">
                  <i class="fas fa-trash"></i>
              </a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    return view('admin.web.leaflet.list',$data);
}



public function getLeafletAdd($id = null){
    if(!empty($id)) {
        $leaflet = Leaflet::with(['getLeafletPage'])->where('id',decrypt($id))->first();
        $data['pages'] = $leaflet->getLeafletPage;
        $data['leaflet'] = $leaflet;
    }

    $data['edit_id'] = $id;

    return view('admin.web.leaflet.add',$data);
}

public function getLeafletAddIframe($id = null, $page_no = null){
    
    $data['pages'] = LeafletPage::orderBy('page_no')->where('leaflet_id',decrypt($id))->get();
    $data['type'] = 'page';

    return view('admin.web.leaflet.iframe',$data);
}

// pdf
public function getLeafletPdf($id)
{
    $leaflet = Leaflet::with(['getLeafletPage'])->where('id',decrypt($id))->first();
    $data['pages'] = $leaflet->getLeafletPage;
    $data['leaflet'] = $leaflet;
    $data['type'] = 'pdf';

    $data_html = View::make('admin.web.leaflet.iframe',$data);
    $data_html = $data_html->render();

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->AddPage('L');
    $mpdf->WriteHTML($data_html);
    $mpdf->Output();
}


public function getLeafletSave(Request $request){
    $id = Leaflet::insertGetId(['name'=>$request->name]);

    return redirect()->route('getLeafletEdit',['id'=>encrypt($id)]);
}

public function getLeafletPageAdd($id,$page_no,$type)
{
    $leaflet = Leaflet::with(['getLeafletPage'])->where('id',decrypt($id))->first();
    $page_content = '';
    $pages = $leaflet->getLeafletPage;
    if(count($pages)) {
        foreach ($pages as $page) {
            if($page->page_no == $page_no) {
                $page_content = $page;
                break;
            }
        }
    }
    $data['leaflet'] = $leaflet;
    $data['page_content'] = $page_content;
    $data['page_no'] = $page_no;
    $data['type'] = $type;

    return view('admin.web.leaflet.add-page',$data);
}

public function getLeafletPageSave(Request $request){

    $leaflet_id = decrypt($request->edit_id);

    $edit_id = (!empty($request->edit_id)) ? decrypt($request->edit_id) : '';

    DB::table('leaflet_pages')->updateOrInsert(
        ['leaflet_id' => $leaflet_id, 'page_no' => $request->page_no,],
        ['page_content' => $request->page_content]
    );

    return redirect()->route('getLeafletEdit',['id'=>encrypt($leaflet_id)]);
}

public function leafletSave(){
    try {
        //code...
        $data = [

        ];

        return redirect()->route('getLeaflet');
    } catch (\Throwable $th) {
        //throw $th;
    }


    return view('admin.web.leaflet.addTwo');
}
}
