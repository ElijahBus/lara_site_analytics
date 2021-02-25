<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Dashboard\Traits\ModelsDefinition;
use Illuminate\Support\Facades\Validator;
use Dashboard\Http\Controllers\Controller;

class TosController extends Controller
{
    use ModelsDefinition;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toss = $this->tos::all();
        return view('dashboard::assets.tos')->with('tabName', $toss);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $validator = Validator::make($request->all(), [
            'version' => ['required', 'string', 'unique:tos'],
            'type' => ['required'],
            'content' => ['required']
        ]);

        if ($validator->fails()) {
            return view('dashboard::assets.tos')->withErrors($validator)->with('newTosFailed', true);
        }

        $this->tos::create([
            'version' => $request['version'],
            'type' => $request['type'],
            'content' => $request['content']
        ]);

        return redirect(route('dashboard.tos'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'TOS Successfully created.'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tos  $tos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tos = $this->tos::findOrFail($id);
        if ($tos == null) {
            return redirect(route('dashboard.tos'))->with([
                'notificationStatus' => 'error',
                'notificationMessage' => 'TOS Does not exist.'
            ]);
        }

        return view('dashboard::assets.tos')->with(['data' => $tos, 'viewTos' => true]);
    }

    public function displayTos(Request $request)
    {
        $tos = $this->tos::where('version', $request['tos-search'])->first();
        if ($tos == null) {
            return redirect(route('dashboard.tos'))->with([
                'notificationStatus' => 'error',
                'notificationMessage' => 'TOS Does not exist.'
            ]);
        }

        return view('dashboard::assets.tos')->with(['data' => $tos, 'viewTos' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tos  $tos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tos = $this->tos::findOrFail($id);

        return view('dashboard::assets.tos')->with(['data' => $tos, 'editTos' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tos  $tos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tos = $this->tos::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'edit_version' => ['required', 'string'],
            'edit_type' => ['required'],
            'edit_content' => ['required']
        ]);

        if ($validator->fails())
            return view('dashboard::assets.tos')->withErrors($validator)->with([
                'updateTosFailed'=> true,
                'data' => $tos
            ]);

        $tos->update([
            'version' => $request['edit_version'],
            'type' => $request['edit_type'],
            'content' => $request['edit_content']
        ]);

        return redirect(route('dashboard.tos'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'TOS Successfully updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tos  $tos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tos = $this->tos::findOrFail($id);
        $tos->delete();

        return redirect(route('dashboard.tos'))->with([
            'notificationStatus' => 'success',
            'notificationMessage' => 'TOS Successfully deleted.'
        ]);
    }
}
