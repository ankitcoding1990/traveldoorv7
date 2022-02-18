<?php

namespace App\Http\Controllers\Masters;

use App\Models\Languages;
use Illuminate\Http\Request;
use App\Illuminate\Validation;
use Illuminate\Validation\Rule;
use App\Services\LanguageServices;
use App\Http\Controllers\Controller;
use App\DataTables\LanguagesDataTable;
use Route;
class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $routeName;
    public function __construct(LanguageServices $languageService)
    {
        $this->languageService = $languageService;
        $this->routeName = 'languages.index';
    }

    public function index(LanguagesDataTable $dataTable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $dataTable->with(['routeName' => $routeName])->render('mains.masters.languages.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
           return $dataTable->with(['user_id' => auth()->user()->id,'routeName' => $routeName])->render('mains.masters.languages.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['language_name' => [
            'required',
                Rule::unique('languages')->where(function($query)use($request){
                    return $query->where('language_name', $request->language_name);
                                    // ->where('iso_639_no', $request->iso_639_no);
                }),
            ],
        ]);
        $message = $this->languageService->store($request);
        return $message;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routeName = $this->routeName;
        $language = Languages::where('id', $id)->firstOrFail();
        return view('mains.masters.languages.index', compact('language','routeName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate(['language_name' => [
            'required',
                Rule::unique('languages')->where(function($query)use($request,$id){
                    return $query->where('language_name', $request->language_name)
                    // ->where('iso_639_no', $request->iso_639_no)
                    ->where('id', '!=', $id);
                }),
            ],'iso_639_no' => 'required',

        ]);
        $message = $this->languageService->store($request, $id);
        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ChangeState(Request $request)
    {
        return $this->languageService->changeState($request);
    }
}
