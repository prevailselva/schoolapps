<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
class sectionController extends \BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth');
        $this->beforeFilter('userAccess',array('only'=> array('delete')));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::Make('app.sectionCreate');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $rules=[
            'name' => 'required',            
            'description' => 'required'
        ];
        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to('/section/create')->withErrors($validator);
        }
        else {

            //$clcode = 'sl'.Input::get('code');
			$clcode = 'sl'.Input::get('name');
            $cexists=SectionModel::select('*')->where('code','=',$clcode)->get();
            if(count($cexists)>0){

                $errorMessages = new Illuminate\Support\MessageBag;
                $errorMessages->add('duplicate', 'Section all ready exists!!');
                return Redirect::to('/section/create')->withErrors($errorMessages);
            }
            else {
                $section = new SectionModel;
                $section->name = Input::get('name');
                $section->code = $clcode;
                $section->description = Input::get('description');
                $section->combinePass = Input::has('combinePass') ? 1 : 0;
                $section->save();
                return Redirect::to('/section/create')->with("success", "Section Created Succesfully.");
            }

        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function show()
    {
        $Sections = SectionModel::orderby('code','asc')->get();
        return View::Make('app.sectionList',compact('Sections'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $section = SectionModel::find($id);
        return View::Make('app.sectionEdit',compact('section'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update()
    {
        $rules=[
            'name' => 'required',
            'description' => 'required'
        ];
        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to('/section/edit/'.Input::get('id'))->withErrors($validator);
        }
        else {
            $section = SectionModel::find(Input::get('id'));
            $section->name= Input::get('name');
            $section->description=Input::get('description');
            $section->combinePass = Input::has('combinePass') ? 1 : 0;
            $section->save();
            return Redirect::to('/section/list')->with("success","Section Updated Succesfully.");

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        $section = SectionModel::find($id);
        $section->delete();
        return Redirect::to('/section/list')->with("success","Section Deleted Succesfully.");
    }

    public function getSubjects($section)
    {
        $subjects = Subject::select('name','code')->where('section',$section)->orderby('code','asc')->get();
        return $subjects;
    }

}
